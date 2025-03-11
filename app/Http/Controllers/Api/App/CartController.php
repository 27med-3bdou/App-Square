<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->cartService->addToCart(auth()->id(), $request->product_id, $request->quantity);

        return response()->json(['message' => 'Product added to cart', 'cart' => $cart]);
    }

    public function viewCart()
    {
        return response()->json($this->cartService->viewCart(auth()->id()));
    }

    public function removeFromCart($itemId)
    {
        $this->cartService->removeFromCart($itemId);
        return response()->json(['message' => 'Item removed']);
    }

    public function clearCart()
    {
        $this->cartService->clearCart(auth()->id());
        return response()->json(['message' => 'Cart cleared']);
    }
}
