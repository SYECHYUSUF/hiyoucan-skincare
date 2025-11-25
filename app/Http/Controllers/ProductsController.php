<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    // Tampilkan List Produk Seller
    public function index()
    {
        // Hanya tampilkan produk milik user yang sedang login
        $products = Product::where('seller_id', Auth::id())->latest()->paginate(10);
        return view('dashboard.seller.products.index', compact('products'));
    }

    // Form Tambah Produk
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.seller.products.create', compact('categories'));
    }

    // Simpan Produk Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image_url' => 'required|url', // Kita pakai URL gambar dulu biar mudah (seperti Unsplash)
        ]);

        Product::create([
            'seller_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image_url,
            'is_active' => true, // Otomatis aktif
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Product created successfully!');
    }

    // Form Edit Produk
    public function edit(Product $product)
    {
        // Pastikan produk milik seller ini
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }
        $categories = Category::all();
        return view('dashboard.seller.products.edit', compact('product', 'categories'));
    }

    // Update Produk
    public function update(Request $request, Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_url' => 'required|url',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $request->image_url,
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Product updated successfully!');
    }

    // Hapus Produk
    public function destroy(Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }
        
        $product->delete();
        return back()->with('success', 'Product deleted successfully!');
    }
}