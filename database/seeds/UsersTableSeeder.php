<?php

use App\Dosen;
use App\User;
use App\Staff;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'username' => 'superadmin',
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$u19vPvVN/DnMqyrj5K0CzONZ8gyzZ1gDZYPFa8YbXT3iwP9RqKDGG',
                'remember_token' => null,
            ],
        ];

        $admin = User::insert($users);
        User::findOrFail(1)->roles()->sync(1);
    }
}
