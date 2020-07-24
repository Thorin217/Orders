@extends('layouts.app')

@section('header-content')
    <div class="flex justify-between">
        <div class="flex-1">
            <h3 class="text-3xl font-bold leading-10">@lang('general.customers.title-customers')</h3>
        </div>
    </div>
@endsection

@section('content')
    <data-table-component
        :columns="{{json_encode($columns)}}"
        :model="'inventario'"
        :source="'{{route('inventories.index')}}'"
    ></data-table-component>
@endsection
