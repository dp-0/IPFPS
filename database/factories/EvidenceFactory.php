<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evidence>
 */
class EvidenceFactory extends Factory
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
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['Document', 'Weapon', 'DNA Sample', 'Other']),
            'collected_by' =>function () {
                return \App\Models\User::inRandomOrder()->first()->id;
            },
            'collected_at' => $this->faker->dateTimeThisYear,
            'preserved_by' => function () {
                return \App\Models\User::inRandomOrder()->first()->id;
            },
            'preserved_at' => $this->faker->dateTimeThisYear,
            'attachment_path' => $this->faker->imageUrl(),
        ];
    }
}
