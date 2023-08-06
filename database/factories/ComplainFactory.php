<?php

namespace Database\Factories;

use App\Models\Complain;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Complainants>
 */
class ComplainFactory extends Factory
{

    protected $model = Complain::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>$this->faker->title,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'address' => $this->faker->address,
            'complain_details' => $this->faker->paragraph,
            'complain_number' => $this->faker->unique()->randomNumber(6),
            'reported_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'incident_date' => $this->faker->dateTimeBetween('-2 years', '-1 year'),
            'register_by' => function () {
                return \App\Models\User::inRandomOrder()->first()->id;
            },
            'complain_by' => function () {
                return \App\Models\Complainants::inRandomOrder()->first()->id;
            },
            'incident_type_id' => function () {
                
                return \App\Models\IncidentType::inRandomOrder()->first()->id;
            },
            'status_id' => function () {
                return \App\Models\FirStatus::inRandomOrder()->first()->id;
            },
        ];
    }
}
