<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    protected function redirectTo()
    {
        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            return '/email/verify';
        }

        if ($user && $user->deleted == 1) {
            Auth::logout();
            return '/deleted';
        }

        $role = $user->role;
        switch ($role) {
            case 'a':
                return '/users';
            case 'o':
                return '/events/organizer_view';
            case 'u':
                return '/home';
            default:
                return '/home';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
