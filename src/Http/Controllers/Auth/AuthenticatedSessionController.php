<?php

declare(strict_types=1);

namespace Nebula\Http\Controllers\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('nebula::auth.login');
    }
}
