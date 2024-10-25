<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function tenant()
    {
        return $this->belongsTo(UserProfile::class, 'tenant');
    }
}
