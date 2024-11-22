<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $fillable = [
        'mark',
        'model',
        'year',
        'vin',
        'color',
        'mileage',
        'price',
        'availability',
        'body_type',
        'equipment',
        'engine',
        'tax',
        'transmission',
        'drive_type',
        'delivery_location',
        'sold', 
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}