<?php

namespace Database\Factories;

use App\Models\PosBook;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosBookFactory extends Factory
{
    protected $model = PosBook::class;

    public function definition()
    {
        return [
            'isbn' => $this->faker->isbn13(),
            'name' => $this->faker->sentence(3),
            'stock' => $this->faker->numberBetween(10, 100),
            'current_price' => $this->faker->randomFloat(2, 5, 100),
            'image' => 'https://m.media-amazon.com/images/I/71ODaT072wL._SL1500_.jpg'
        ];
    }
}
