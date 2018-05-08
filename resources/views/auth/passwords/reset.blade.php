@extends('layouts.app')

@section('content')
    <div class="uk-container">
        <div class="uk-flex-center" uk-grid>
            <div class="uk-width-1-2@m">
                <div class="uk-card uk-card-default">

                    <div class="uk-card-header">
                        <div class="uk-card-title">
                            {{ __('Reset Your Password') }}
                        </div>
                    </div>

                    <div class="uk-card-body">

                        @if (session('status'))
                            <div class="uk-alert-success" uk-alert>
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('password.request') }}" method="post">
                            @csrf

                            <fieldset class="uk-fieldset">
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" data-uk-icon="icon: mail"></span>
                                        <input type="email" name="email" id="email" value="{{ $email ?? old('email') }}"
                                               class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}"
                                               placeholder="{{ __('Email Address') }}" required>
                                    </div>

                                    @if($errors->has('email'))
                                        <small class="uk-text-danger">
                                            {{ $errors->first('email') }}
                                        </small>
                                    @endif
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" data-uk-icon="icon: lock"></span>
                                        <input type="password" name="password" id="password"
                                               class="uk-input{{ $errors->has('password') ? ' uk-form-danger' : '' }}"
                                               placeholder="Password" required>
                                    </div>

                                    @if($errors->has('password'))
                                        <small class="uk-text-danger">
                                            {{ $errors->first('password') }}
                                        </small>
                                    @endif
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" data-uk-icon="icon: lock"></span>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                               class="uk-input{{ $errors->has('password_confirmation') ? ' uk-form-danger' : '' }}"
                                               placeholder="{{ __('Retype Password') }}" required>
                                    </div>

                                    @if($errors->has('password_confirmation'))
                                        <small class="uk-text-danger">
                                            {{ $errors->first('password_confirmation') }}
                                        </small>
                                    @endif
                                </div>

                                <div class="uk-margin">
                                    <button type="submit" class="uk-button uk-button-primary uk-button-primary uk-button-large uk-width-1-1">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>

                                <p class="uk-text-small uk-text-center uk-text-muted">
                                    Already have a {{ config('app.name') }} account? <a href="{{ route('login') }}">{{ __('Sign in') }}.</a>
                                </p>
                            </fieldset>

                            <input type="hidden" name="token" value="{{ $token }}">
                        </form>
                    </div>

                    <div class="uk-card-footer">
                        <p class="uk-text-small">
                            Don't have a {{ config('app.name') }} account? <a href="{{ route('register') }}">Click here</a>
                            to sign up for your 30-day free trial. No credit card required, and it only takes a few seconds.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contentd')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @card
                @slot('title')
                    {{ __('Reset Password') }}
                @endslot

                <div class="card-body">
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
            @endcard
        </div>
    </div>
</div>
@endsection
