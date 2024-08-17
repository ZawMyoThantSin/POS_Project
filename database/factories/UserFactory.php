<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>'superAdmin',
            'email' =>'superadmin@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' =>'superAdmin',
            'provider' => 'simple'
        ];
    }
}
