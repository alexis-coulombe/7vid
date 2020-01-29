<?php

namespace App\Services;

use App\SocialGoogleAccount;
use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialGoogleAccountService
{
    /**
     * Create or return instance of user from google account info
     *
     * @param ProviderUser $providerUser
     * @return User
     */
    public function createOrGetUser(ProviderUser $providerUser): User
    {
        /** @var SocialGoogleAccount $account */
        $account = SocialGoogleAccount::whereProvider('google')->whereProviderUserId($providerUser->getId())->first();

        if ($account) {
            return $account->user;
        }

        /** @var SocialGoogleAccount $account */
        $account = new SocialGoogleAccount(
            [
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'google'
            ]
        );

        /** @var User $user */
        $user = User::whereEmail($providerUser->getEmail())->first();

        if (!$user) {
            try {
                /** @var User $user */
                $user = new User();
                $user->setEmail($providerUser->getEmail());
                $user->setName($providerUser->getName());
                $user->setPassword(Hash::make(mt_rand()));
                $user->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
                exit(1);
            }
        }
        $account->user_id = $user->getId();
        $account->user()->associate($user);
        $account->save();

        return $user;
    }
}
