<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //  $withdrawal->processed_at = Carbon::now();

    public function run(): void
    {
        $fakr = \Faker\Factory::create();

        $users = User::pluck('id')->toArray();
        $admins = Admin::pluck('id')->toArray();
        $methods = ['baridi','binance','bybit'];
        $destination = '123456789';
        for ($i=0; $i < 300; $i++) { 
            Withdrawal::create([
                'user_id' => $fakr->randomElement($users),
                'admin_id' => $fakr->randomElement($admins),
                'amount'=> $fakr->randomFloat(3,3.00,45.00),
                'method' => $fakr->randomElement($methods),
                'destination' => $destination,
                'processed_at' => Carbon::now(),
                'price' => 254,
                'status'=> 'completed'
            ]);
        }
    }
}
