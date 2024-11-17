<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('mark');
            $table->string('model');
            $table->year('year');
            $table->string('vin')->unique();
            $table->string('color');
            $table->integer('mileage');
            $table->decimal('price', 10, 2);
            $table->boolean('availability')->default(true); // Наличие
            $table->string('body_type'); // Кузов
            $table->string('equipment'); // Комплектация
            $table->string('engine'); // Двигатель
            $table->decimal('tax', 10, 2); // Налог
            $table->string('transmission'); // Коробка
            $table->string('drive_type'); // Привод
            $table->string('delivery_location')->nullable(); // Место поставки
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};