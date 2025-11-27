<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            // ADMIN -> Dashboard Admin
            if ($role == 'admin') {
                return redirect()->route('admin.home');
            }

            // SELLER -> Dashboard Seller
            if ($role == 'seller') {
                return redirect()->route('seller.home'); 
            }

            // BUYER (USER) -> DILARANG MASUK DASHBOARD
            // Redirect ke Homepage/Shop
            return redirect()->route('shop.index');
        } else {
            return redirect('login');
        }
    }
}