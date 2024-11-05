<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\BedRooms;
use App\Models\ListingImage;
use App\Models\Rental;
use App\Models\RentalAmenities;
use App\Models\UserProfile;
use Cache;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'checkin_date',
            'checkout_date',
            'noOfChildren',
            'noOfAdults',
            'maxGuest',
            'noOfBedrooms',
            'noOfBaths',
            'noOfBeds',
            'minPrice',
            'maxPrice',
            'filterCount'
        ]);

        // $tapi = Http::get("http://localhost:3000/");

        // info($tapi->body());

        // $arr1 = [['single', 'double'], ['king', 'double']];
        // $arr2 = [['king', 'double'], ['single', 'double']];
        // if ($arr1 == $arr2) {

        //     dd(true);
        // } else {
        //     dd(false);
        // }
        // info($filters['maxGuest']);

        // dd($filter);

        $rentals = Rental::with(['owner.user', 'bookings', 'bedrooms', 'amenities', 'images'])
            ->orderBy('created_at', 'asc')->orderBy('max_guest', 'asc');
        // $from = '2024-05-22';
        $allrentals = Rental::with(['owner.user', 'bookings', 'bedrooms', 'amenities', 'images'])
            ->orderBy('created_at', 'asc')->orderBy('max_guest', 'asc');
        if ($request->checkin_date && $request->checkout_date) {
            // $from = Carbon::parse($filter['checkin_date']);
            // $to = Carbon::parse($filter['checkout_date']);
            $from = Carbon::parse($request->checkin_date);
            $to = Carbon::parse($request->checkout_date);
            $rentals->whereDoesntHave('bookings', function ($q) use ($from, $to) {
                $q->where('checkout_date', '>=', $from);
                $q->where('checkin_date', '<=', $to);
            });
            $allrentals->whereDoesntHave('bookings', function ($q) use ($from, $to) {
                $q->where('checkout_date', '>=', $from);
                $q->where('checkin_date', '<=', $to);
            });
            // ->whereDoesntHave('bookings.rental', function ($q) use ($from, $to) {
            //     $q->where('close_to', '>=', $from);
            //     $q->where('close_from', '<=', $to);
            // });
        }
        if ($filters['maxGuest'] ?? false) {
            $rentals->where([['max_guest', '>=', $filters['maxGuest']]]);
            $allrentals->where([['max_guest', '>=', $filters['maxGuest']]]);

        }
        if ($filters['minPrice'] ?? false) {
            $rentals->where('tariff', '>=', $filters['minPrice']);
        }
        if ($filters['maxPrice'] ?? false) {
            $rentals->where([['tariff', '<=', $filters['maxPrice']]]);
        }

        if ($filters['noOfBedrooms'] ?? false) {
            $rentals->where('total_bedrooms', '>=', $filters['noOfBedrooms']);
        }
        if ($filters['noOfBeds'] ?? false) {
            $rentals->where('total_beds', '>=', $filters['noOfBeds']);
        }
        if ($filters['noOfBaths'] ?? false) {
            $rentals->where('total_baths', '>=', $filters['noOfBaths']);
        }
        return inertia('Rental/Index', [
            'rentals' => $rentals->paginate(10)->withQueryString(),
            'filters' => $filters,
            // 'tapi' => $tapi->body(),
            'allrentals' => $allrentals->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amenities = Amenities::all();
        return inertia('Rental/AddRental', ['amenities' => $amenities]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(auth()->id());

        $user_profile = UserProfile::where('user', '=', auth()->id())->first();

        $bedrooms = BedRooms::create([
            'room_no' => $request->roomNo,
            'total_beds_in_room' => $request->noOfBeds,
            'bed_type' => $request->bedType

        ]);
        $rental = Rental::create([
            'name' => $request->name,
            'city' => $request->city,
            'address' => $request->address,
            'tariff' => $request->tariff,
            'owner' => $user_profile->id,
            'rental_type' => $request->rentalType,
            'total_baths' => $request->totalBaths,
            'total_bedrooms' => $request->noOfRooms,
            'total_beds' => $request->totalBeds,
            'max_guest' => $request->maxGuest,
            'bedrooms' => $bedrooms->id

        ]);
        $rcount = count($request->amenities);
        for ($i = 0; $i < $rcount; $i++) {
            RentalAmenities::create([
                'title' => $request->amenities[$i],
                'rental_id' => $rental->id
            ]);

        }

        if ($request->hasFile('images')) {

            $images = $request->file('images');
            # code...
            foreach ($images as $image) {
                # code...
                $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

                // $image->move('storage/images');
                $path = $image->storeAs('images', $img_name, 'public');

                ListingImage::create([
                    'filename' => $path,
                    'rental_id' => $request->rental
                ]);
            }
        }



        // dd($user_profile->id);
        // $bedrooms = $request->bedrooms;
        // $tmp = new BedRooms();
        // $tmp->room_no = [$request->bedrooms[0]['room_no']];
        // $tmp->total_beds_in_room = [$request->bedrooms[0]['total_beds_in_room']];
        // $tmp->bed_type = [$request->bedrooms[0]['bed_type']];

        // $bedroom = $tmp->insertGetId([$tmp]);

        // $tmp = new Rental();
        // $tmp->name = $request->name;
        // $tmp->city = $request->city;
        // $tmp->address = $request->address;
        // $tmp->tariff = $request->tariff;
        // $tmp->owner = $user_profile->id;
        // dd($request->bedRooms[0]['roomNo']);
        // $bedrooms = count($request->bedRooms);
        // // dd($bedrooms);
        // $voucherArray = [];
        // $r_no = [];
        // $b_rooms = [];
        // $b_types = [];
        // if ($request->bedRooms) {
        //     for ($i = 0; $i < $bedrooms; $i++) {
        //         // info(json_encode($request->bedRooms[$i]['roomNo']));
        //         array_push($r_no, $request->bedRooms[$i] ? $request->bedRooms[$i]['roomNO'] : null);
        //         array_push($b_rooms, $request->bedRooms[$i] ? $request->bedRooms[$i]['noOfBeds'] : null);
        //         array_push($b_types, $request->bedRooms[$i] ? $request->bedRooms[$i]['bedType'] : null);
        //         // $data = [
        //         //     'room_no' => $request->bedRooms[$i] ?? ['roomNO'],
        //         //     'total_beds_in_room' => $request->bedRooms[$i] ?? ['noOfBeds'],
        //         //     'bed_type' => json_encode($request->bedRooms[$i] ?? ['bedType'])
        //         // ];

        //         // array_push($voucherArray, $data);
        //     }

        // }

        // $data = [
        //     'room_no' => $r_no,

        // ];
        // dd($data);
        // info(json_decode($voucherArray));

        // $ren_id = DB::table('bed_rooms')->insertGetId($voucherArray);

        // info($ren_id);
        // Rental::insertGetId(array($tmp));



        return redirect()->route('rental.index', ['rental' => $rental]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        # code...
        $query = json_decode(request()->q);

        $filters = [
            'checkin_date' => $query->checkin_date,
            'checkout_date' => $query->checkout_date,
            'noOfChildren' => $query->noOfChildren,
            'noOfAdults' => $query->noOfAdults,
            'maxGuest' => $query->maxGuest,
            // 'bedrooms',
            // 'baths',
            // 'beds',
            // 'cost'
        ];
        $rental = Rental::where('id', '=', $id)
            ->with(['bookings', 'images', 'bedrooms', 'owner.user'])
            ->first();

        return inertia('Rental/SingleRental', ['rental' => $rental, 'filters' => $filters]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
