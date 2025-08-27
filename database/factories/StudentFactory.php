<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
            'name' => $this->faker->name(),
            'father_name' => $this->faker->name('male'), // father ka naam
            'cnic' => $this->faker->unique()->numerify('#####-#######-#'), // Pakistani CNIC format
            'phone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'emergency_contact' => $this->faker->phoneNumber(),
            'admission_date' => $this->faker->date('Y-m-d', 'now'), // current ya past date
            'status' => $this->faker->randomElement(['active', 'inactive', 'graduated']),
        ];
    }
}
