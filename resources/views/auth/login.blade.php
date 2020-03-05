@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card rounded shadow">
                    <div class="card-body">
                        <div class="col-md-6 offset-3">
                            <img class="img-fluid" src="{{asset('img/Logo-v.jpg')}}" alt="Acceder">
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mt-3">
                                <input class="mdl-textfield__input" type="email" id="email" name="email"
                                       value="{{ old('email') }}" required autofocus>
                                <label class="mdl-textfield__label" for="email">{{ __('E-Mail Address') }}</label>
                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mt-3">
                                <input class="mdl-textfield__input" type="password" id="password" name="password"
                                       value="{{ old('password') }}" required >
                                <label class="mdl-textfield__label" for="password">{{ __('Password') }}</label>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 mt-3">
                                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect w-100 rounded">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="col-md-12 mt-5">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-center w-100" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
