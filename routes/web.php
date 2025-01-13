<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserAdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => config('auth.registration'),
    ]);
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/apps')->middleware(['auth', 'verified', UserAdminMiddleware::class])->group(function () {
    Route::get('', [AppController::class, 'index'])
        ->name('apps.index');
    Route::get('{client}/edit', [AppController::class, 'edit'])
        ->name('apps.edit');
    Route::put('{client}', [AppController::class, 'update'])
        ->name('apps.update');
    Route::get('create', [AppController::class, 'create'])
    ->name('apps.create');
    Route::post('', [AppController::class, 'store'])
    ->name('apps.store');
    Route::delete('{client}', [AppController::class, 'destroy'])
        ->name('apps.destroy');
});

Route::prefix('/users')->middleware(['auth', 'verified', UserAdminMiddleware::class])->group(function () {
    Route::get('', [UserController::class, 'index'])
        ->name('users.index');
    Route::get('{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');
    Route::put('{user}', [UserController::class, 'update'])
        ->name('users.update');
    Route::get('create', [UserController::class, 'create'])
    ->name('users.create');
    Route::post('', [UserController::class, 'store'])
    ->name('users.store');
    Route::delete('{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('oauth')->group(base_path('routes/oauth.php'));

Route::get('.well-known/openid-configuration', function () {
    return response()->json([
        'issuer' => config('app.url'),
        'authorization_endpoint' => route('passport.authorizations.authorize'),
        'token_endpoint' => route('passport.token'),
        'response_types_supported' => [
            'code',
            'token',
            'id_token',
            'code token',
            'code id_token',
            'token id_token',
            'code token id_token',
            'none',
        ],
        'subject_types_supported' => [
            'public',
        ],
        'id_token_signing_alg_values_supported' => [
            'RS256',
        ],
        'scopes_supported' => ['openid', 'profile', 'email'],
        'token_endpoint_auth_methods_supported' => [
            'client_secret_basic',
            'client_secret_post',
        ],
        'userinfo_endpoint' => route('user.get'),
        'end_session_endpoint' => route('oauth.logout'),
        'response_types_supported' => ['code', 'token'],
        'subject_types_supported' => ['public'],
        'id_token_signing_alg_values_supported' => ['RS256'],
        'token_endpoint_auth_methods_supported' => ['client_secret_basic'],
        'claims_supported' => ['sub', 'iss', 'name', 'email'],
        'grant_types_supported' => ['authorization_code', 'implicit', 'refresh_token', 'client_credentials'],
        'acr_values_supported' => ['0', '1'],
        'response_types_supported' => ['code', 'token'],
        'subject_types_supported' => ['public'],
        'id_token_signing_alg_values_supported' => ['RS256'],
        'id_roken_encryption_alg_values_supported' => ['RSA1_5', 'A128KW'],
        'response_modes_supported' => ['query', 'fragment'],
        'token_endpoint_auth_methods_supported' => ['client_secret_basic'],
        'claim_types_supported' => ['normal'],
        'request_parameter_supported' => true,
        'request_uri_parameter_supported' => true,
        'require_request_uri_registration' => true,
        'code_challenge_methods_supported' => ['plain', 'S256'],
        'revocation_endpoint' => route('oauth.logout'),
    ]);
});

require __DIR__.'/auth.php';
