<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersArray = [
            [
                'name' => 'Admin',
                'email' => 'Admin@admin.com',
                'role' => 1,
                'password' => '1q2w3e4r'],
            [
                'name' => 'User',
                'email' => 'User@user.com',
                'role' => 2,
                'password' => '1q2w3e4r'
            ]
        ];
        foreach ($usersArray as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'role_id' => $user['role'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
