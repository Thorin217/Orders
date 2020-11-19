@extends('layouts.guest')

@section('content')
add
<div class="content flex relative w-full md:w-3/5 bg-white rounded-lg shadow-lg overflow-hidden p-0">
    <div class="content-form flex-1 w-full p-8">
        <form action="{{ route('login') }}" method="POST" class="text-blue-900">
            @csrf
            <div class="py-0 px-4">
                <h2 class="font-bold text-3xl">Login</h2>
            </div>
            <div class="py-12 px-4">
                <div class="w-full lg:w-1/2 my-3 px-0 outline-none rounded">
                    <label for="username">@lang('forms.username')</label>
                    <input
                        type="text"
                        class="
                            @error('username') is-invalid @enderror
                            shadow appearance-none border rounded w-full
                            py-2 px-3 text-gray-700 leading-tight focus:outline-none
                            focus:shadow-outline"
                        name="username"
                        id="username"
                        placeholder="@lang('forms.username')"
                        value="{{ old('username') }}"
                        required autocomplete="username"
                        autofocus
                    >
                </div>
                <div class="w-full lg:w-1/2 my-3 px-0 outline-none rounded">
                    <label for="password">@lang('forms.password')</label>
                    <input
                        type="password"
                        class="
                            shadow appearance-none border rounded w-full
                            py-2 px-3 text-gray-700 leading-tight focus:outline-none
                            focus:shadow-outline"
                        name="password"
                        id="password"
                        placeholder="@lang('forms.password')"
                        required autocomplete="current-password"
                    >
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }} asfasfd</strong>
                        </span>
                    @enderror
                </div>
                <div class="w-full lg:w-1/2 grid grid-rows-1 grid-flow-col gap-6 mb-6">
                    <div>
                        <input type="checkbox" class="cursor-pointer" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="cursor-pointer">@lang('forms.remember')</label>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="text-right text-sm">
                            <a href="{{ route('password.request') }}" class=" hover:text-blue-500">@lang('forms.forgot')</a>
                        </div>
                    @endif
                </div>
                <div class="w-full lg:w-1/2 text-center lg:text-right">
                    <button type="submit" class="bg-gray-900 hover:bg-gray-800 py-2 px-4 text-white rounded-lg shadow-lg focus:outline-none">@lang('forms.login')</button>
                </div>
            </div>
        </form>
    </div>
    <div class="image-login absolute right-0 h-full hidden lg:block w-3/5">
        <div class="text-right text-white py-2 px-3">
            <h1 class="text-3xl font-bold">{{ config('app.name', 'Laravel') }}</h1>
            <h3 class="text-xl">@lang('forms.descriptionapp')</h3>
        </div>
    </div>
</div>
@endsection
            