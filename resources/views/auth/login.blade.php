<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            *{
                box-sizing: border-box;
                padding: 0;
                margin: 0;
            }
            .image-login{
               background: linear-gradient(rgb(41, 19, 114),rgb(21, 26, 53 ));
               clip-path: polygon(0 0, 100% 0, 100% 100%, 70% 100%)
            }

            .content:hover{
                transform: translateY(-10px) rotate(-1deg)
            }

            .content-form{
                transform: 0.5s
            }
        </style>
    </head>
    <body class="h-full bg-gray-100">
        <div class="flex justify-center items-center h-full">
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
                                <button type="submit" class="bg-blue-900 hover:bg-blue-800 py-2 px-4 text-white rounded-lg shadow-lg focus:outline-none">@lang('forms.login')</button>
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
        </div>
    </body>
</html>
