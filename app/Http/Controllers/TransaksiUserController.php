<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiUserController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }
}
