<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->callOnce(LevelSeeder::class);
       $this->callOnce(UserSeeder::class);
       $this->callOnce(WithdrawalSeeder::class);
       $this->callOnce(SubscriptionSeeder::class);
    }
}
