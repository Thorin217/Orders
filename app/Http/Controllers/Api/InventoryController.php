<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Category;
use App\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\InventoryResource;
use App\Http\Requests\InventoryStore;


class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource for other client.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find(Auth::id());

        if ( $request->client == 'local' ) {
            $column = $this->selectColumn($request->column);

            $data = Inventory::SearchPaginate($column);

            return InventoryResource::collection($data);
        }

        $inventory = Inventory::orderBy('description','ASC');

        return InventoryResource::collection($inventory->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::id());

        $article = Inventory::create([
            'description'           => $request->description,
            'quantity_stock'        => $request->quantity_stock,
            'unit_price'            => $request->unit_price,
            'percent_commission'    => $request->percent_commission
        ]);

        return response()->json([
            'message'           =>  'Artículo agregado con éxito',
            'typeMessage'       =>  'success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Inventory::findOrFail($id);

        return response()->json(new InventoryResource($article),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryStore $request, $id)
    {
        $article = Inventory::findOrFail($id);

        $article->update($request->all());

        return response()->json([
            'message'           =>  'Artículo actualizado con éxito',
            'typeMessage'       =>  'success',
            'article'           =>  $article
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Inventory::findOrfail($id);

        $article->delete();

        return response()->json(null,204);
    }

    public function destroyAll(Request $request)
    {
        foreach ($request->items as $item) {
            $inventory = Inventory::find($item);
            $inventory->delete();
        }

        return response()->json(null,204);
    }

    public function selectColumn($column)
    {
        switch ($column) {
            case 'descripción':
                return 'description';
                break;
            case 'stock':
                return 'quantity_stock';
                break;
            case 'precio':
                return 'unit_price';
                break;
            case 'comisión':
                return 'percent_commission';
                break;
            default:
                return 'id';
                break;
        }
    }
}
