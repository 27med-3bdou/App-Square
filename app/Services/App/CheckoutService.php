<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    public function checkout($userId)
    {
        $cart = Cart::with('items.product')->where('user_id', $userId)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return ['error' => 'Cart is empty'];
        }

        DB::beginTransaction();
        try {
            // إنشاء طلب جديد
            $order = Order::create([
                'user_id' => $userId,
                'total_price' => $cart->items->sum(fn($item) => $item->product->price * $item->quantity),
            ]);

            // نقل المنتجات من العربة إلى الطلب
            foreach ($cart->items as $item) {
                CartItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // حذف العربة بعد إنهاء الطلب
            $cart->items()->delete();
            $cart->delete();

            DB::commit();
            return $order->load('items.product');
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => 'Something went wrong'];
        }
    }
}
