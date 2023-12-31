<?php

    use App\Http\Controllers\DiscountController;
    use Illuminate\Support\Facades\Route;

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

Route::view('/', 'auth.login');
Route::resource('discounts', DiscountController::class)
    ->middleware(['auth'])
    ->except(['show']);

require __DIR__.'/auth.php';
