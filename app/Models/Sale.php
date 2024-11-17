<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['car_id'];

    public function car()
    {
        return $this->belongsTo(Cars::class);
    }
}