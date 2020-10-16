<?php

namespace App\Http\Controllers\Auth;

use App\Apis\Kaltura\Kaltura;
use App\Apis\Kaltura\KalturaUser;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Throwable;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $kaltura = new Kaltura();
            $ks = $kaltura->loginByLoginId($email, $password);

            session(['ks' => $ks]);

            return true;
        } catch (Throwable $t) {
            return false;
        }
    }

    protected function sendLoginResponse(Request $request)
    {
        return redirect(RouteServiceProvider::HOME);
    }
}
