<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $fillable = ['model', 'year', 'vin', 'color', 'mileage', 'price', 'car_id'];

    public function car()
    {
        return $this->belongsTo(Cars::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
