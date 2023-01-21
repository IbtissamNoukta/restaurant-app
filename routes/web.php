<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ServantController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PaymentController;


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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//register or new password take off
//Auth::routes(["register" => false, "reset" => false]);
Route::resource('category', CategoryController::class);
Route::resource('table', TableController::class);
Route::resource('servant', ServantController::class);
Route::resource('menu', MenuController::class);
Route::resource('sale', SaleController::class);
Route::get('payment', [PaymentController::class, 'index']);


require __DIR__.'/auth.php';
