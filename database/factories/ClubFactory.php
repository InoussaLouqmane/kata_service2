<?php

namespace Database\Factories;

use App\Models\Club;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends Factory<Club>
 */
class ClubFactory extends Factory
{
    protected $model = Club::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = app(Faker::class);
        return [

            'name' => $faker->company(),
            'ifuNumber' => $faker->numerify('###-###-###'),
            'martialArtType' => $faker->randomElement([1, 2, 3]),
            'email' => $faker->unique()->safeEmail(),
            'description' => $faker->sentence(),
            'websiteUrl' => $faker->optional()->url(),
            'address' => $faker->address(),
        ];
    }
}
