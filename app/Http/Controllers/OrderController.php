<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Menampilkan Riwayat Pesanan
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $orders = $user->orders()->with('items.product')->latest()->get();

        return view('orders.index', compact('orders'));
    }

    // Proses Checkout
    public function checkout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $cartItems = $user->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        // Hitung Total Harga
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Gunakan Database Transaction agar data aman (Atomicity)
        DB::transaction(function () use ($user, $cartItems, $total) {
            // 1. Buat Order Baru
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'status' => 'pending',
                'address' => 'Default Address (Advanced Feature Later)',
            ]);

            // 2. Pindahkan item dari Cart ke OrderItem
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Opsional: Kurangi stok produk
                $item->product->decrement('stock', $item->quantity);
            }

            // 3. Kosongkan Keranjang
            $user->carts()->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}