<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Administrator',
            ],
            [
                'id'    => 2,
                'title' => 'Admin LPPM'
            ],
            [
                'id'    => 3,
                'title' => 'Dosen',
            ],
            [
                'id'    => 4,
                'title' => 'Reviewer'
            ]
        ];

        Role::insert($roles);
    }
}
