<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                "plan_name" => "Basic",
                "price" => 10,
                "features" => [
                    "Storage" => "10GB",
                    "Users" => "1 User"
                ]
            ],
            [
                "plan_name" => "Standard",
                "price" => 25,
                "features" => [
                    "Storage" => "50GB",
                    "Support" => "Email & Chat Support",
                    "Users" => "Up to 5 Users"
                ]
            ],
            [
                "plan_name" => "Premium",
                "price" => 50,
                "features" => [
                    "Storage" => "200GB",
                    "Support" => "Priority Support",
                    "Daily reports" => true,
                    "Users" => "Unlimited Users"
                ]
            ]
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(
                ['plan_name' => $plan['plan_name']],
                ['price' => $plan['price'], 'features' => $plan['features']]
            );
        }
    }
}
