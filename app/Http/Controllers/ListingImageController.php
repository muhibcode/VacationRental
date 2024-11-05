<?php

namespace App\Http\Controllers;

use App\Models\ListingImage;
use App\Models\Rental;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ListingImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $rental = $request->query('rental');
        return inertia('Images/AddImage', ['rental' => $rental]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // info($request->images);
        // info($request->file('images'));
        // info($request->hasFile('images'));
        // info($request->rental);
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
