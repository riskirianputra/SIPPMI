<?php

Route::get('/home', 'HomeController@index')->name('user.home');

Route::resource('prn-fokus', 'PrnFokusController');
Route::delete('prn-fokus/destroy', 'PrnFokusController@massDestroy')->name('prn-fokus.massDestroy');

/** PENELITIAN */
Route::post('penelitian/{penelitian}/submit', 'PenelitianController@submit')->name('penelitians.submit');
Route::get('penelitian/{penelitian}/review', 'PenelitianController@review')->name('penelitians.review');
Route::get('penelitian/{penelitian}/eksekutif', 'PenelitianController@eksekutif')->name('penelitians.eksekutif');
Route::post('penelitian/{penelitian}/eksekutif', 'PenelitianController@storeringkasan')->name('penelitians.storeeksekutif');

Route::resource('penelitians', 'PenelitianController');
Route::resource('penelitian.anggota', 'PenelitianAnggotaController');
Route::post('penelitian/{id}/anggota/mahasiswa-store','PenelitianAnggotaController@mahasiswaStore')->name('penelitian.anggota-mahasiswa.store');

/** PENGABDIAN */
Route::post('pengabdian/{pengabdian}/submit', 'PengabdianController@submit')->name('pengabdians.submit');
Route::get('pengabdian/{pengabdian}/review', 'PengabdianController@review')->name('pengabdians.review');
Route::get('pengabdian/{pengabdian}/eksekutif', 'PengabdianController@eksekutif')->name('pengabdians.eksekutif');
Route::post('pengabdian/{pengabdian}/eksekutif', 'PengabdianController@storeringkasan')->name('pengabdians.storeeksekutif');

Route::resource('pengabdians', 'PengabdianController');
Route::resource('pengabdian.anggota', 'PengabdianAnggotaController');
Route::post('pengabdian/{id}/anggota/mahasiswa-store','PengabdianAnggotaController@mahasiswaStore')->name('pengabdians.anggota-mahasiswa.store');

/** PEMAKALAH */
Route::post('pemakalah/{pemakalah}/submit', 'PemakalahController@submit')->name('pemakalahs.submit');
Route::get('pemakalah/{pemakalah}/review', 'PemakalahController@review')->name('pemakalahs.review');

Route::resource('pemakalahs', 'PemakalahController');
Route::resource('pemakalah.anggota', 'PemakalahAnggotaController');
Route::post('pemakalahs/{id}/anggota/mahasiswa-store', 'PemakalahAnggotaController@mahasiswaStore')->name('pemakalah.anggota-mahasiswa.store');

/** REVIEW PENELITIAN */
Route::get('review-penelitians', 'ReviewPenelitianController@index')->name('review-penelitians.index');
Route::post('review-penelitians/filter', 'ReviewPenelitianController@filter')->name('review-penelitians.filter');
Route::get('review-penelitians/{usulan}/edit', 'ReviewPenelitianController@edit')->name('review-penelitians.edit');
Route::patch('review-penelitians/{usulan}', 'ReviewPenelitianController@update')->name('review-penelitians.update');

/** REVIEW PENGABDIAN */
Route::get('review-pengabdians', 'ReviewPengabdianController@index')->name('review-pengabdians.index');
Route::post('review-pengabdians/filter', 'ReviewPengabdianController@filter')->name('review-pengabdians.filter');
Route::get('review-pengabdians/{usulan}/edit', 'ReviewPengabdianController@edit')->name('review-pengabdians.edit');
Route::patch('review-pengabdians/{usulan}', 'ReviewPengabdianController@update')->name('review-pengabdians.update');
