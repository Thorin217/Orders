@extends('layouts.guest')

@section('content')
    <div class="w-full max-w-md">
        <form method="POST" action="{{ route('password.update') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="py-0 px-0">
                <h2 class="font-bold text-xl mb-4">Reestablecer contraseña</h2>
            </div>

            <div class="py-4">
                <div class="w-full mb-4 px-0 outline-none rounded">
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

                <div class="w-full mb-4 px-0 outline-none rounded">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        class="
                            @error('password') is-invalid @enderror
                            shadow appearance-none border rounded w-full
                            py-2 px-3 text-gray-700 leading-tight focus:outline-none
                            focus:shadow-outline"
                        name="password"
                        id="password"
                        placeholder="Introduce tu nueva contraseña"
                        autofocus
                    >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }} asfasfd</strong>
                        </span>
                    @enderror
                </div>
                <div class="w-full mb-4 px-0 outline-none rounded">
                    <label for="password-confirm">Confirmar contraseña</label>
                    <input
                        type="password"
                        class="
                            shadow appearance-none border rounded w-full
                            py-2 px-3 text-gray-700 leading-tight focus:outline-none
                            focus:shadow-outline"
                        name="password_confirmation"
                        id="password-confirm"
                        placeholder="Confirmar contraseña"
                        required autocomplete="new-password"
                        autofocus
                    >
                </div>

                <div class="w-full text-center mt-6">
                    <button type="submit" class="bg-gray-900 hover:bg-gray-800 py-2 px-4 text-white rounded-lg shadow-lg focus:outline-none">Reestablecer contraseña</button>
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
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
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
