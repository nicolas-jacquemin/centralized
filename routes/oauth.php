<?php

use App\Http\Controllers\OAuth\AuthorizationController;
use Illuminate\Support\Facades\Route;

Route::get('/authorize', [AuthorizationController::class, 'authorize'])
    ->middleware('web')
    ->name('passport.authorizations.authorize');
