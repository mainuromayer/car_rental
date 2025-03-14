<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if(Auth::user()->isAdmin()) {
            return redirect()->intended(route('admin.dashboard', absolute: false).'?verified=1');
        } else if(Auth::user()->isCustomer()) {
            return redirect()->intended(route('customer.dashboard', absolute: false).'?verified=1');
        }
        // return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
