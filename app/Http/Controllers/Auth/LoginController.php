<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $smsService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (!Auth::user()->hasVerifiedPhone()) {
                return redirect()->route('verify.phone')->with('success', 'Welcome! Please verify your phone number.');
            }

            return redirect()->intended('home')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->with('error', 'Login failed. Please check your credentials.');
    }

    public function showPhoneVerification()
    {
        return view('auth.verify-phone');
    }

    public function verifyPhone(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $user = Auth::user();
        
        if ($user->verifyOTP($request->otp)) {
            return redirect()->route('home')->with('success', 'Phone number verified successfully!');
        }

        return back()->with('error', 'Invalid OTP. Please try again.');
    }

    public function resendOTP(Request $request)
    {
        $user = Auth::user();
        $otp = $user->generateOTP();
        
        try {
            $this->smsService->sendOTP($user->phone, $otp);
            return back()->with('success', 'OTP resent successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to resend OTP. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}
