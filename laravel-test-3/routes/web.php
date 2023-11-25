<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $sameFiles = FileService::getSameFiles(
        '/var/www/html/mirai-test/laravel-test-3/config',
        '/var/www/html/mirai-test/laravel-test-3/bootstrap');
    dd($sameFiles);
});
