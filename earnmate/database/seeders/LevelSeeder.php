<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::insert([
                [
                    'level_number' => 1,
                    'deposit_required' => 1000,
                    'friends_required' => 0,
                    'reward'=>500
                ],
                [
                    'level_number' => 2,
                    'deposit_required' => 2000,
                    'friends_required' => 2,
                    'reward'=>1000
                ],
                [
                    'level_number' => 3,
                    'deposit_required' => 5000,
                    'friends_required' => 4,
                    'reward'=>2500
                ],
                [
                    'level_number' => 4,
                    'deposit_required' => 8000,
                    'friends_required' => 6,
                    'reward'=>4000
                ],
                [
                    'level_number' => 5,
                    'deposit_required' => 12000,
                    'friends_required' => 10,
                    'reward'=>6000
                ],
                [
                    'level_number' => 6,
                    'deposit_required' => 18000,
                    'friends_required' => 15,
                    'reward'=>9000
                ],
                [
                    'level_number' => 7,
                    'deposit_required' => 24000,
                    'friends_required' => 18,
                    'reward'=>12000
                ],
                [
                    'level_number' => 8,
                    'deposit_required' => 30000,
                    'friends_required' => 24,
                    'reward'=>15000
                ],
            ]);
    }
}
