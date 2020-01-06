<?php

namespace App\Http\Controllers;

use App\Services\SocialGoogleAccountService;
use Illuminate\Http\Request;
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
        return Socialite::driver('google')->redirect();
    }

    /**
     * Return a callback method from google api.
     *
     * @param SocialGoogleAccountService $service
     * @return RedirectResponse
     */
    public function callback(SocialGoogleAccountService $service): RedirectResponse
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->user());
        auth()->login($user);
        return redirect()->to('/');
    }
}
