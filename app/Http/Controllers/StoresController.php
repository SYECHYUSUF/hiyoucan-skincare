<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store; // PENTING
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // PENTING UNTUK GAMBAR
use Illuminate\Support\Str;

class StoresController extends Controller
{
    // ... (Method index dan orders biarkan saja) ...
    // ... COPY METHOD BARU INI DI BAWAH ...

    // Halaman Edit Toko
    public function edit()
    {
        $store = Store::where('user_id', Auth::id())->first();
        return view('dashboard.seller.store.edit', compact('store'));
    }

    // Proses Simpan/Update Toko
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048', // Validasi Gambar
        ]);

        $user = Auth::user();
        
        // Cek apakah toko sudah ada atau belum
        $store = Store::firstOrNew(['user_id' => $user->id]);
        
        $store->name = $request->name;
        if ($store->name !== $request->name) {
             $store->slug = Str::slug($request->name) . '-' . Str::random(5);
        }
        // Jika slug kosong (toko baru), buat slug
        if (!$store->slug) {
             $store->slug = Str::slug($request->name) . '-' . Str::random(5);
        }
        $store->description = $request->description;

        // Upload Logo Jika Ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($store->logo) {
                Storage::disk('public')->delete($store->logo);
            }
            // Simpan logo baru
            $path = $request->file('logo')->store('stores', 'public');
            $store->logo = $path;
        }

        $store->save();

        return back()->with('success', 'Informasi toko berhasil diperbarui!');
    }
    
    // ... (Method updateOrderStatus biarkan tetap ada) ...
    
    // (PASTIKAN KEMBALIKAN METHOD INDEX DAN ORDERS SEPERTI SEBELUMNYA AGAR TIDAK HILANG)
    public function index()
    {
        $sellerId = Auth::id();
        $stats = [
            'total_products' => Product::where('seller_id', $sellerId)->count(),
            'items_sold' => OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })->sum('quantity'),
            'revenue' => OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })->sum(DB::raw('price * quantity')),
        ];
        
        $recentOrders = OrderItem::whereHas('product', function($q) use ($sellerId) {
            $q->where('seller_id', $sellerId);
        })->with(['order.user', 'product'])->latest()->take(5)->get();

        return view('dashboard.seller.home', compact('stats', 'recentOrders'));
    }

    public function orders()
    {
        $sellerId = Auth::id();
        $orderItems = OrderItem::whereHas('product', function($q) use ($sellerId) {
            $q->where('seller_id', $sellerId);
        })->with(['order.user', 'product'])->latest()->paginate(10);

        return view('dashboard.seller.orders', compact('orderItems'));
    }
    
    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate(['status' => 'required|in:pending,processing,completed,cancelled']);
        $order = Order::findOrFail($orderId);
        $order->status = $request->status;
        $order->save();
        return back()->with('success', 'Order status updated.');
    }
}