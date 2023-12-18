<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserSubscriptionController;
use App\Http\Middleware\IsAllowedPublishArticles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// For Authenticate with Sanctum
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    //imitation of payment confirmation, a subscription is created for the user
    Route::post('confirm-payment/{subscription}', [UserSubscriptionController::class, 'confirmPayment']);
    // all published articles
    Route::get('articles', [ArticleController::class, 'index']);

    // my articles
    Route::get('my-articles', [ArticleController::class, 'show']);
    Route::post('my-articles', [ArticleController::class, 'store']);
    Route::put('my-articles/{article}', [ArticleController::class, 'update']);
    Route::delete('my-articles/{article}', [ArticleController::class, 'destroy']);
    //activate/deactivate my article
    Route::patch('my-articles/{article}', [ArticleController::class, 'activate']);

    //CRUD subscriptions
    Route::apiResource('subscriptions', SubscriptionController::class);
});
