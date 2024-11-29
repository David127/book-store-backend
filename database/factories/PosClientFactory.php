<?php

namespace Database\Factories;

use App\Models\PosClient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosClientFactory extends Factory
{
    protected $model = PosClient::class;

    public function definition()
    {
        return [
            'doc_type' => $this->faker->randomElement([1, 2, 3]),
            'doc_number' => $this->faker->numerify('##########'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->numerify('9########'),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
