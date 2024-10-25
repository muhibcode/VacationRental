<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rental;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('UserProfile/AddProfile');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        UserProfile::create([
            'city' => $request->city,
            'address' => $request->address,
            'phone_no' => $request->phone_no,
            'user' => auth()->id()
        ]);

        return redirect()->route('rental.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = UserProfile::with('user')->where('user', '=', $id)->with('rental')->first();

        return inertia('UserProfile/Index', ['user' => $user]);
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
