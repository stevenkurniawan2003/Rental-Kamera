<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $produks = Produk::latest()->paginate(8);
        return view('admin.dashboard', compact('produks'));
    }
}
