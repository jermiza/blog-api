<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Nika Jermizashvili',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
            ],
        ];
        User::insert($users);
    }
}
