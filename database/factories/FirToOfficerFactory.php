<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FirToOfficer>
 */
class FirToOfficerFactory extends Factory
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
            'user_id' => function () {
                return \App\Models\User::inRandomOrder()->where('utype', '=', 'police')->first()->id;
            },
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date
        ];
    }
}
