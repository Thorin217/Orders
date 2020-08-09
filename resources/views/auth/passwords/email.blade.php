@extends('layouts.guest')

@section('content')
    <div class="w-full max-w-md">
        <form method="POST" action="{{ route('password.email') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="py-0 px-0">
                <h2 class="font-bold text-xl mb-4">Reestablecer contraseña</h2>
            </div>
                @if (session('status'))
                    <div class="alert alert-success text-green-500  " role="alert">
                        {{ session('status') }}
                    </div>
                @else
                    <p class="text-left text-gray-500">Introduce tu correo para enviarte un enlace de reestablecimiento de contraseña</p>
                @endif
            <div class="py-4">
                <div class="w-full  px-0 outline-none rounded">
                    <label for="email">Correo</label>
                    <input
                        type="text"
                        class="
                            @error('email') is-invalid @enderror
                            shadow appearance-none border rounded w-full
                            py-2 px-3 text-gray-700 leading-tight focus:outline-none
                            focus:shadow-outline"
                        name="email"
                        id="email"
                        placeholder="Introduce tu correo"
                        value="{{ old('email') }}"
                        required autocomplete="email"
                        autofocus
                    >
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }} asfasfd</strong>
                        </span>
                    @enderror
                </div>
                <div class="w-full text-center mt-6">
                    <button type="submit" class="bg-gray-900 hover:bg-gray-800 py-2 px-4 text-white rounded-lg shadow-lg focus:outline-none">Enviar enlace</button>
                </div>
            </div>
        </form>
    </div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
