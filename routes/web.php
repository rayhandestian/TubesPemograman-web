<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('landingPage');
})->name('landingPage');

route::get('/signin', [AuthController::class, "signin"])->name('signin');
route::post('/signin', [AuthController::class, "signinPost"])->name('signin.post');
route::get('/signup', [AuthController::class, "signup"])->name('signup');
route::post('/signup', [AuthController::class, "signinPost"])->name('signup.post');