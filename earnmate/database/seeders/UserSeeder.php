<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public  function generateUniqueCode()
    {
    
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;
    
        $code = '';
    
        while (strlen($code) < 8) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }
    
        if (User::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }
    
        return $code;
    
    }
    public function run(): void
    {
        $users = [
            [
                'name' => 'Akram Admin',
                'email' => 'af8356207@gmail.com',
                'password' => Hash::make('12345678'),
                'code' => $this->generateUniqueCode(),
                'balance' => 0.00
            ],
            [
                'name' => 'Akram 1',
                'email' => 'akramfadel867@gmail.com',
                'password' => Hash::make('12345678'),
                'code' => $this->generateUniqueCode(),
                'balance' => 0.00

            ],
            [
                'name' => 'Akram 2',
                'email' => 'akramfadel@gmail.com',
                'password' => Hash::make('12345678'),
                'code' => $this->generateUniqueCode(),
                'balance' => 0.00


            ],
        ];
        $admin = [
            'user_id' => 1,
            'baridi_balance' => 0.00,
            'binance_balance' => 0.00,
            'RIP' => '12345679'
        ];
        foreach ($users as $user) {
            User::create($user);
        }
        Admin::create($admin);
    }
}
