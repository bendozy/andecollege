<?php

namespace AndeCollege\Http\Controllers\Auth;

use AndeCollege\AndeCollege\Authenticate\SocialAuthenticateUser;
use AndeCollege\Http\Controllers\Controller;
use AndeCollege\Http\Requests\UserRegisterRequest;
use AndeCollege\Socialite as SocialLogin;
use AndeCollege\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

/**
 * Class AuthController
 * @package AndeCollege\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $loginPath = '/login';
    protected $registerPath = '/register';
    protected $redirectPath = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
        ]);
    }

    /**
     * Create a new social instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function createSocialLogin($data, $provider)
    {
        return SocialLogin::create([
            'auth_id' => $data->getId(),
            'user_id' => Auth::User()->id,
            'provider' => $provider
        ]);
    }

    /**
     * Authenticate users with socialite
     *
     * @param \AndeCollege\AndeCollege\Authenticate\SocialAuthenticateUser $authenticateUser
     * @param \AndeCollege\Http\Controllers\Auth\Request $request
     * @param string $provider
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function socialLogin(SocialAuthenticateUser $authenticateUser, Request $request, $provider = null)
    {
        $socialProvidders = array(
            "facebook",
            "twitter",
            "github"
        );

        if (in_array(strtolower($provider), $socialProvidders)) {
            return $authenticateUser->execute($request, $this, $provider);
        } else {
            return redirect($this->registerPath)->withErrors('Invalid Login Provider');
        }
    }

    /**
     * Authenticate users.
     *
     * @param array $request
     *
     * @return User
     */
    public function doLogin(Request $request)
    {

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);
        $field = (filter_var($credentials ['email'], FILTER_VALIDATE_EMAIL)) ? "email" : "username";
        if (Auth::attempt([
            $field => $credentials ['email'],
            'password' => $credentials ['password'],
        ], $request->has('remember'))
        ) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        /*
         * If the login attempt was unsuccessful we will increment the number of attempts
         * to login and redirect the user back to the login form. Of course, when this
         * user surpasses their maximum number of attempts they will get locked out.
         */
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())->withInput($request->only($this->loginUsername(), 'remember'))->withErrors([
            $this->loginUsername() => $this->getFailedLoginMessage()
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \AndeCollege\Http\Requests\UserRegisterRequest $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(UserRegisterRequest $request)
    {
        Auth::login($this->create($request->all()));
        return redirect($this->redirectPath())->with('status', 'User Created Successfully');
    }

    public function getSocial(Request $request)
    {
        if (! $request->session()->has('socialUser')) {
            return redirect()->intended('/login');
        }
        return view('auth.social');
    }

    public function getSocialTwitter(Request $request)
    {
        if (! $request->session()->has('socialUser')) {
            return redirect()->intended('/login');
        }
        return view('auth.social_twitter');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postSocial(Request $request)
    {
        if (Auth::check()) {
            return redirect()->intended('/');
        }
        $this->sanitizeInputs($request);

        $rules = [
            'password' => 'required|confirmed|min:8',
            'username' => 'required|max:255|unique:users,username|min:3',
            'firstname' => 'required',
            'lastname' => 'required'
        ];

        $provider = $request->session()->get('provider');
        if ($provider == 'twitter') {
            $rules['email'] = 'required|email|max:255|unique:users,email';
        }

        $validation = Validator::make($request->all(), $rules);


        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation->errors());
        } else {
            $user_array = [
                'username' => $request->input('username'),
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'password' => $request->input('password')
            ];
            if ($provider == 'twitter') {
                $user_array['email'] = $request->input('email');
            } else {
                $user_array['email'] = $request->session()->get('socialUser')->getEmail();
            }
            Auth::login($this->create($user_array));
            $this->createSocialLogin($request->session()->get('socialUser'), $provider);

            $request->session()->forget('socialUser');
            $request->session()->forget('provider');

            return redirect($this->redirectPath());
        }
    }

    /**
     * Sanitize the Inputs.
     *
     */
    public function sanitizeInputs(Request $request)
    {
        $input = $request->all();
        $input['username'] = trim(filter_var($request->input('username'), FILTER_SANITIZE_STRING));
        $input['password'] = trim(filter_var($request->input('password'), FILTER_SANITIZE_STRING));
        $input['password_confirmation'] = filter_var($request->input('password_confirmation'), FILTER_SANITIZE_STRING);
        $input['firstrname'] = trim(filter_var($request->input('firstname'), FILTER_SANITIZE_STRING));
        $input['lastname'] = trim(filter_var($request->input('lastname'), FILTER_SANITIZE_STRING));
        if (isset($input['email'])) {
            $input['email'] = trim(filter_var($request->input('email'), FILTER_SANITIZE_EMAIL));
        }
        $request->replace($input);
    }
}
