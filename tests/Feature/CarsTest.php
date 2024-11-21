<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cars;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_cars_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('cars.index'));

        $response->assertStatus(200);
        $response->assertViewIs('cars.createcar');
    }

    /** @test */
    public function user_can_add_a_car()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $carData = [
            'mark' => 'Toyota',
            'model' => 'Corolla',
            'year' => 2020,
            'vin' => '12345678901234567',
            'color' => 'Red',
            'mileage' => 50000,
            'price' => 20000,
            'availability' => true,
            'body_type' => 'Sedan',
            'equipment' => 'Base',
            'engine' => '2.0L',
            'tax' => 1000,
            'transmission' => 'Automatic',
            'drive_type' => 'FWD',
            'delivery_location' => 'New York',
        ];

        $response = $this->post(route('cars.store'), $carData);

        $response->assertRedirect(route('cars.index'));
        $response->assertSessionHas('success', 'Car model added successfully.');

        $this->assertDatabaseHas('cars', $carData);
    }

    /** @test */
    public function user_cannot_add_a_car_with_invalid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('cars.store'), [
            'mark' => '',
            'model' => '',
            'year' => 'invalid',
            'vin' => '',
            'color' => '',
            'mileage' => 'invalid',
            'price' => 'invalid',
            'availability' => 'invalid',
            'body_type' => '',
            'equipment' => '',
            'engine' => '',
            'tax' => 'invalid',
            'transmission' => '',
            'drive_type' => '',
            'delivery_location' => '',
        ]);

        $response->assertSessionHasErrors([
            'mark', 'model', 'year', 'vin', 'color', 'mileage', 'price', 'availability',
            'body_type', 'equipment', 'engine', 'tax', 'transmission', 'drive_type',
        ]);
    }


}