<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // PENTING

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', Auth::id())->latest()->paginate(10);
        return view('dashboard.seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.seller.products.create', compact('categories'));
    }

    // --- LOGIKA STORE DENGAN UPLOAD GAMBAR ---
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi File Gambar
        ]);

        // Proses Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'seller_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath, // Simpan path-nya saja
            'is_active' => true,
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        if ($product->seller_id !== Auth::id()) { abort(403); }
        $categories = Category::all();
        return view('dashboard.seller.products.edit', compact('product', 'categories'));
    }

    // --- LOGIKA UPDATE DENGAN GANTI GAMBAR ---
    public function update(Request $request, Product $product)
    {
        if ($product->seller_id !== Auth::id()) { abort(403); }

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Nullable karena boleh tidak ganti gambar
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ];

        // Cek jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama (Hanya jika itu file lokal, bukan URL dummy)
            if ($product->image && !Str::startsWith($product->getRawOriginal('image'), 'http')) {
                Storage::disk('public')->delete($product->getRawOriginal('image'));
            }
            
            // 2. Simpan gambar baru
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('seller.products.index')->with('success', 'Product updated successfully!');
    }

    // --- LOGIKA DELETE DENGAN HAPUS GAMBAR ---
    public function destroy(Product $product)
    {
        if ($product->seller_id !== Auth::id()) { abort(403); }
        
        // Hapus gambar dari storage saat produk dihapus
        if ($product->image && !Str::startsWith($product->getRawOriginal('image'), 'http')) {
            Storage::disk('public')->delete($product->getRawOriginal('image'));
        }

        $product->delete();
        return back()->with('success', 'Product deleted successfully!');
    }
}