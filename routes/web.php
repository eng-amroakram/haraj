<?php

use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\Panel\CarController;
use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\Panel\OfferController;
use App\Http\Controllers\Panel\SettingsController;
use App\Http\Controllers\Panel\UserController;
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

Route::get('/', [Home::class, 'index'])->name('index');

Route::controller(Home::class)->prefix('auth/')->as('auth.')->middleware(['web'])->group(
    function () {
        Route::get('login', 'login')->name('login');
    }
);

Route::prefix('panel/')->as('panel.')->middleware(['web', 'auth'])->group(
    function () {

        Route::controller(HomeController::class)->group(
            function () {
                Route::get('', 'home')->name('home');
            }
        );

        Route::controller(UserController::class)->prefix('users/')->as('users.')->group(
            function () {
                Route::get('', 'users')->name('index');
            }
        );

        Route::controller(CarController::class)->prefix('cars/')->as('cars.')->group(
            function () {
                Route::get('', 'cars')->name('index');
            }
        );


        Route::controller(OfferController::class)->prefix('offers/')->as('offers.')->group(
            function () {
                Route::get('', 'offers')->name('index');
            }
        );

        Route::controller(SettingsController::class)->prefix('settings/')->as('settings.')->group(
            function () {
                Route::get('', 'settings')->name('index');
                Route::post('', 'store')->name('store');
            }
        );
    }
);
