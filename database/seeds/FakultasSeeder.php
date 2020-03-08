<?php

use App\Fakultum;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakultases = [
            [
                "id" => 1,
                "nama" => "Pertanian",
                "singkatan" => "Pertanian",
                "kode" => NULL,
            ],
            [
                "id" => 2,
                "nama" => "Kedokteran",
                "singkatan" => "Kedokteran",
                "kode" => NULL,
            ],
            [
                "id" => 3,
                "nama" => "Matematika dan Ilmu Pengetahuan Alam",
                "singkatan" => "Matematika dan Ilmu Pengetahuan Alam",
                "kode" => NULL,
            ],
            [
                "id" => 4,
                "nama" => "Hukum",
                "singkatan" => "Hukum",
                "kode" => NULL,
            ],
            [
                "id" => 5,
                "nama" => "Ekonomi",
                "singkatan" => "Ekonomi",
                "kode" => NULL,
            ],
            [
                "id" => 6,
                "nama" => "Peternakan",
                "singkatan" => "Peternakan",
                "kode" => NULL,
            ],
            [
                "id" => 7,
                "nama" => "Teknik",
                "singkatan" => "Teknik",
                "kode" => NULL,
            ],
            [
                "id" => 8,
                "nama" => "Ilmu Budaya",
                "singkatan" => "Ilmu Budaya",
                "kode" => NULL,
            ],
            [
                "id" => 9,
                "nama" => "Ilmu Sosial dan Ilmu Politik",
                "singkatan" => "Ilmu Sosial dan Ilmu Politik",
                "kode" => NULL,
            ],
            [
                "id" => 10,
                "nama" => "Farmasi",
                "singkatan" => "Farmasi",
                "kode" => NULL,
            ],
            [
                "id" => 11,
                "nama" => "Teknologi Pertanian",
                "singkatan" => "Teknologi Pertanian",
                "kode" => NULL,
            ],
            [
                "id" => 12,
                "nama" => "Kesehatan Masyarakat",
                "singkatan" => "Kesehatan Masyarakat",
                "kode" => NULL,
            ],
            [
                "id" => 13,
                "nama" => "Keperawatan",
                "singkatan" => "Keperawatan",
                "kode" => NULL,
            ],
            [
                "id" => 14,
                "nama" => "Kedokteran Gigi",
                "singkatan" => "Kedokteran Gigi",
                "kode" => NULL,
            ],
            [
                "id" => 15,
                "nama" => "Teknologi Informasi",
                "singkatan" => "Teknologi Informasi",
                "kode" => NULL,
            ],
            [
                "id" => 16,
                "nama" => "Pasca Sarjana ",
                "singkatan" => "Pasca Sarjana ",
                "kode" => NULL,
            ],
        ];

        Fakultum::insert($fakultases);

    }
}
