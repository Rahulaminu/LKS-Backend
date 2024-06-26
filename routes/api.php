<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return response()->json([
        "message" => "Forbidden access"
    ], 403);
})->name('login');

Route::post('/v1/auth/register', [AuthController::class, 'register']);
Route::post('/v1/auth/login', [AuthController::class, 'login']);
Route::post('/v1/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/v1/posts', [PostController::class, 'index'])->middleware('auth:sanctum');
Route::post('/v1/posts', [PostController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/v1/posts/{id}', [PostController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('/v1/users/{username}/follow', [FollowController::class, 'follow'])->middleware('auth:sanctum');
Route::delete('/v1/users/{username}/unfollow', [FollowController::class, 'unfollow'])->middleware('auth:sanctum');
Route::put('/v1/users/{username}/accept', [FollowController::class, 'acceptFollow'])->middleware('auth:sanctum');

Route::get('/v1/users/{username}/following', [FollowController::class, 'getFollowing'])->middleware('auth:sanctum');
Route::get('/v1/users/{username}/followers', [FollowController::class, 'getFollowers'])->middleware('auth:sanctum');
Route::get('/v1/users/{username}/followers/request', [FollowController::class, 'getFollowersRequest'])->middleware('auth:sanctum');

Route::get('/v1/users', [UserController::class, 'getUsers'])->middleware('auth:sanctum');
Route::get('/v1/users/{username}', [UserController::class, 'getDetailUser'])->middleware('auth:sanctum');