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
                    'deposit_required' => 10,
                    'friends_required' => 0,
                    'reward'=>5
                ],
                [
                    'level_number' => 2,
                    'deposit_required' => 20,
                    'friends_required' => 2,
                    'reward'=>10
                ],
                [
                    'level_number' => 3,
                    'deposit_required' => 40,
                    'friends_required' => 4,
                    'reward'=>20
                ],
                [
                    'level_number' => 4,
                    'deposit_required' => 80,
                    'friends_required' => 6,
                    'reward'=>40
                ],
                [
                    'level_number' => 5,
                    'deposit_required' => 150,
                    'friends_required' => 10,
                    'reward'=>75
                ],
                [
                    'level_number' => 6,
                    'deposit_required' => 250,
                    'friends_required' => 15,
                    'reward'=>175
                ],
                [
                    'level_number' => 7,
                    'deposit_required' => 500,
                    'friends_required' => 18,
                    'reward'=>250
                ],
                [
                    'level_number' => 8,
                    'deposit_required' => 900,
                    'friends_required' => 24,
                    'reward'=>450
                ],
                [
                    'level_number' => 9,
                    'deposit_required' => 1500,
                    'friends_required' => 28,
                    'reward'=>750
                ],
            ]);
    }
}
