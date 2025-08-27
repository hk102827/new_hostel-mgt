<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model = Room::class;
    public function definition(): array
    {
             return [
            'room_number' => $this->faker->unique()->numberBetween(100, 999), // e.g. 101, 205
            'room_type'   => $this->faker->randomElement(['Single', 'Double', 'Triple', 'quad']),
            'capacity'    => $this->faker->numberBetween(1, 6),
            'occupied'    => $this->faker->numberBetween(0, 6), // jitne log already rehte hain
            'rent'        => $this->faker->randomFloat(2, 3000, 15000), // monthly rent
            'status'      => $this->faker->randomElement(['available', 'full', 'maintenance']),
            'facilities'  => $this->faker->randomElement([
                                'WiFi, AC, TV',
                                'Fan, Shared Bathroom',
                                'AC, Heater, Balcony',
                                'WiFi, Attached Bathroom'
                            ]),
        ];
    }
}
