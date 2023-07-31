<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\FeatureController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->prefix('auth/')->as('.auth')->group(
    function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('otp', 'otp');
        Route::post('verify', 'verify');
    }
);

Route::controller(ProfileController::class)->prefix('user/')->middleware(['auth:sanctum'])->group(
    function () {

        Route::middleware(['checkUserStatus'])->group(function () {
            Route::get('profile', 'info');
            Route::post('profile', 'store');
            Route::post('change-email', 'changeEmail');
            Route::post('change-password', 'changePassword');
            Route::delete('delete', 'destroy');

            Route::post('gallery', 'gallery');
            Route::delete('galleryDelete', 'destroyGallery');
        });

        Route::post('logout', 'logout');
    }
);

Route::controller(CarController::class)->prefix('ads/')->middleware(['auth:sanctum'])->group(
    function () {
        Route::middleware(['checkUserStatus'])->group(function () {
            Route::get('', 'index');
            Route::get('{id}/show', 'show');
            Route::post('', 'store');
            Route::put('{id}/update', 'update');
            Route::delete('{id}/destroy', 'destroy');
            Route::get('favorites', 'favorites');
            Route::get('myads', 'myads');
            Route::get('favorite', 'favoriteADS');
            Route::get('{id}/favorite', 'favorite');
            Route::get('{id}/unfavorite', 'unfavorite');
        });
    }
);

Route::controller(OfferController::class)->prefix('offers/')->middleware(['auth:sanctum'])->group(
    function () {
        Route::middleware(['checkUserStatus'])->group(function () {
            Route::get('all-offers', 'index');
            Route::get('{id}/show', 'show');
            Route::post('store', 'store');
            Route::put('{id}/update', 'update');
            Route::delete('{id}/destroy', 'destroy');
            Route::get('get-buyer-offers', 'getBuyerOffers');
            Route::get('get-seller-offers', 'getSellerOffers');
            Route::get('{id}/get-ad-offers', 'GetAdOffers');
            Route::get('{id}/accept', 'accept');
            Route::get('{id}/reject', 'reject');
        });
    }
);

Route::controller(FeatureController::class)->prefix('features/')->middleware(['auth:sanctum'])->group(
    function () {
        Route::middleware(['checkUserStatus'])->group(function () {
            Route::get('{feature}', 'index');
        });
    }
);

// Settings
Route::get('settings', [SettingsController::class, 'index'])->middleware(['auth:sanctum', 'checkUserStatus']);
