@extends('layouts.app')

@section('header-content')
    <div class="flex justify-between">
        <div class="flex-1">
            <h3 class="text-2xl font-bold leading-10 text-gray-800">sds @lang('general.orders.title-orders')</h3>
        </div>
    </div>
@endsection

@section('content')
    <div class="bg-white w-full mx-auto rounded shadow-lg">
        <h5 class="text-base">
            Pedidos
        </h5>
        <div class="flex justify-between">
            <div>
                Mostrar <select name="" id="">
                            <option value="0">10</option>
                        </select>
                Artículos
            </div>
            <div class="text-right">
                <input type="search" name="search" id="search-orders">
                <button class=""><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
        <div>
            <div class="flex flex-row">

            </div>
        </div>
    </div>
    {{-- <orders-component></orders-component> --}}
@endsection
