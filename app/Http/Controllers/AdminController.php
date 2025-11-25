<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Halaman Utama Dashboard Admin
    public function index()
    {
        // Statistik Sederhana
        $stats = [
            'total_sales' => Order::where('status', 'completed')->sum('total_price'),
            'total_orders' => Order::count(),
            'total_users' => User::where('role', 'user')->count(),
            'pending_sellers' => User::where('role', 'seller')->where('email_verified_at', null)->count(), // Asumsi: Seller pending = email_verified_at null atau kita pakai kolom status nanti
        ];

        return view('dashboard.admin.home', compact('stats'));
    }

    // --- MANAJEMEN USER (Verifikasi Seller) ---
    public function users()
    {
        // Ambil semua user kecuali admin
        $users = User::where('role', '!=', 'admin')->latest()->get();
        return view('dashboard.admin.users', compact('users'));
    }

    public function verifySeller(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'seller') {
            return back()->with('error', 'User bukan seller.');
        }

        // Kita gunakan kolom 'email_verified_at' sebagai penanda APPROVE sementara
        // Jika null = Pending/Rejected, Jika isi = Approved. 
        // Atau idealnya buat kolom 'status' di tabel users (tapi kita pakai yang ada dulu).
        
        if ($request->action === 'approve') {
            $user->email_verified_at = now(); // Anggap ini sebagai "Approved"
            $user->save();
            return back()->with('success', 'Seller berhasil disetujui.');
        } elseif ($request->action === 'reject') {
            $user->email_verified_at = null; // Anggap ini "Pending/Rejected"
            $user->save();
            // Opsi: $user->delete(); jika ingin langsung menghapus
            return back()->with('success', 'Seller ditolak/dinonaktifkan.');
        }

        return back();
    }

    public function destroyUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    // --- MANAJEMEN KATEGORI ---
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('dashboard.admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}