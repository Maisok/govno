<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'car_id', 'start_date', 'end_date', 'phone_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cars()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }
}