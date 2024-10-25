<?php

namespace App\Http\Controllers;

use App\Events\BookingReserve;
use App\Events\reservebook;
use App\Models\Booking;
use App\Models\Rental;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $bookings = Booking::with('rental.owner.user')
            ->where('tenant', '=', auth()->id())->get();

        return inertia('Booking/MyBooking', ['mybookings' => $bookings]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //

        if ($request->hmsg !== '') {
            # code...
            // event(new reservebook($request->hmsg));

        }

        // info($request->hmsg);

        // $res = 'socket are rady';
        // info($res);
        // broadcast(new reservebook($res));

        return 'nice to have socket';

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_profile = UserProfile::where('user', '=', auth()->id())->first();
        // dd($user_profile->id);
        $res = [
            'name' => 'baalo shai'
        ];
        reservebook::dispatch($request->hmsg, $res);

        Booking::create([
            'checkin_date' => Carbon::parse($request->checkin_date),
            'checkout_date' => Carbon::parse($request->checkout_date),
            'rental_id' => $request->rental,
            'no_of_days' => $request->noOfDays,
            'no_of_adults' => $request->noOfAdults,
            'no_of_children' => $request->noOfChildren,
            'total_amount' => $request->totalAmount,
            'tenant' => $user_profile->id
            // 'owner' => $user_profile->id,

        ]);


        // Rental::where('id', '=', $request->rental)->update([
        //     'booking' => $booking->id
        // ]);

        return redirect()->route('rental.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
