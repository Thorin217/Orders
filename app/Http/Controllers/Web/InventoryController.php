<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Resources\InventoryResource;
use App\Inventory;

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

     /**
     * Display a listing of the resource for web.
     *
     * @return \Illuminate\Http\Response
     */
    public function listInventory(Request $request)
    {
        $user = User::find(Auth::id());

        $inventory = Inventory::orderBy('description','ASC');

        return InventoryResource::collection($inventory->paginate(10));
    }
}
