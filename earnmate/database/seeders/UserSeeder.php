<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Reference;
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
        $fakr = \Faker\Factory::create();
        $users = [
            [
                'name' => 'Yassine Abdelali',
                'email' => 'af8356207@gmail.com',
                'password' => Hash::make('12345678'),
                'code' => $this->generateUniqueCode(),
                'balance' => 9.83
            ],
            [
                'name' => 'Aissani Med',
                'email' => 'akramfadel867@gmail.com',
                'password' => Hash::make('12345678'),
                'code' => $this->generateUniqueCode(),
                'balance' => 11.3

            ],
            [
                'name' => 'Hako bn',
                'email' => 'akramfadel@gmail.com',
                'password' => Hash::make('12345678'),
                'code' => $this->generateUniqueCode(),
                'balance' => 4.12


            ],
        ];
       
        foreach ($users as $user) {
            User::create($user);
        }
        $admin = [
            'user_id' => 1,
            'baridi_balance' => 0.00,
            'binance_balance' => 0.00,
            'RIP' => '00799999002912096764'
        ];
        Admin::create($admin);
        $users = [];

        $firstNames = [
            'kader', 'Med', 'Youssef', 'Zaki', 'hmida', 'Mourad','James', 'John', 'Robert', 'Michael', 'William',
            'David', 'Richard', 'Joseph', 'Thomas', 'Charles',
            'Mary', 'Patricia', 'Jennifer', 'Linda', 'Elizabeth',
            'Barbara', 'Susan', 'Jessica', 'Sarah', 'Karen',
            'Nancy', 'Lisa', 'Betty', 'Margaret', 'Sandra',
            'Ashley', 'Kimberly', 'Emily', 'Donna', 'Michelle'
        ];

        $lastNames = [
            'Smith', 'Johnson', 'Williams', 'Brown', 'Jones',
            'Miller', 'Davis', 'Garcia', 'Rodriguez', 'Martinez',
            'Hernandez', 'Lopez', 'Gonzalez', 'Wilson', 'Anderson',
            'Thomas', 'Taylor', 'Moore', 'Jackson', 'Martin',
            'Lee', 'Perez', 'Thompson', 'White', 'Harris',
            'Sanchez', 'Clark', 'Ramirez', 'Lewis', 'Robinson',
            'Walker', 'Young', 'Allen', 'King', 'Wright',
            'Scott', 'Torres', 'Nguyen', 'Hill', 'Flores',
            'Green', 'Adams', 'Nelson', 'Baker', 'Hall',
            'Rivera', 'Campbell', 'Mitchell', 'Carter', 'Roberts',
            'Gomez', 'Phillips', 'Evans', 'Turner', 'Diaz',
            'Parker', 'Cruz', 'Edwards', 'Collins', 'Reyes',
            'Stewart', 'Morris', 'Morales', 'Murphy', 'Cook',
            'Rogers', 'Gutierrez', 'Ortiz', 'Morgan', 'Cooper',
            'Peterson', 'Bailey', 'Reed', 'Kelly', 'Howard',
            'Ramos', 'Kim', 'Cox', 'Ward', 'Richardson',
            'Watson', 'Brooks', 'Chavez', 'Wood', 'James',
            'Bennett', 'Gray', 'Mendoza', 'Ruiz', 'Hughes',
            'Price', 'Alvarez', 'Castillo', 'Sanders', 'Patel'
        ];
        $users = [1];
        for ($i = 0; $i < 100; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $fullName = $firstName . ' ' . $lastName;
            $email = strtolower(str_replace(' ', '', $fullName)) . rand(1000, 9999) . '@gmail.com';
            $balance = round(rand(300, 15000) / 100, 2); // Random balance between 3.00 and 150.00
            User::create([
                'name' => $fullName,
                'email' => $email,
                'password' => Hash::make('12345678'),
                'code' => $this->generateUniqueCode(), // Generate a random unique code
                'balance' => $balance,
                'created_at' => $fakr->dateTimeBetween('-2 weeks', 'now'),
            ]);
        }
        $users = User::pluck('id')->toArray();
       for ($i=0; $i < 300; $i++) { 
        Reference::create([
            'referrer_id' => $fakr->randomElement($users),
            'referenced_id' => $fakr->randomElement($users)
        ]);
       }
        
    }
}
