<?php

use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\Panel\CarController;
use App\Http\Controllers\Panel\FeatureController;
use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\Panel\OfferController;
use App\Http\Controllers\Panel\SettingsController;
use App\Http\Controllers\Panel\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        Route::controller(FeatureController::class)->prefix('features/')->as('features.')->group(
            function () {
                Route::get('doors', 'doors')->name('doors');
                Route::get('cylinders', 'cylinders')->name('cylinders');
                Route::get('seats', 'seats')->name('seats');
                Route::get('body-types', 'bodyTypes')->name('body-types');
                Route::get('fuel-types', 'fuelTypes')->name('fuel-types');
                Route::get('car-models', 'carModels')->name('car-models');
                Route::get('engine-powers', 'enginePowers')->name('engine-powers');
                Route::get('transmissions', 'transmissions')->name('transmissions');
                Route::get('inner-colors', 'innerColors')->name('inner-colors');
                Route::get('outer-colors', 'outerColors')->name('outer-colors');
                Route::get('seller-types', 'sellerTypes')->name('seller-types');
                Route::get('years', 'years')->name('years');
                Route::get('mechanical-conditions', 'mechanicalConditions')->name('mechanical-conditions');
                Route::get('regional-specifications', 'regionalSpecifications')->name('regional-specifications');
                Route::get('car-conditions', 'carConditions')->name('car-conditions');
            }
        );
    }
);
