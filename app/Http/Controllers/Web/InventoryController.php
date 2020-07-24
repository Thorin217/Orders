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
        $columns = Inventory::$columns;
        return view('inventories.index', compact('columns'));
     }

     /**
     * Display a listing of the resource for web.
     *
     * @return \Illuminate\Http\Response
     */
    public function listInventory(Request $request)
    {

        $user = User::find(Auth::id());

        $column = $this->selectColumn($request->column);

        $data = Inventory::SearchPaginate($column);

        return InventoryResource::collection($data);
    }

    public function create()
    {
        return view('inventories.create-edit');
    }

    public function show($id)
    {
        $article = Inventory::find($id);
        return view('inventories.detail', compact('article'));
    }

    public function edit($id)
    {
        $article = Inventory::find($id);
        return view('inventories.create-edit', compact('article'));
    }

    public function destroy(Request $request)
    {
        foreach ($request->items as $item) {
            $inventory = Inventory::find($item);
            $inventory->delete();
        }

        return response()->json([
            'message'   => 'Los elementos han sido eliminados',
            'type'      => 'success'
        ],200);
    }

    public function selectColumn($column)
    {
        switch ($column) {
            case 'descripcion':
                return 'description';
                break;
            case 'stock':
                return 'quantity_stock';
                break;
            case 'precio':
                return 'unit_price';
                break;
            default:
                return 'id';
                break;
        }
    }
}
