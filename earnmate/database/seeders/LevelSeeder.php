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
                    'deposit_required' => 5,
                    'friends_required' => 0,
                    'reward'=>2.5
                ],
                [
                    'level_number' => 2,
                    'deposit_required' => 10,
                    'friends_required' => 2,
                    'reward'=>5
                ],
                [
                    'level_number' => 3,
                    'deposit_required' => 20,
                    'friends_required' => 4,
                    'reward'=>10
                ],
                [
                    'level_number' => 4,
                    'deposit_required' => 50,
                    'friends_required' => 6,
                    'reward'=>25
                ],
                [
                    'level_number' => 5,
                    'deposit_required' => 100,
                    'friends_required' => 10,
                    'reward'=>50
                ],
                [
                    'level_number' => 6,
                    'deposit_required' => 200,
                    'friends_required' => 15,
                    'reward'=>100
                ],
                [
                    'level_number' => 7,
                    'deposit_required' => 400,
                    'friends_required' => 18,
                    'reward'=>200
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
