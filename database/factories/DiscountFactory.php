<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'             => $this->faker->unique()->word(),
            'start_date'       => Carbon::today(),
            'end_date'         => Carbon::today()->addDays(random_int(5, 55)),
            'priority'         => random_int(10, 100),
            'active'           => random_int(0, 1),
            'region_id'        => random_int(1, 4),
            'brand_id'         => random_int(1, 3),
            'access_type_code' => $this->faker->randomElement(['F', 'C', 'A']),
        ];
    }
}
