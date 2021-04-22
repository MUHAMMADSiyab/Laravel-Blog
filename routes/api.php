<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
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

Route::group(['middleware' => 'auth:api'], function () {
    // Auth user
    Route::get('/user', function () {
        return auth()->user();
    });

    // Post
    Route::resource('posts', PostController::class);

    // Comment
    Route::resource('comments', CommentController::class)
        ->except(['create', 'show']);
});
