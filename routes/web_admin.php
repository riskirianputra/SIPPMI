<?php
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('user-alerts/read', 'UserAlertsController@read');
// Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

// Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

// Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

// User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

// Penelitians
    Route::get('penelitians/export', 'PenelitianExportController@export')->name('penelitian.export');
    Route::post('penelitians/filter', 'PenelitianController@filter')->name('penelitians.filter');
    Route::delete('penelitians/destroy', 'PenelitianController@massDestroy')->name('penelitians.massDestroy');
    Route::post('penelitians/media', 'PenelitianController@storeMedia')->name('penelitians.storeMedia');
    Route::post('penelitians/ckmedia', 'PenelitianController@storeCKEditorImages')->name('penelitians.storeCKEditorImages');
    Route::resource('penelitians', 'PenelitianController');

    Route::get('proposal-monitor/rekap-dosen', 'ProposalMonitoringController@dosen_index')->name('proposal-monitor.dosen-index');
    Route::post('proposal-monitor/rekap-dosen', 'ProposalMonitoringController@dosen_filter')->name('propsosal-monitor.dosen-filter');

    Route::get('monitoring-reviews/index', 'MonitoringReviewController@progress')->name('monitoring-reviews.progress');
    Route::post('monitoring-reviews/index', 'MonitoringReviewController@post_progress')->name('monitoring-reviews.post_progress');

    // Pengabdians
    Route::post('pengabdians/filter', 'PengabdianController@filter')->name('pengabdians.filter');
    Route::delete('pengabdians/destroy', 'PengabdianController@massDestroy')->name('pengabdians.massDestroy');
    Route::post('pengabdians/media', 'PengabdianController@storeMedia')->name('pengabdians.storeMedia');
    Route::post('pengabdians/ckmedia', 'PengabdianController@storeCKEditorImages')->name('pengabdians.storeCKEditorImages');
    Route::resource('pengabdians', 'PengabdianController');

    // Kinerja - Pemakalah
    Route::post('pemakalah/filter', 'PemakalahController@filter')->name('pemakalahs.filter');
    Route::resource('pemakalahs', 'PemakalahController');

// Dosens
    Route::delete('dosens/destroy', 'DosenController@massDestroy')->name('dosens.massDestroy');
    Route::resource('dosens', 'DosenController');

    //Dosen Skema
    Route::resource('dosens.skemas', 'DosenSkemaController');

// Kode Rumpuns
    Route::delete('kode-rumpuns/destroy', 'KodeRumpunController@massDestroy')->name('kode-rumpuns.massDestroy');
    Route::resource('kode-rumpuns', 'KodeRumpunController');

// Penelitian Anggota
    Route::delete('penelitian-anggota/destroy', 'PenelitianAnggotaController@massDestroy')->name('penelitian-anggota.massDestroy');
    Route::resource('penelitian-anggota', 'PenelitianAnggotaController');

// Staff
    Route::delete('staff/destroy', 'StaffController@massDestroy')->name('staff.massDestroy');
    Route::resource('staff', 'StaffController');

// Fakulta
    Route::delete('fakulta/destroy', 'FakultasController@massDestroy')->name('fakulta.massDestroy');
    Route::resource('fakulta', 'FakultasController', ['except' => ['show']]);

// Prodis
    Route::delete('prodis/destroy', 'ProdiController@massDestroy')->name('prodis.massDestroy');
    Route::resource('prodis', 'ProdiController');


// Pengabdian Anggota
    Route::delete('pengabdian-anggota/destroy', 'PengabdianAnggotaController@massDestroy')->name('pengabdian-anggota.massDestroy');
    Route::resource('pengabdian-anggota', 'PengabdianAnggotaController');

// Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

// Usulans
    Route::delete('usulans/destroy', 'UsulanController@massDestroy')->name('usulans.massDestroy');
    Route::resource('usulans', 'UsulanController');

// Rip Temas
    Route::delete('rip-temas/destroy', 'RipTemaController@massDestroy')->name('rip-temas.massDestroy');
    Route::post('rip-temas/media', 'RipTemaController@storeMedia')->name('rip-temas.storeMedia');
    Route::post('rip-temas/ckmedia', 'RipTemaController@storeCKEditorImages')->name('rip-temas.storeCKEditorImages');
    Route::resource('rip-temas', 'RipTemaController');

// Rip Sub Temas
    Route::delete('rip-sub-temas/destroy', 'RipSubTemaController@massDestroy')->name('rip-sub-temas.massDestroy');
    Route::resource('rip-sub-temas', 'RipSubTemaController');

// Rip Topiks
    Route::delete('rip-topiks/destroy', 'RipTopikController@massDestroy')->name('rip-topiks.massDestroy');
    Route::post('rip-topiks/media', 'RipTopikController@storeMedia')->name('rip-topiks.storeMedia');
    Route::post('rip-topiks/ckmedia', 'RipTopikController@storeCKEditorImages')->name('rip-topiks.storeCKEditorImages');
    Route::resource('rip-topiks', 'RipTopikController');

// Rip Sub Topiks
    Route::delete('rip-sub-topiks/destroy', 'RipSubTopikController@massDestroy')->name('rip-sub-topiks.massDestroy');
    Route::resource('rip-sub-topiks', 'RipSubTopikController');

// Rip Tahapans
    Route::delete('rip-tahapans/destroy', 'RipTahapanController@massDestroy')->name('rip-tahapans.massDestroy');
    Route::post('rip-tahapans/media', 'RipTahapanController@storeMedia')->name('rip-tahapans.storeMedia');
    Route::post('rip-tahapans/ckmedia', 'RipTahapanController@storeCKEditorImages')->name('rip-tahapans.storeCKEditorImages');
    Route::resource('rip-tahapans', 'RipTahapanController');

// Jenis Usulans
    Route::delete('jenis-usulans/destroy', 'JenisUsulanController@massDestroy')->name('jenis-usulans.massDestroy');
    Route::resource('jenis-usulans', 'JenisUsulanController');

// Ref Skemas
    Route::delete('ref-skemas/destroy', 'RefSkemaController@massDestroy')->name('ref-skemas.massDestroy');
    Route::resource('ref-skemas', 'RefSkemaController');

    Route::resource('ref-skemas.questions', 'RefSkemaQuestionController');

// Outputs
    Route::delete('outputs/destroy', 'OutputController@massDestroy')->name('outputs.massDestroy');
    Route::resource('outputs', 'OutputController');

// Output Skemas
    Route::delete('{skema_id}/output-skemas/destroy', 'OutputSkemaController@massDestroy')->name('output-skemas.massDestroy');
    Route::resource('{skema_id}/output-skemas', 'OutputSkemaController');

// Penelitian Outputs
    Route::delete('penelitian-outputs/destroy', 'PenelitianOutputController@massDestroy')->name('penelitian-outputs.massDestroy');
    Route::resource('penelitian-outputs', 'PenelitianOutputController');

// Pengabdian Outputs
    Route::delete('pengabdian-outputs/destroy', 'PengabdianOutputController@massDestroy')->name('pengabdian-outputs.massDestroy');
    Route::resource('pengabdian-outputs', 'PengabdianOutputController');

// Komponen Biayas
    Route::delete('komponen-biayas/destroy', 'KomponenBiayaController@massDestroy')->name('komponen-biayas.massDestroy');
    Route::resource('komponen-biayas', 'KomponenBiayaController');

// Biaya Skemas
    Route::delete('biaya-skemas/destroy', 'BiayaSkemaController@massDestroy')->name('biaya-skemas.massDestroy');
    Route::resource('biaya-skemas', 'BiayaSkemaController');

// Penelitian Biayas
    Route::delete('penelitian-biayas/destroy', 'PenelitianBiayaController@massDestroy')->name('penelitian-biayas.massDestroy');
    Route::resource('penelitian-biayas', 'PenelitianBiayaController');

// Pengabdian Biayas
    Route::delete('pengabdian-biayas/destroy', 'PengabdianBiayaController@massDestroy')->name('pengabdian-biayas.massDestroy');
    Route::resource('pengabdian-biayas', 'PengabdianBiayaController');

// Reviewers
    Route::get('reviewers', 'ReviewerController@index')->name('reviewers.index');
    Route::post('reviewers/create', 'ReviewerController@store')->name('reviewers.store');
    Route::put('reviewers/update/{id}', 'ReviewerController@update')->name('reviewers.update');
    Route::delete('reviewers/delete/{id}', 'ReviewerController@destroy')->name('reviewers.destroy');

// Tahapan Reviews
    Route::delete('tahapan-reviews/destroy', 'TahapanReviewController@massDestroy')->name('tahapan-reviews.massDestroy');
    Route::resource('tahapan-reviews', 'TahapanReviewController')
        ->except(['show']);

// Penelitian Reviewers
    Route::delete('penelitian-reviewers/destroy', 'PenelitianReviewerController@massDestroy')->name('penelitian-reviewers.massDestroy');
    Route::resource('penelitian-reviewers', 'PenelitianReviewerController');

    Route::get('usulan/{penelitian}/komentar/{komentar}/close', 'UsulanKomentarController@close')->name('usulan.komentars.close');
    Route::get('usulan/{penelitian}/komentar/{komentar}/open', 'UsulanKomentarController@open')->name('usulan.komentars.open');
    Route::resource('usulan.komentars', 'UsulanKomentarController');

// Plotting Reviewer
    Route::get('plotting-reviewers', 'PlottingReviewerController@index')->name('plotting-reviewers.index');
    Route::get('plotting-reviewers/reviewer/{tahapan_review_id}/{usulan_id}', 'PlottingReviewerController@getReviewer')->name('plotting-reviewers.reviewer');
    Route::get('plotting-reviewers/rekapitulasi', 'PlottingReviewerController@rekapitulasi')->name('plotting-reviewers.rekapitulasi');
    Route::post('plotting-reviewers', 'PlottingReviewerController@filter')->name('plotting-reviewers.filter');
    Route::post('plotting-reviewers/plot', 'PlottingReviewerController@plotReviewer')->name('plotting-reviewers.plot');
    Route::delete('plotting-reviewers/{id}/plot', 'PlottingReviewerController@deletePlotReviewer')->name('plotting-reviewers.delete');
});
