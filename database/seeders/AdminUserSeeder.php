<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@foundu.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'whatsapp' => '081234567890',
        ]);
    }
}
