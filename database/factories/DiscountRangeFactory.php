<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountRangeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from_days' => random_int(1, 50),
            'to_days'   => random_int(51, 100),
            'discount'  => (random_int(1, 10) > 2) ? random_int(1, 100) : NULL,
            'code'      => (random_int(1, 10) < 8) ? $this->faker->word() : NULL,
        ];
    }
}
