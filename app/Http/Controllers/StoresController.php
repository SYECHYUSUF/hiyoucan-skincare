<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <--- INI YANG KURANG TADI

class StoresController extends Controller
{
    // Halaman Utama Dashboard Seller
    public function index()
    {
        $sellerId = Auth::id();

        // Hitung statistik toko sendiri
        $stats = [
            'total_products' => Product::where('seller_id', $sellerId)->count(),
            
            // Menghitung total item yang terjual
            'items_sold' => OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })->sum('quantity'),

            // Menghitung total pendapatan (Revenue)
            // Sekarang DB::raw sudah dikenali
            'revenue' => OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })->sum(DB::raw('price * quantity')),
        ];

        // Ambil 5 pesanan terbaru yang masuk untuk produk seller ini
        $recentOrders = OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->with(['order.user', 'product'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.seller.home', compact('stats', 'recentOrders'));
    }

    // Halaman Pesanan Masuk (Incoming Orders)
    public function orders()
    {
        $sellerId = Auth::id();

        // Ambil semua item pesanan milik seller ini
        $orderItems = OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->with(['order.user', 'product'])
            ->latest()
            ->paginate(10);

        return view('dashboard.seller.orders', compact('orderItems'));
    }

    // Update Status Pesanan (Opsional)
    public function updateOrderStatus(Request $request, $id)
    {
        return back()->with('success', 'Status updated (Dummy Feature)');
    }
}