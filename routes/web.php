<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create-post', function () {
    return view('create-post');
})->middleware('isAdmin');

Route::get('/posts', [PostController::class, 'index']);
Route::get('/post/{id}', [PostController::class, 'show']);

Route::post('/create-post', [PostController::class, 'store'])->middleware('isAdmin');


// Route::get('signup', [AuthController::class, 'getSignUp']);
Route::get('signin', [AuthController::class, 'getSignIn']);
Route::post('signin', [AuthController::class, 'SignIn']);

// Route::get('signout', [AuthController::class, 'signout']);  

Route::get('/myposts', [PostController::class, 'myPosts']);

Route::post('/deletePost/{id}', [PostController::class, 'destroy']);