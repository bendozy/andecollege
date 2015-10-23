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
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class SocialAuthenticateUser {

	use AuthenticatesAndRegistersUsers;

	/**
	 * Store users details
	 * @var UserRepository
	 */
	private $users;

	public function __construct(UserRepository $users) {
		$this->users = $users;
	}

	public function execute($request, $listener, $provider) {

		if (! $request->all()) {
			return $this->getAuthorizationFirst($provider);
		}
		elseif ( isset($request->all() ['errors'])) {
			return redirect('/login')->withErrors('Error authenticating with ' . $provider);
		}
		else {
			$userSocialDetails = $this->getSocialMediaProfile($provider);
			if($provider != 'twitter'){
				$user = $this->users->findUserByEmail($userSocialDetails->email);
			}else{

			}

			dd($userSocialDetails);

			if ($user) {
				Auth::loginUsingId($user->id, true);

				return redirect()->intended('/');
			}
			else {
				session([
					'socialUser' => $userSocialDetails,
					'provider'   => $provider
				]);
                return redirect()->intended(route('getSocial'));
			}
		}
	}

	private function getAuthorizationFirst($provider) {
		return Socialite::driver($provider)->redirect();
	}

	private function getSocialMediaProfile($provider) {
		return Socialite::driver($provider)->user();
	}

}