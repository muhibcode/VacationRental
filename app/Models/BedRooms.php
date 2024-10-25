<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedRooms extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'room_no' => 'array',
        'total_beds_in_room' => 'array',
        'bed_type' => 'array',
    ];

    // public function rental()
    // {
    //     return $this->belongsTo(Rental::class);
    // }

}
