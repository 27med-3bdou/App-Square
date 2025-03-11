<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;

class ForgetResetService
{
    public function resetPassword(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || $user->otp_code !== $data['otp']) {
            return ['error' => 'Invalid OTP'];
        }

        $user->update([
            'password' => Hash::make($data['password']),
            'otp_code' => null,
        ]);

        event(new PasswordReset($user));

        return ['message' => 'Password has been reset successfully'];
    }
}
?>
