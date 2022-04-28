<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\BboardController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/dashboard', [BboardController::class, 'home'])->name('dashboard.home');
// Route::get('/dashboard/{page}', [MenuController::class, 'getMenu'])->name('dashboard.getMenu');


Route::prefix('dashboard')->group(function () {
    Route::resource('bboards', BboardController::class);
    Route::resource('users', UserController::class);
});
