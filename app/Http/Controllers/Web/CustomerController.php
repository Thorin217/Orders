<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * return view for customers
     *
     */

     public function index()
     {
         return view('customers.index');
     }
}
