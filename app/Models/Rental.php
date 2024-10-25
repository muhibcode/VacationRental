<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'address' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function bedrooms()
    {
        return $this->belongsTo(BedRooms::class, 'bedrooms');
    }

    public function amenities()
    {
        return $this->hasMany(RentalAmenities::class);
    }
    public function owner()
    {
        return $this->belongsTo(UserProfile::class, 'owner');
    }

    public function images()
    {
        return $this->hasMany(ListingImage::class);
    }
}
