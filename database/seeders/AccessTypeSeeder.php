<?php

namespace Database\Seeders;

use App\Models\AccessType;
use Illuminate\Database\Seeder;

class AccessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessTypes = [
            [
                'code' => 'F',
                'name' => 'Customer',
                'display_order' => 1,
            ],
            [
                'code' => 'A',
                'name' => 'Agency',
                'display_order' => 2,
            ],
            [
                'code' => 'C',
                'name' => 'Corporate',
                'display_order' => 3,
            ],
        ];

        collect($accessTypes)->each(function($accessType) {
            AccessType::create($accessType);
        });
    }
}
