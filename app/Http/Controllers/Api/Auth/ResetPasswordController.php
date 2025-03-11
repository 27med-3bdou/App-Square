<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\App\ForgetPasswordRequest;
use App\Http\Requests\Api\App\ResetPasswordRequest;
use App\Models\User;
use App\Services\ForgetResetService;
use App\Services\OtpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    protected $authService;
    protected $otpService;

    public function __construct(ForgetResetService $authService, OtpService $otpService)
    {
        $this->authService = $authService;
        $this->otpService = $otpService;
    }

    public function sendOTP(ForgetPasswordRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $response = $this->otpService->generateOTP($user);
        return response()->json($response, 200);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $response = $this->authService->resetPassword($request->validated());
        return response()->json($response, isset($response['error']) ? 400 : 200);
    }
}
