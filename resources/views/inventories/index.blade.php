@extends('layouts.app')

@section('header-content')
    <div class="flex justify-between text-white">
        <div class="flex-1">
            <h3 class="text-2xl font-bold leading-10">@lang('general.orders.title-orders')</h3>
        </div>
    </div>
@endsection

@section('content')
    <inventories-component></inventories-component>
@endsection
