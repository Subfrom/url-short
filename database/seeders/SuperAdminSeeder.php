<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'username' => 'Dev', 
            'email' => 'Dev@test.cc',
            'password' => Hash::make('123456')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'username' => 'Admin User', 
            'email' => 'admin@test.cc',
            'password' => Hash::make('1231456')
        ]);
        $admin->assignRole('Admin');
    }
}
