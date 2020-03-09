<?php

use App\Staff;
use App\User;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Staff LPPM
        $staffs = [
            [
                "nama" => "Rahmadi",
                "nip" => "197605182001121001",
                "email" => "rahmadi_76@yahoo.co.id",
                "tempat_lahir" => "Asahan",
                "tanggal_lahir" => "1976-05-18",
                "status" => "1",
                "jenis_kelamin" => "Laki-laki",
                "telepon" => "08126628344",
            ],
        ];

        foreach ($staffs as $staff) {
            $user = User::create([
                'username' => $staff['nip'],
                'password' => bcrypt($staff['nip']),
                'name' => $staff['nama'],
                'email' => $staff['email']
            ]);

            $user->roles()->sync(2);

            $user_staff = Staff::create([
                'id' => $user->id,
                'nama' => $staff['nama'],
                'nip' => $staff['nip'],
                'tempat_lahir' => $staff['tempat_lahir'],
                'tanggal_lahir' => $staff['tanggal_lahir'],
                'status' => $staff['status'],
                'email' => $staff['email'],
                'jenis_kelamin' => $staff['jenis_kelamin'],
                'telepon' => $staff['telepon']
            ]);
        }
    }
}
