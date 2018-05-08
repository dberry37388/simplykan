@extends('layouts.app')

@section('content')

    <div class="uk-container">
        <div class="uk-flex-center" uk-grid>
            <div class="uk-width-1-2@m">
                <div class="uk-card uk-card-default">

                    <div class="uk-card-header">
                        <div class="uk-card-title">
                            Sign Into Your Account
                        </div>
                    </div>

                    <div class="uk-card-body">

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <fieldset class="uk-fieldset">
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" data-uk-icon="icon: mail"></span>
                                        <input name="email" id="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}"
                                               placeholder="{{ __('Email Address') }}" type="text" required>
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
                                        <input name="password" id="password" class="uk-input" placeholder="Password"
                                               type="password" required>
                                    </div>

                                    @if($errors->has('password'))
                                        <small class="uk-text-danger">
                                            {{ $errors->first('password') }}
                                        </small>
                                    @endif
                                </div>

                                <div class="uk-margin">
                                    <button type="submit" class="uk-button uk-button-primary uk-button-primary uk-button-large uk-width-1-1">LOG IN</button>
                                </div>

                                <p class="uk-text-small uk-text-center uk-text-muted">
                                    Forgot your password? We can help with that.
                                    <a href="{{ route('password.request') }}">Click here</a> to request a new one.
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
