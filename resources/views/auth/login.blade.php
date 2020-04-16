@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-body text-center">
                    <h4>Sistem Informasi Penelitian, Pengabdian Masyarakat dan Inovasi</h4>
                </div>
            </div>


            <div class="card-group">
                <div class="card p-4">

                    <div class="card-body">

                        <p class="text-muted">{{ trans('global.login') }}</p>

                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg class="c-icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                </svg>
                            </span>
                                </div>

                                <input id="username" name="username" type="text"
                                       class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" required
                                       autofocus placeholder="NIDN" value="{{ old('username', null) }}"/>

                                @if($errors->has('username'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                        </svg>
                                    </span>
                                    </div>
                                </div>

                                <input id="password" name="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required
                                       placeholder="{{ trans('global.login_password') }}">

                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>

                            <div class="input-group mb-4">
                                <div class="form-check checkbox">
                                    <input class="form-check-input" name="remember" type="checkbox" id="remember"
                                           style="vertical-align: middle;"/>
                                    <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                        {{ trans('global.remember_me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary px-4">
                                        {{ trans('global.login') }}
                                    </button>
                                </div>
                                <div class="col-6 text-right">
                                    @if(Route::has('password.request'))
                                        <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                            Lupa Password?
                                        </a><br>
                                    @endif

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <div>
                            <img src="{{ asset('img/logo-unand.png') }}" class="img-fluid" width="120"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
