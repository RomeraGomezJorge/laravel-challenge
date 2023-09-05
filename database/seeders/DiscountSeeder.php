<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\DiscountRange;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::factory(random_int(25,30))->create()->each(function($discount) {
            $discount->discount_range()->saveMany(DiscountRange::factory(random_int(1,3))->make());
        });
    }
}
