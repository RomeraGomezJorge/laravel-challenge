<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [
                'code' => 'NAM',
                'name' => 'North America & Canada',
                'display_order' => 1,
            ],
            [
                'code' => 'EMEA',
                'name' => 'Europe, Middle East and Africa',
                'display_order' => 2,
            ],
            [
                'code' => 'LAC',
                'name' => 'Latin America & the Caribbean',
                'display_order' => 3,
            ],
            [
                'code' => 'APAC',
                'name' => 'Asia Pacific',
                'display_order' => 4,
            ],
        ];

        collect($regions)->each(
            function($region) {
                Region::create($region);
            }
        );
    }
}
