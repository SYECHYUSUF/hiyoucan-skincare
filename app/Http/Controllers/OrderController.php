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
    // Proses Checkout
    public function checkout(Request $request)
    {
        // 1. Validasi Alamat Wajib Diisi
        $request->validate([
            'address' => 'required|string|max:500',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $cartItems = $user->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        DB::transaction(function () use ($user, $cartItems, $total, $request) {
            // 2. Simpan Order dengan Alamat dari Request
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'status' => 'pending',
                'address' => $request->address, 
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
                $item->product->decrement('stock', $item->quantity);
            }

            $user->carts()->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}