<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Trolley;
use App\DeliveryType;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\User;
use App\Inventory;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at','DESC');

        return OrderResource::collection($orders->paginate(10));
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
        $customer = Customer::findOrFail($request->customer);

        $user = User::find(Auth::id());

        $order = Order::create([
                    'customer_id'         => $customer->id,
                    'delivery_type_id'    => $request->delivery_type,
                    'address'             => $request->address,
                    'user_id'             => $user->id,
                    'payment_type_id'     => $request->payment_type,
                    'description'         => $request->description,
                ]);

        $trolleys = $this->storeTrolley($order, $request->articles);

        $order->fill([
            'total_order' => $trolleys->sum('unit_total')
        ]);

        $order->save();

        return response()->json([
            'message'       => 'Pedido creado con éxito',
            'type'          => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        return new OrderResource($order);
    }

    /**
     * Store a newly created resource array @App\Trolley in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeTrolley($order, $articles)
    {
        if($order->trolleys->count() > 0){
            $deleteTrolleys = $order->trolleys;
            $myarticles =  collect($articles);
            $deleteTrolleys = $deleteTrolleys->whereNotIn('id',$myarticles->pluck('inventory_id'));
            Trolley::whereIn('id',$deleteTrolleys->pluck('id'))->delete();
        }

        foreach ($articles as  $article) {
            $thisarticle = Inventory::find($article['inventory_id']);


            $unit_total = ($thisarticle->unit_price * $article['quantity']) - $article['discount'] ?? 0.00;
            $trolley = $order->trolleys()->updateOrCreate(
                [
                'inventory_id'  => $article['inventory_id']
                ],
                [
                    'quantity'      => $article['quantity'],
                    'discount'      => $article['discount'],
                    'unit_total'    => $unit_total
                ]);
        }

        $order->refresh();

        return $order->trolleys;
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
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $customer = Customer::findOrFail($request->customer);

        if($order->delivery_type_id != $request->delivery_type)
        {
            $order->orderable()->delete();
            $delivery = DeliveryType::find($request->delivery_type);
            if($delivery->name == 'Domicilio'){
                $state = HomeState::create();
                $order->update([
                    'customer_id'           => $customer->id,
                    'delivery_type_id'      => $request->delivery_type,
                    'payment_type_id'       => $request->payment_type,
                    'orderable_id'          => $state->id,
                    'orderable_type'        => 'App\HomeState'
                ]);
            }else{
                $state = LocalState::create();
                $order->update([
                    'customer_id'           => $customer->id,
                    'delivery_type_id'      => $request->delivery_type,
                    'payment_type_id'       => $request->payment_type,
                    'address'               => $request->address,
                    'orderable_id'          => $state->id,
                    'orderable_type'        => 'App\LocalState'
                ]);
            }
        }else{
            $order->update([
                'customer_id'           => $customer->id,
                'payment_type_id'       => $request->payment_type,
            ]);
        }

        $trolleys = $this->storeTrolley($order, $request->articles);

        $order->fill([
            'total_order' => $trolleys->sum('unit_total')
        ]);

        $order->save();

        return response()->json([
            'message'       => 'Pedido actualizado con éxito',
        ]);

    }

    public function changeStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update(['status' => $request->status]);

        return response()->json(['message' => 'El estado ha sido actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
