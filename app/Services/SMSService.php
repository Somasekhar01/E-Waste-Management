<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SMSService
{
    private $twilio;
    private $fromNumber;
    private $accountSid;
    private $authToken;
    private $isEnabled;

    public function __construct()
    {
        $this->accountSid = config('services.twilio.account_sid');
        $this->authToken = config('services.twilio.auth_token');
        $this->fromNumber = config('services.twilio.from_number');
        $this->isEnabled = !empty($this->accountSid) && !empty($this->authToken) && !empty($this->fromNumber);
        
        if ($this->isEnabled) {
            try {
                $this->twilio = new \Twilio\Rest\Client($this->accountSid, $this->authToken);
            } catch (\Exception $e) {
                $this->isEnabled = false;
                \Log::error('Twilio initialization failed: ' . $e->getMessage());
            }
        }
    }

    public function generateOTP()
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function sendOTP($phoneNumber)
    {
        try {
            $otp = $this->generateOTP();
            
            // Store OTP in cache for 5 minutes
            Cache::put("otp_{$phoneNumber}", $otp, now()->addMinutes(5));
            
            if ($this->isEnabled) {
                // Send SMS using Twilio
                $message = $this->twilio->messages->create(
                    $phoneNumber,
                    [
                        'from' => $this->fromNumber,
                        'body' => "Your E-Waste Management verification code is: {$otp}. Valid for 5 minutes."
                    ]
                );
            } else {
                // For development/testing, log the OTP
                \Log::info("Development OTP for {$phoneNumber}: {$otp}");
            }

            return [
                'success' => true,
                'message' => $this->isEnabled ? 'OTP sent successfully' : 'OTP generated (development mode)'
            ];
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Failed to send OTP: ' . $e->getMessage()
            ];
        }
    }

    public function verifyOTP($phoneNumber, $otp)
    {
        $cachedOTP = Cache::get("otp_{$phoneNumber}");
        
        if (!$cachedOTP) {
            return [
                'success' => false,
                'message' => 'OTP has expired'
            ];
        }

        if ($cachedOTP !== $otp) {
            return [
                'success' => false,
                'message' => 'Invalid OTP'
            ];
        }

        // Clear OTP from cache after successful verification
        Cache::forget("otp_{$phoneNumber}");

        return [
            'success' => true,
            'message' => 'OTP verified successfully'
        ];
    }
} 