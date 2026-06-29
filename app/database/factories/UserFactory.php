<?php

namespace Database\Factories;

<<<<<<< Updated upstream
<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
>>>>>>> Stashed changes
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
<<<<<<< Updated upstream
<<<<<<< HEAD
 * @extends Factory<User>
=======
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
>>>>>>> Stashed changes
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
<<<<<<< Updated upstream
<<<<<<< HEAD
            'remember_token' => Str::random(10),
            'role' => 'operador',
=======
            'role' => \App\Models\User::ROLE_ADMIN,
            'remember_token' => Str::random(10),
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
            'role' => \App\Models\User::ROLE_ADMIN,
            'remember_token' => Str::random(10),
>>>>>>> Stashed changes
        ];
    }

    /**
<<<<<<< Updated upstream
<<<<<<< HEAD
     * Indicate that the user is an admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    /**
=======
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
=======
>>>>>>> Stashed changes
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
