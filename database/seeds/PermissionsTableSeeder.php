<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                "id" => 1,
                "title" => "user_management_view",
            ],
            [
                "id" => 2,
                "title" => "permission_view",
            ],
            [
                "id" => 3,
                "title" => "permission_manage",
            ],
            [
                "id" => 4,
                "title" => "role_view",
            ],
            [
                "id" => 5,
                "title" => "role_manage",
            ],
            [
                "id" => 6,
                "title" => "user_view",
            ],
            [
                "id" => 7,
                "title" => "user_manage",
            ],
            [
                "id" => 8,
                "title" => "user_show",
            ],
            [
                "id" => 9,
                "title" => "penelitian_create",
            ],
            [
                "id" => 10,
                "title" => "penelitian_view",
            ],
            [
                "id" => 11,
                "title" => "penelitian_manage",
            ],
            [
                "id" => 12,
                "title" => "dosen_create",
            ],
            [
                "id" => 13,
                "title" => "dosen_view",
            ],
            [
                "id" => 14,
                "title" => "dosen_manage",
            ],
            [
                "id" => 15,
                "title" => "referensi_view",
            ],
            [
                "id" => 16,
                "title" => "kode_rumpun_view",
            ],
            [
                "id" => 17,
                "title" => "kode_rumpun_manage",
            ],
            [
                "id" => 18,
                "title" => "penelitian_anggotum_view",
            ],
            [
                "id" => 19,
                "title" => "penelitian_anggotum_manage",
            ],
            [
                "id" => 20,
                "title" => "staff_view",
            ],
            [
                "id" => 21,
                "title" => "staff_manage",
            ],
            [
                "id" => 22,
                "title" => "fakultum_view",
            ],
            [
                "id" => 23,
                "title" => "fakultum_manage",
            ],
            [
                "id" => 24,
                "title" => "prodi_view",
            ],
            [
                "id" => 25,
                "title" => "prodi_manage",
            ],
            [
                "id" => 26,
                "title" => "pengabdian_view",
            ],
            [
                "id" => 27,
                "title" => "pengabdian_manage",
            ],
            [
                "id" => 28,
                "title" => "pengabdian_anggotum_view",
            ],
            [
                "id" => 29,
                "title" => "pengabdian_anggotum_manage",
            ],
            [
                "id" => 30,
                "title" => "audit_log_view",
            ],
            [
                "id" => 31,
                "title" => "audit_log_manage",
            ],
            [
                "id" => 32,
                "title" => "usulan_view",
            ],
            [
                "id" => 33,
                "title" => "usulan_manage",
            ],
            [
                "id" => 34,
                "title" => "rencana_induk_access",
            ],
            [
                "id" => 35,
                "title" => "rip_tema_view",
            ],
            [
                "id" => 36,
                "title" => "rip_tema_manage",
            ],
            [
                "id" => 37,
                "title" => "rip_sub_tema_view",
            ],
            [
                "id" => 38,
                "title" => "rip_sub_tema_manage",
            ],
            [
                "id" => 39,
                "title" => "rip_topik_view",
            ],
            [
                "id" => 40,
                "title" => "rip_topik_manage",
            ],
            [
                "id" => 41,
                "title" => "rip_sub_topik_view",
            ],
            [
                "id" => 42,
                "title" => "rip_sub_topik_manage",
            ],
            [
                "id" => 43,
                "title" => "rip_tahapan_view",
            ],
            [
                "id" => 44,
                "title" => "rip_tahapan_manage",
            ],
            [
                "id" => 45,
                "title" => "jenis_usulan_view",
            ],
            [
                "id" => 46,
                "title" => "jenis_usulan_manage",
            ],
            [
                "id" => 47,
                "title" => "ref_skema_view",
            ],
            [
                "id" => 48,
                "title" => "ref_skema_manage",
            ],
            [
                "id" => 49,
                "title" => "output_view",
            ],
            [
                "id" => 50,
                "title" => "output_manage",
            ],
            [
                "id" => 51,
                "title" => "output_skema_view",
            ],
            [
                "id" => 52,
                "title" => "output_skema_manage",
            ],
            [
                "id" => 53,
                "title" => "penelitian_output_view",
            ],
            [
                "id" => 54,
                "title" => "penelitian_output_manage",
            ],
            [
                "id" => 55,
                "title" => "pengabdian_output_view",
            ],
            [
                "id" => 56,
                "title" => "pengabdian_output_manage",
            ],
            [
                "id" => 57,
                "title" => "konfigurasi_access",
            ],
            [
                "id" => 58,
                "title" => "komponen_biaya_view",
            ],
            [
                "id" => 59,
                "title" => "komponen_biaya_manage",
            ],
            [
                "id" => 60,
                "title" => "biaya_skema_view",
            ],
            [
                "id" => 61,
                "title" => "biaya_skema_manage",
            ],
            [
                "id" => 62,
                "title" => "penelitian_biaya_view",
            ],
            [
                "id" => 63,
                "title" => "penelitian_biaya_manage",
            ],
            [
                "id" => 64,
                "title" => "pengabdian_biaya_view",
            ],
            [
                "id" => 65,
                "title" => "pengabdian_biaya_manage",
            ],
            [
                "id" => 66,
                "title" => "konfigurasi_reviewer_access",
            ],
            [
                "id" => 67,
                "title" => "reviewer_view",
            ],
            [
                "id" => 68,
                "title" => "reviewer_manage",
            ],
            [
                "id" => 69,
                "title" => "tahapan_review_view",
            ],
            [
                "id" => 70,
                "title" => "tahapan_review_manage",
            ],
            [
                "id" => 71,
                "title" => "penelitian_reviewer_view",
            ],
            [
                "id" => 72,
                "title" => "penelitian_reviewer_manage",
            ],
            [
                "id" => 73,
                "title" => "penelitian_user_manage",
            ],
            [
                "id" => 74,
                "title" => "pengabdian_user_manage",
            ],
            [
                "id" => 75,
                "title" => "prn_fokus_view"
            ],
            [
                "id" => 76,
                "title" => "prn_fokus_manage"
            ],
            [
                "id" => 77,
                "title" => "pengelolaan_peneltian_view"
            ],
            [
                "id" => 78,
                "title" => "pengelolaan_pengabdian_view"
            ],
            [
                "id" => 79,
                "title" => "plotting_reviewer_view"
            ],
            [
                "id" => 80,
                "title" => "plotting_reviewer_manage"
            ],
        ];

        Permission::insert($permissions);
    }
}
