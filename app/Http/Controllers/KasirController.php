<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
            $orders = Order::latest()->take(10)->get();
            return view('kasir.orders.index', compact('orders'));
        }
    }
