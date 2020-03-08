<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Penelitians
    Route::post('penelitians/media', 'PenelitianApiController@storeMedia')->name('penelitians.storeMedia');
    Route::apiResource('penelitians', 'PenelitianApiController');

    // Dosens
    Route::apiResource('dosens', 'DosenApiController');

    // Kode Rumpuns
    Route::apiResource('kode-rumpuns', 'KodeRumpunApiController');

    // Penelitian Anggota
    Route::apiResource('penelitian-anggota', 'PenelitianAnggotaApiController');

    // Staff
    Route::apiResource('staff', 'StaffApiController');

    // Fakulta
    Route::apiResource('fakulta', 'FakultasApiController', ['except' => ['show']]);

    // Prodis
    Route::apiResource('prodis', 'ProdiApiController');

    // Pengabdians
    Route::post('pengabdians/media', 'PengabdianApiController@storeMedia')->name('pengabdians.storeMedia');
    Route::apiResource('pengabdians', 'PengabdianApiController');

    // Pengabdian Anggota
    Route::apiResource('pengabdian-anggota', 'PengabdianAnggotaApiController');

    // Usulans
    Route::apiResource('usulans', 'UsulanApiController');

    // Rip Temas
    Route::post('rip-temas/media', 'RipTemaApiController@storeMedia')->name('rip-temas.storeMedia');
    Route::apiResource('rip-temas', 'RipTemaApiController');

    // Rip Sub Temas
    Route::apiResource('rip-sub-temas', 'RipSubTemaApiController');

    // Rip Topiks
    Route::post('rip-topiks/media', 'RipTopikApiController@storeMedia')->name('rip-topiks.storeMedia');
    Route::apiResource('rip-topiks', 'RipTopikApiController');

    // Rip Sub Topiks
    Route::apiResource('rip-sub-topiks', 'RipSubTopikApiController');

    // Rip Tahapans
    Route::post('rip-tahapans/media', 'RipTahapanApiController@storeMedia')->name('rip-tahapans.storeMedia');
    Route::apiResource('rip-tahapans', 'RipTahapanApiController');

    // Jenis Usulans
    Route::apiResource('jenis-usulans', 'JenisUsulanApiController');

    // Ref Skemas
    Route::apiResource('ref-skemas', 'RefSkemaApiController');

    // Outputs
    Route::apiResource('outputs', 'OutputApiController');

    // Output Skemas
    Route::apiResource('output-skemas', 'OutputSkemaApiController');

    // Penelitian Outputs
    Route::apiResource('penelitian-outputs', 'PenelitianOutputApiController');

    // Pengabdian Outputs
    Route::apiResource('pengabdian-outputs', 'PengabdianOutputApiController');

    // Komponen Biayas
    Route::apiResource('komponen-biayas', 'KomponenBiayaApiController');

    // Biaya Skemas
    Route::apiResource('biaya-skemas', 'BiayaSkemaApiController');

    // Penelitian Biayas
    Route::apiResource('penelitian-biayas', 'PenelitianBiayaApiController');

    // Pengabdian Biayas
    Route::apiResource('pengabdian-biayas', 'PengabdianBiayaApiController');

    // Reviewers
    Route::post('reviewers/media', 'ReviewerApiController@storeMedia')->name('reviewers.storeMedia');
    Route::apiResource('reviewers', 'ReviewerApiController');

    // Tahapan Reviews
    Route::apiResource('tahapan-reviews', 'TahapanReviewApiController');

    // Penelitian Reviewers
    Route::apiResource('penelitian-reviewers', 'PenelitianReviewerApiController');
});
