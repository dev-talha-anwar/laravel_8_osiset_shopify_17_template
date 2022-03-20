<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Osiset\ShopifyApp\Storage\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'type' => 'RECURRING',
            'name' => 'Paid plan',
            'price' => 110.70,
            'interval' => 'EVERY_30_DAYS',
            'capped_amount' => 0.00,
            'trial_days' => 7,
            'test' => FALSE,
            'on_install' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
