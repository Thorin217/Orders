<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\Customer as CustomerDT;
use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use App\Helpers\ResizeImage;


class CustomerController extends Controller
{
    use ResizeImage;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ( $request->client == 'local' ) {
            $column = $this->selectColumn($request->column);

            $data = Customer::SearchPaginate($column);

            return CustomerDT::collection($data);
        }

        $customers = Customer::orderBy('name','ASC');

        return CustomerResource::collection($customers->get());
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
    public function store(StoreCustomer $request)
    {
        $user = User::find(Auth::id());

        if($request->file('attached'))
        {
            $path = $this->resize($request->file('attached'));
        }


        $customer = Customer::create([
            'type_customer_id'      => $request->type_customer,
            'business_name'         => $request->business_name ?? null,
            'name'                  => $request->name,
            'telephone'             => $request->telephone ?? null,
            'cellphone'             => $request->cellphone ?? null,
            'address'               => $request->address,
            'ncr'                   => $request->ncr ?? null,
            'nit'                   => $request->nit ?? null,
            'dui'                   => $request->dui,
            'attached'              => $path ?? null,
        ]);

        return response()->json([
            'message'           =>  'Cliente agregado con éxito',
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
        $customer = Customer::findOrFail($id);

        return response()->json(new CustomerResource($customer),200);
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
    public function update(UpdateCustomer $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $customer->update([
            'type_customer_id'      => $request->type_customer,
            'business_name'         => $request->business_name ?? null,
            'name'                  => $request->name,
            'telephone'             => $request->telephone ?? null,
            'cellphone'             => $request->cellphone ?? null,
            'address'               => $request->address,
            'ncr'                   => $request->ncr ?? null,
            'nit'                   => $request->nit ?? null,
            'dui'                   => $request->dui,
        ]);

        return response()->json([
            'message'           =>  'Cliente actualizado con éxito'
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
        $customer = Customer::findOrfail($id);

        $customer->delete();

        return response()->json([
            'message'           =>  'Cliente eliminado con éxito',
            'typeMessage'       =>  'success',
            'customer'           =>  $customer
        ],200);
    }


    public function selectColumn($column)
    {
        switch ($column) {
            case 'nombre':
                return 'name';
                break;
            case 'entidad':
                return 'business_name';
                break;
            case 'nit':
                return 'nit';
                break;
            case 'ncr':
                return 'ncr';
                break;
            case 'dui':
                return 'dui';
                break;
            default:
                return 'id';
                break;
        }
    }
}
