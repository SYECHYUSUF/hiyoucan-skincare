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

            // JIKA ADMIN: Redirect ke Admin Dashboard
            if ($role == 'admin') {
                return redirect()->route('admin.home');
            }

            // JIKA MANAGER (SELLER): Redirect ke Seller Dashboard
            // PERBAIKAN: Menggunakan redirect, bukan view()
            if ($role == 'seller') {
                return redirect()->route('seller.home'); 
            }

            // JIKA USER BIASA: Tampilkan dashboard user
            return view('dashboard.user.home');
        } else {
            return redirect('login');
        }
    }
}