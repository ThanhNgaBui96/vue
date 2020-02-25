<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiBaseController;
use App\Enums\ErrorType;
use Auth;

class LoginController extends ApiBaseController
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

    public function login(Request $request)
    {
        $this->valiadteLogin($request);
        $credentials = $request->only('email', 'password');
        if (!$token = $this->guard()->attempt($credentials)) {
            return $this->sendError(ErrorType::CODE_4010, __('errors.MSG_4010'), ErrorType::STATUS_4010);
        }

        return $this-> responseWithToken($token);
    }

    protected function valiadteLogin($request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);
    }

    protected function logout(Request $request)
    {
        $this->guard()->logout();
    }

    protected function responseWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
        ]);
    }

    protected function getAuthenticatedUser()
    {
        return  $this->guard()->user();
    }

    protected function guard()
    {
        return Auth::guard('api');
    }
}
