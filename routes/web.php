<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Konceiver\Passwordless\Http\Controllers\StorePasswordlessController;

Route::view('/login/passwordless', 'passwordless-views::auth.passphrase')->name('login.passwordless');
Route::post('/login/passwordless', StorePasswordlessController::class);