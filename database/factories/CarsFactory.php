<?php

namespace Database\Factories;

use App\Models\Cars;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarsFactory extends Factory
{
    protected $model = Cars::class;

    public function definition()
    {
        return [
            'mark' => $this->faker->word,
            'model' => $this->faker->word,
            'year' => $this->faker->year,
            'vin' => $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'color' => $this->faker->colorName,
            'mileage' => $this->faker->numberBetween(0, 200000),
            'price' => $this->faker->randomFloat(2, 1000, 100000),
            'availability' => $this->faker->boolean,
            'body_type' => $this->faker->word,
            'equipment' => $this->faker->word,
            'engine' => $this->faker->word,
            'tax' => $this->faker->randomFloat(2, 100, 5000),
            'transmission' => $this->faker->word,
            'drive_type' => $this->faker->word,
            'delivery_location' => $this->faker->city,
        ];
    }
}