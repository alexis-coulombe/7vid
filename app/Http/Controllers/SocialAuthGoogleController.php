<?php

namespace App\Http\Controllers;

use App\Services\SocialGoogleAccountService;
use App\SocialGoogleAccount;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialAuthGoogleController extends Controller
{
    /**
     * Create a redirect method to google api.
     *
     * @return RedirectResponse
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Return a callback method from google api.
     *
     * @param SocialGoogleAccountService $service
     * @return RedirectResponse
     */
    public function callback(SocialGoogleAccountService $service): RedirectResponse
    {
        /** @var User $user */
        $user = $service->createOrGetUser(Socialite::driver('google')->stateless()->user());
        Auth::login($user, true);
        return redirect()->to('/');
    }
}
