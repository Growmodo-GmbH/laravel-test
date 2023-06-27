<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class LoginController extends Controller {
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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/welcome';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function username() {
        $login = request()->input('email_or_username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    protected function validateLogin(Request $request) {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request) {
        throw ValidationException::withMessages([
            'email_or_username' => [trans('auth.failed')],
        ])->redirectTo(route('login'));
    }

    protected function attemptLogin(Request $request) {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    public function login(Request $request) {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();

            // Generate a random token
            $token = Str::random(60);

            // Store the token in the user's record
            $user->api_token = hash('sha256', $token);
            $user->save();

            return response()->json([
                'token' => $token,
                'user_id' => $user->id,
                'user_username' => $user->username,
                'user_role' => $user->role
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request) {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        if ($user) {
            // Remove the user's token
            $user->api_token = null;
            $user->save();
        }

        $this->guard()->logout();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
