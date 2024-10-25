<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $amenities = Amenities::all();
        // return inertia('Rental/AddRental', ['amenities' => $amenities]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Amenities/AddAmenity');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Amenities::create([
            'title' => $request->title
        ]);

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
