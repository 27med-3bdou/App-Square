<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    public function generateOTP(User $user)
    {
        $otp = rand(100000, 999999);
        $user->update(['otp_code' => $otp]);

        Mail::raw("Your OTP Code is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Password Reset OTP');
        });

        return ['message' => 'OTP sent successfully'];
    }

    public function verifyOTP(User $user, string $otp)
    {
        if ($user->otp_code === $otp) {
            $user->update(['otp_code' => null]);
            return ['message' => 'OTP verified successfully'];
        }

        return ['error' => 'Invalid OTP'];
    }
}
