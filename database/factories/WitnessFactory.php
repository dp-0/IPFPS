<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Witness>
 */
class WitnessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fir_id' => function () {
                return \App\Models\Fir::inRandomOrder()->first()->id;
            },
            'name' => $this->faker->name,
            'contact_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'statement' => $this->faker->text,
        ];
    }
}
