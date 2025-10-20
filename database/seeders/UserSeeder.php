<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Ridho Pratama',
            'username' => 'ridhopratama',
            'email' => 'ridhopratama27051@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Ridho')
        ]);

        User::factory(5)->create();

    }


}
