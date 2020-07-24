@extends('layouts.app')

@section('header-content')
    <div class="flex justify-between">
        <div class="flex-1">
            <h3 class="text-2xl font-bold leading-10">Detalles del Artículo</h3>
        </div>
        <div class="flex-1">
            <div class="flex justify-end content-end">
                <button type="button" class="btn bg-white hover:bg-gray-100 focus:outline-none shadow"><span class="dripicons-trash" aria-hidden="true"></span></button>
                <a href="{{ route('inventories.edit', $article->id) }}" class="btn ml-2 bg-gray-800 hover:bg-gray-900 text-white shadow"><span class="dripicons-document-edit" aria-hidden="true"></span></a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="bg-white shadow rounded px-4 py-6">
        <div class="flex border-b mb-2">
            <div class="flex-auto w-64 py-2">
                ID
            </div>
            <div class="flex-auto w-full py-2 font-bold">
                {{ $article->id }}
            </div>
        </div>
        <div class="flex border-b mb-2">
            <div class="flex-auto w-64 py-2">
                Descripción
            </div>
            <div class="flex-auto w-full py-2 font-bold">
                {{ $article->description }}
            </div>
        </div>
        <div class="flex border-b mb-2">
            <div class="flex-auto w-64 py-2">
                Cantidad
            </div>
            <div class="flex-auto w-full py-2 font-bold">
                {{ $article->quantity_stock }}
            </div>
        </div>
        <div class="flex border-b  mb-2">
            <div class="flex-auto w-64 py-2">
                Precio
            </div>
            <div class="flex-auto w-full py-2 font-bold">
                ${{ $article->unit_price }}
            </div>
        </div>
        <div class="flex border-b mb-2">
            <div class="flex-auto w-64 py-2">
                Porcentaje de comisión
            </div>
            <div class="flex-auto w-full py-2 font-bold">
                {{ $article->percent_commission }} %
            </div>
        </div>
        <div class="flex border-b mb-2">
            <div class="flex-auto w-64 py-2">
                Última actualización
            </div>
            <div class="flex-auto w-full py-2 font-bold">
                {{ \Carbon\Carbon::parse($article->updated_at)->diffForHumans() }}
            </div>
        </div>
        <div class="flex border-b mb-2">
            <div class="flex-auto w-64 py-2">
                Fecha de creación
            </div>
            <div class="flex-auto w-full py-2 font-bold">
                {{ \Carbon\Carbon::parse($article->created_at)->format('Y-m-d') }}
            </div>
        </div>
    </div>
@endsection
