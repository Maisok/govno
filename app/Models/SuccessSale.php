<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessSale extends Model
{
    protected $table = 'successsales'; // Указываем имя таблицы
    protected $fillable = ['car_id'];

    public function car()
    {
        return $this->belongsTo(Cars::class);
    }
}