<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PasswordResetController extends Controller
{
    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Display the forgot password form.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a password reset link to the given user's email.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
    }

    /**
     * Send OTP to user's phone for password reset.
     */
    public function sendPhoneOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
        ]);

        $user = User::where('phone', $request->phone)->first();
        
        if (!$user) {
            return back()->with('error', 'No user found with this phone number.');
        }

        // Store phone number in session
        session(['reset_phone' => $request->phone]);

        // Generate OTP
        $otp = $user->generateOTP();
        
        // Send OTP via SMS
        try {
            $this->smsService->sendOTP($user->phone, $otp);
            return redirect()->route('password.verify.otp')->with('success', 'OTP sent successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send OTP. Please try again.');
        }
    }

    /**
     * Show the OTP verification form.
     */
    public function showVerifyOTPForm()
    {
        return view('auth.verify-phone-otp');
    }

    /**
     * Verify OTP and allow password reset.
     */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $user = User::where('phone', session('reset_phone'))->first();
        
        if (!$user) {
            return back()->with('error', 'Invalid session. Please try again.');
        }

        if ($user->verifyOTP($request->otp)) {
            // Generate a unique token for password reset
            $token = Str::random(60);
            Cache::put('password_reset_' . $token, $user->id, now()->addMinutes(30));
            
            return redirect()->route('password.reset', ['token' => $token])->with('success', 'OTP verified successfully!');
        }

        return back()->with('error', 'Invalid OTP. Please try again.');
    }

    /**
     * Resend OTP for password reset.
     */
    public function resendOTP(Request $request)
    {
        $user = User::where('phone', session('reset_phone'))->first();
        
        if (!$user) {
            return back()->with('error', 'Invalid session. Please try again.');
        }

        $otp = $user->generateOTP();
        
        try {
            $this->smsService->sendOTP($user->phone, $otp);
            return back()->with('success', 'OTP resent successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to resend OTP. Please try again.');
        }
    }

    /**
     * Display the password reset form.
     */
    public function showResetForm(Request $request)
    {
        $token = $request->route('token');
        $userId = Cache::get('password_reset_' . $token);
        
        if (!$userId) {
            return redirect()->route('password.request')
                ->with('error', 'Invalid or expired password reset link.');
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $userId = Cache::get('password_reset_' . $request->token);
        
        if (!$userId) {
            return back()->withInput($request->only('password', 'password_confirmation'))
                ->with('error', 'Invalid or expired password reset link.');
        }

        $user = User::find($userId);
        
        if (!$user) {
            return back()->withInput($request->only('password', 'password_confirmation'))
                ->with('error', 'User not found.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Clear the reset token
        Cache::forget('password_reset_' . $request->token);

        return redirect()->route('login')
            ->with('success', 'Password has been reset successfully!');
    }
} 