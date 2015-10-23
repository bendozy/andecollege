<?php
/**
 * Created by PhpStorm.
 * User: bendozy
 * Date: 10/21/15
 * Time: 3:48 PM
 */

namespace AndeCollege\AndeCollege\Authenticate;

use Request;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use AndeCollege\AndeCollege\Repository\UserRepository;
use AndeCollege\AndeCollege\Repository\SocialiteRepository;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class SocialAuthenticateUser
{
    use AuthenticatesAndRegistersUsers;

    /**
     * Store users details
     * @var UserRepository
     */
    private $users;
    private $socialite;

    public function __construct(UserRepository $users, SocialiteRepository $socialite)
    {
        $this->users = $users;
        $this->socialite =$socialite;
    }

    public function execute($request, $listener, $provider)
    {
        if (! $request->all()) {
            return $this->getAuthorizationFirst($provider);
        } elseif (isset($request->all() ['errors'])) {
            return redirect('/login')->withErrors('Error authenticating with ' . $provider);
        } else {
            $userSocialDetails = $this->getSocialMediaProfile($provider);
            if ($provider != 'twitter') {
                $user = $this->users->findUserByEmail($userSocialDetails->email);
            } else {
                $user = $this->socialite->findUserByProviderAndID($provider, $userSocialDetails->id);
            }
            if ($user) {
                Auth::loginUsingId($user->id, true);

                return redirect()->intended('/');
            } else {
                session([
                    'socialUser' => $userSocialDetails,
                    'provider'   => $provider
                ]);
	            if ($provider != 'twitter') {
		            return view('auth.social');
	            }
	            return view('auth.social_twitter');
            }
        }
    }

    private function getAuthorizationFirst($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    private function getSocialMediaProfile($provider)
    {
        return Socialite::driver($provider)->user();
    }
}
