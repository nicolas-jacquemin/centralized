<?php

namespace App\Http\Controllers\OAuth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LogoutController {
  public function __invoke(): Response | RedirectResponse {
    if (!Auth::check()) {
      return redirect('/');
    }
    return Inertia::render('OAuth/Logout');
  }
}