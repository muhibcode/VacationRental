<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['rental_id', 'filename'];
    protected $appends = ['src'];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function getSrcAttribute()
    {
        return asset("storage/{$this->filename}");
    }
}
