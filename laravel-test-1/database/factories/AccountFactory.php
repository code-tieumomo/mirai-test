<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'login'    => fake()->unique()->userName(),
            'password' => md5('password'),
            'phone'    => fake()->unique()->phoneNumber(),
        ];
    }
}
