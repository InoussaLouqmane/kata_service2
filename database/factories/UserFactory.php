<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
     $faker = app(Faker::class);
        return [
            User::FIRST_ATTEMPT => 0,
            User::STATUS => 'active',
            User::FIRST_NAME => 'Bourov',
            User::LAST_NAME => 'Zelensky',
            User::EMAIL => 'bourov@gmail.com',
            User::PHONE => $this->faker->phoneNumber(),
            User::EMAIL_VERIFIED_AT => now(),

            User::BIO_DESCRIPTION => $this->faker->sentence(),

            User::GENRE => $this->faker->randomElement(['Femme', 'Homme']),
            User::PASSWORD =>  Hash::make('lolodede'),
            User::ROLE =>(Role::ADMIN),
            User::LICENSE_ID => $this->faker->unique()->numberBetween(1000, 9999),
            User::GRADE => $this->faker->randomElement([1, 2, 3]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            User::EMAIL_VERIFIED_AT => null,
        ]);
    }
}
