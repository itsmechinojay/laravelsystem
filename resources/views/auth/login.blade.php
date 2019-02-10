@extends('layouts.auth') 
@section('auth')
<div style="margin-top:8%" class="shadow-lg">
    <div class="card-group">
        <div class="card">
            <div class="row card-body p-5 rounded" style="background-image: url('{{ asset('image/wsi_logo_1.jpg')}}');width:600px;">
                {{--
                <div class="text-center">
                    <img src="{{ asset('image/wsi_logo_1.jpg')}}" class="mb-5" width="100%" alt="Modulr Logo">
                </div> --}}
                <div class="col-5">
                </div>
                <div class="col-7">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                placeholder="{{ __('Email Address') }}" required autofocus> @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span> @endif
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                            </div>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                placeholder="{{ __('Password') }}" required> @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span> @endif
                        </div>
                        <div class="row">
                            <div class="input-group mb-3 col-7">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary px4">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection