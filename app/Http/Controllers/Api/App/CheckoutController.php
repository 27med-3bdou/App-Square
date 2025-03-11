<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct( private CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout()
    {
        $result = $this->checkoutService->checkout(auth()->id());

        if (isset($result['error'])) {
            return response()->json(['message' => $result['error']], 400);
        }

        return response()->json(['message' => 'Order placed successfully', 'order' => $result]);
    }
}
