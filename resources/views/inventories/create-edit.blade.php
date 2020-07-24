@extends('layouts.app')

@section('header-content')
    <div class="flex justify-between">
        <div class="flex-1">
            <h3 class="text-3xl font-bold leading-10">@if(isset($article)) Editar artículo @else Nuevo artículo @endif</h3>
        </div>
    </div>
@endsection

@section('content')
    <div class="flex flex-col shadow bg-white rounded py-6 px-4">
        <div class="flex-1 border-b mb-4 pb-8">
            <div class="flex items-center align-middle content-center">
                <div class="flex-auto w-1/4">
                    <strong class="text-base">Descripción</strong>
                </div>
                <div class="flex-auto w-3/4">
                    <input type="text" class="w-1/2 shadow appearance-none border rounded-lg py-2 px-2 focus:shadow-outline focus:outline-none"
                        name="description" id="description"
                        value="@if(isset($article)) {{ $article->description }} @endif "
                        placeholder="@if(!$article) Descripción @endif"
                    >
                </div>
            </div>
        </div>
        <div class="flex-1 border-b mb-4 pb-8">
            <div class="flex items-center align-middle content-center">
                <div class="flex-auto w-1/4">
                    <strong class="text-base">Cantidad</strong>
                </div>
                <div class="flex-auto w-3/4">
                    <input type="number" class="w-32 shadow appearance-none border rounded-lg py-2 px-2 focus:shadow-outline focus:outline-none"
                        name="quantity_stock" id="quantity-stock"
                        value="@if($article){{$article->quantity_stock}}@else 0 @endif"
                    >
                </div>
            </div>
        </div>
        <div class="flex-1 border-b mb-4 pb-8">
            <div class="flex items-center align-middle content-center">
                <div class="flex-auto w-1/4">
                    <strong class="text-base">Precio</strong>
                </div>
                <div class="flex-auto w-3/4 relative">
                    <span class="text-gray-500 absolute w-6 h-6 mt-2 ml-2 text-base">$</span>
                    <input type="number" class="w-32 shadow appearance-none border rounded-lg py-2 pl-6 pr-2 focus:shadow-outline focus:outline-none"
                        name="unit_price" id="unit-price"
                        step="0.01"
                        value="@if($article){{$article->unit_price}}@else 0,00 @endif"
                    >
                </div>
            </div>
        </div>
        <div class="flex-1 border-b mb-4 pb-8">
            <div class="flex items-center align-middle content-center">
                <div class="flex-auto w-1/4">
                    <strong class="text-base">Porcentaje de comisión</strong>
                </div>
                <div class="flex-auto w-3/4 relative">
                    <span class="text-gray-500 absolute w-6 h-6 mt-2 ml-2 text-base">%</span>
                    <input type="number" class="w-32 shadow appearance-none border rounded-lg py-2 pl-6 pr-2 focus:shadow-outline focus:outline-none"
                        name="percent_commission" id="percent-commission"
                        step="0.01"
                        value="@if($article){{$article->percent_commission}}@else 0,00 @endif"
                    >
                </div>
            </div>
        </div>
    </div>
@endsection
