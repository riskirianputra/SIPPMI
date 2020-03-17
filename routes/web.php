<?php

Route::redirect('/', '/login');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);
Route::resource('profil', 'ProfilController');

Route::get('password', 'PasswordController@edit')->name('password.edit');
Route::put('password', 'PasswordController@update')->name('password.update');

require('web_user.php');
require('web_admin.php');
