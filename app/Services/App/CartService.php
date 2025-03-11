<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function addToCart($userId, $productId, $quantity)
    {
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        $cartItem = $cart->items()->updateOrCreate(
            ['product_id' => $productId],
            ['quantity' => DB::raw("quantity + $quantity")]
        );

        return $cart->load('items.product');
    }

    public function viewCart($userId)
    {
        return Cart::with('items.product')->where('user_id', $userId)->first();
    }

    public function removeFromCart($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();
    }

    public function clearCart($userId)
    {
        $cart = Cart::where('user_id', $userId)->first();
        if ($cart) {
            $cart->items()->delete();
        }
    }
}
