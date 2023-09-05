<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'name' => 'Avis',
                'display_order' => 1,
                'active' => true,
            ],
            [
                'name' => 'Budget',
                'display_order' => 2,
                'active' => true,
            ],
            [
                'name' => 'Payless',
                'display_order' => 3,
                'active' => true,
            ],
        ];

        collect($brands)->each(function($brand) {
            Brand::create($brand);
        });
    }
}
