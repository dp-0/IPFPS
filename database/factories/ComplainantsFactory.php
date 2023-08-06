<?php

namespace Database\Factories;

use App\Models\Complainants;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Complainants>
 */
class ComplainantsFactory extends Factory
{

    protected $model = Complainants::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name;
        return [
            'name' => $name,
            'profile_photo_path' => "https://ui-avatars.com/api/?name=" . urlencode($name) . "&color=7F9CF5&background=EBF4FF",
            'mobile_no' =>  $this->generateNepaliMobileNumber(),
            'address' => $this->faker->address,
            // Add other fields and their default values here
        ];
    }
    /**
     * Generate a 10-digit Nepali mobile number
     *
     * @return string
     */
    protected function generateNepaliMobileNumber(): string
    {
        $prefix = '98'; // Nepali mobile number prefix

        // Generate 8 random digits for the remaining part of the number
        $remainingDigits = $this->faker->numerify('########');

        // Concatenate the prefix and remaining digits to form a 10-digit number
        $mobileNumber = $prefix . $remainingDigits;

        return $mobileNumber;
    }
}
