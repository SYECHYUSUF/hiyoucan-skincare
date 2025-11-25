<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan isi keranjang
    public function index()
    {
        // Baris ini membantu VS Code mengerti bahwa user yang login adalah model 'User' kita
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Ambil data keranjang milik user tersebut
        $cartItems = $user->carts()->with('product')->get();

        return view('cart.index', compact('cartItems'));
    }

    // Tambah barang ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Cek apakah barang sudah ada di keranjang user ini
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan jumlahnya
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    // Hapus barang dari keranjang
    public function destroy(Cart $cart)
    {
        // Pastikan yang menghapus adalah pemilik keranjang
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }
        
        $cart->delete();
        return back()->with('success', 'Item removed.');
    }
}