<?php

namespace Database\Factories;

use App\Models\CasePriority;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Complainants>
 */
class CasePriorityFactory extends Factory
{

    protected $model = CasePriority::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'priority' => $this->faker->randomNumber(),
        ];
    }
}
