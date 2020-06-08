<?php

namespace App\Services;
use App\SocialTwitterAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Carbon\Carbon;

class SocialTwitterAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        
        $account = SocialTwitterAccount::whereProvider('twitter')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialTwitterAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'twitter',
                'token' => $providerUser->token,
                'tokenSecret' => $providerUser->tokenSecret,
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                
                $fecha = Carbon::now()->toDateTimeString();

                $user = User::create([
                    'email_verified_at' => '2020-05-29 08:19:34',
                    'username' => $providerUser->getNickname(),
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => md5(rand(1,10000)),
                    'source' => 'Twitter',
                ]);
            }

            $account->user()->associate($user);
            $account->save();
            
            \DB::table('users')->where('email', $providerUser->getEmail())->update(['email_verified_at' => $fecha]);
            
            return $user;
        }
    }
}