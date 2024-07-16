<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // Pastikan Anda mengimpor Auth dengan benar
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/dashboard';

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

    // Fungsi jika user memiliki status pending maka tidak bisa login
    protected function authenticated(Request $request, $user)
    {
        if ($user->status === 'pending') {
            Auth::logout();
            return redirect(route('login'))->with('error', 'Akun Anda belum aktif. Silakan hubungi admin atau tunggu konfirmasi dari admin.');
        }
        if ($user->status === 'non-aktif') {
            Auth::logout();
            return redirect(route('login'))->with('error', 'Akun Anda  non-aktif. Silakan hubungi admin aktivasi akun kembali.');
        }

        return redirect()->intended($this->redirectPath());
    }
}
