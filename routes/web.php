<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
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

Route::get('/dashboard', [MenuController::class, 'index']);
Route::get('/dashboard/{page}', [MenuController::class, 'show']);
// Route::view('/dashboard/cust_list', 'page.cust_list');

// Route::get('/dashboard/{page}', function ($page) {
//     return view('page.'.$page);
// });
// Route::resource('dashboard', MenuController::class);
