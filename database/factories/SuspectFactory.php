<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Suspect>
 */
class SuspectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'age' => $this->faker->numberBetween(18, 60),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'address' => $this->faker->address,
            'nationality' => $this->faker->country,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'description' => $this->faker->sentence,
            'photo' => $this->faker->imageUrl(640, 480, 'people', true),
            'fir_id' => function () {
                return \App\Models\Fir::inRandomOrder()->first()->id;
            },
            'arrest_date' => $this->faker->date,
            'released_date' => $this->faker->date,
            'remarks' => $this->faker->name,
        ];
    }
}
