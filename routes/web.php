<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\BboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;


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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/dashboard', [BboardController::class, 'home'])->name('dashboard.home');
    Route::prefix('dashboard')->group(function () {
        Route::get('/showOff/{id}', [BboardController::class, 'showOff'])->name('bboards.showOff');
        Route::post('/users/search', [UserController::class, 'search']);
        Route::resources([
            'bboards' => BboardController::class,
            'users' => UserController::class,
            'customers' => CustomerController::class,
        ]);
    });

});
// Route::prefix('dashboard')->group(function () {
//     Route::resources([
//         'bboards' => BboardController::class,
//         'users' => UserController::class,
//     ]);
// });
