<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SubscriptionTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscription_tiers')->insert([
            ['name' => 'Free', 'daily_limit' => 100, 'billing_required' => false,'rate_per_extra_call' => 0],
            ['name' => 'Standard', 'daily_limit' => 1000, 'billing_required' => false,'rate_per_extra_call' => 0],
            ['name' => 'Premium', 'daily_limit' => 10000, 'billing_required' => true, 'rate_per_extra_call' => 0.01],
        ]);
    }
}
