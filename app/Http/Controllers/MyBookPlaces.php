<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class MyBookPlaces extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // my currently booked places


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $my_book_places = Booking::with('rental.owner')->whereHas('rental', function ($q) use ($id) {
            $q->where('owner', '=', $id);
        })->get();

        return inertia('Booking/MyBookedPlaces', ['bookedPlaces' => $my_book_places]);

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
