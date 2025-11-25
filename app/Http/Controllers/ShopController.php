<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // Tambahkan with('category') untuk Eager Loading
        $products = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->paginate(9);

        return view('shop.index', compact('categories', 'products'));
    }
    // ... method index yang sudah ada ...

    public function show(Product $product)
    {
        // Ambil produk related (kategori sama, kecuali produk ini sendiri)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
} // Tutup kurung kurawal class terakhir
