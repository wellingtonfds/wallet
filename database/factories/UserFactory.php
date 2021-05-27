<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
     * @return array
     */
    public function definition()
    {

        $faker = \Faker\Factory::create('pt_BR');
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'cpf_cnpj' => $faker->cpf,
            'password' => Hash::make('wallet123'), // password
            'remember_token' => Str::random(10),
        ];
    }

    public function legal()
    {
        $faker = \Faker\Factory::create('pt_BR');
        return $this->state(function (array $attributes) use ($faker) {
            return [
                'cpf_cnpj' => $faker->cnpj,
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function test()
    {
        return $this->state(function (array $attributes) {
            $faker = \Faker\Factory::create('pt_BR');
            return [
                'password' => 'wallet123',
                'password_confirmation' => 'wallet123',
                'cpf_cnpj' => $faker->cpf,
            ];
        });
    }
}
