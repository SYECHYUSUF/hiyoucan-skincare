<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();

        // Query Dasar: Produk Aktif
        $query = Product::where('is_active', true)->with('category');

        // 1. Logic Search (Berdasarkan Nama Produk)
        $query->when($request->search, function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
        });

        // 2. Logic Filter Kategori (Checkbox)
        $query->when($request->categories, function ($q) use ($request) {
            return $q->whereIn('category_id', $request->categories);
        });

        // 3. Logic Filter Harga (Min & Max)
        $query->when($request->min_price, function ($q) use ($request) {
            return $q->where('price', '>=', $request->min_price);
        });
        $query->when($request->max_price, function ($q) use ($request) {
            return $q->where('price', '<=', $request->max_price);
        });

        // 4. Logic Sorting
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            default:
                $query->latest(); // Default urutan terbaru
                break;
        }

        // Eksekusi Query dengan Pagination (Sertakan query string agar filter tidak hilang saat ganti halaman)
        $products = $query->paginate(9)->withQueryString();

        return view('shop.index', compact('categories', 'products'));
    }

    public function show(Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}