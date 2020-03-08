<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
//            RoleUserTableSeeder::class,
            KodeRumpunTableSeeder::class,
            FakultasSeeder::class,
            ProdiSeeder::class,
            UsersTableSeeder::class,
            StaffSeeder::class,
            DosenSeeder::class,
        ]);
    }
}
