<?php

Route::redirect('/', '/login');
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', function () {
////    if (session('status')) {
////        return redirect()->route('admin.home')->with('status', session('status'));
////    }
//
//    return redirect()->route('admin.home');
//})->name('home');

Auth::routes(['register' => false]);

require('web_user.php');
require('web_admin.php');
