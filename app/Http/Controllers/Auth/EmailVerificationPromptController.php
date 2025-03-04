<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if(Auth::user()->isAdmin()) {
            return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('admin.dashboard', absolute: false))
                    : view('auth.verify-email');

        } else if(Auth::user()->isCustomer()) {
            return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('customer.dashboard', absolute: false))
            : view('auth.verify-email');
        }
    }
}
