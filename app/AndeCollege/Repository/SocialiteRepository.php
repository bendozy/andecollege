<?php

namespace AndeCollege\AndeCollege\Repository;

use AndeCollege\User;
use AndeCollege\Socialite;

class SocialiteRepository
{
    /**
     * Find Users by their Social Details
     *
     * @param  string $email
     *
     * @return Collection
     */
    public function findUserByProviderAndId($provider, $id)
    {
        $socialite = Socialite::where('provider', '=', $provider)
            ->where('auth_id', '=', $id)
            ->first();
        if ($socialite) {
            return User::find($socialite->user_id);
        }

        return null;
    }
}
