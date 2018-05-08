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

                        <form action="{{ route('password.email') }}" method="post">
                            @csrf

                            <fieldset class="uk-fieldset">
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" data-uk-icon="icon: mail"></span>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
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
                                    <button type="submit" class="uk-button uk-button-primary uk-button-primary uk-button-large uk-width-1-1">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>

                                <p class="uk-text-small uk-text-center uk-text-muted">
                                    Already have a {{ config('app.name') }} account? <a href="{{ route('login') }}">{{ __('Sign in') }}.</a>
                                </p>
                            </fieldset>
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