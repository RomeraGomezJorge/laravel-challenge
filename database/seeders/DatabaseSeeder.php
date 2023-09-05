<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\DiscountRange;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        $this->call(RegionSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(AccessTypeSeeder::class);
        $this->call(DiscountSeeder::class);

    }
}
