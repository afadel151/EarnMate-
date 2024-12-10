<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fakr = \Faker\Factory::create();
        $levels = Level::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();
        for ($i=0; $i < 80; $i++) { 
            Subscription::create([
                'user_id' => $fakr->unique()->randomElement($users),
                'level_id' => $fakr->randomElement($levels),
                'method' => $fakr->randomElement(['regular','exception']),
                'completed' => false
            ]);
        }
    }
}
