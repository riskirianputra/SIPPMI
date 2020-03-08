<?php

Route::get('/home', 'HomeController@index')->name('user.home');

Route::post('penelitian/{penelitian}/submit', 'PenelitianController@submit')->name('penelitians.submit');
Route::get('penelitian/{penelitian}/review', 'PenelitianController@review')->name('penelitians.review');
Route::get('penelitian/{penelitian}/eksekutif', 'PenelitianController@eksekutif')->name('penelitians.eksekutif');
Route::post('penelitian/{penelitian}/eksekutif', 'PenelitianController@storeringkasan')->name('penelitians.storeeksekutif');

Route::resource('penelitians', 'PenelitianController');
Route::resource('penelitian.anggota', 'PenelitianAnggotaController');
Route::post('penelitian/{id}/anggota/mahasiswa-store','PenelitianAnggotaController@mahasiswaStore')->name('penelitian.anggota-mahasiswa.store');

Route::post('pengabdian/{pengabdian}/submit', 'PengabdianController@submit')->name('pengabdians.submit');
Route::get('pengabdian/{pengabdian}/review', 'PengabdianController@review')->name('pengabdians.review');
Route::get('pengabdian/{pengabdian}/eksekutif', 'PengabdianController@eksekutif')->name('pengabdians.eksekutif');
Route::post('pengabdian/{pengabdian}/eksekutif', 'PengabdianController@storeringkasan')->name('pengabdians.storeeksekutif');


Route::resource('pengabdians', 'PengabdianController');
Route::resource('pengabdian.anggota', 'PengabdianAnggotaController');
Route::post('pengabdian/{id}/anggota/mahasiswa-store','PengabdianAnggotaController@mahasiswaStore')->name('pengabdians.anggota-mahasiswa.store');

Route::resource('prn-fokus', 'PrnFokusController');
Route::delete('prn-fokus/destroy', 'PrnFokusController@massDestroy')->name('prn-fokus.massDestroy');
