<?php

namespace Database\Factories;

use App\Models\Fir;
use Illuminate\Database\Eloquent\Factories\Factory;

class FirFactory extends Factory
{
    protected $model = Fir::class;

    public function definition()
    {
        return [
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'address' => $this->faker->address,
            'incident_details' => $this->faker->paragraph,
            'related_to' => $this->faker->numberBetween(1,10),
            'remarks' => $this->faker->sentence,
            'clue' => $this->faker->numberBetween(0,1),
            'complain_by' => function () {
                return \App\Models\Complainants::factory()->create()->id;
            },
            'register_by' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'investigation_start_date' => $this->faker->dateTime,
            'investigation_end_date' => $this->faker->dateTime,
            'case_number' => $this->faker->unique()->numberBetween(1000, 9999),
            'warrant_number' => $this->faker->unique()->numberBetween(1000, 9999),
            'incident_type_id' => function () {
                return \App\Models\IncidentType::factory()->create()->id;
            },
            'priority_id' => function () {
                return \App\Models\CasePriority::factory()->create()->id;
            },
            'status_id' => function () {
                return \App\Models\FirStatus::factory()->create()->id;
            },
            'reported_at' => $this->faker->dateTime,
            'incident_date' => $this->faker->dateTime,
        ];
    }
}
