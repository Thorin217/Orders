<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     *return view for orders
     *
     */
    public function index()
    {
        return view('orders.index');
    }
}
