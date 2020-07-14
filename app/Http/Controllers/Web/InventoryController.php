<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     *
     * return view for inventory
     */

     public function index()
     {
         return view('inventories.index');
     }
}
