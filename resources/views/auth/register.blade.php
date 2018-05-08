@extends('layouts.app')

@section('content')
    <div class="uk-container">
        <div class="uk-flex-center" uk-grid>
            <div class="uk-width-1-2@m">
                <div class="uk-card uk-card-default">

                    <div class="uk-card-header">
                        <div class="uk-card-title">
                            Create Your {{ config('app.name') }} Account
                        </div>
                    </div>

                    <div class="uk-card-body">

                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            <fieldset class="uk-fieldset">

                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" data-uk-icon="icon: user"></span>
                                        <input type="text" name="first_name" id="first_name" class="uk-input{{ $errors->has('first_name') ? ' uk-form-danger' : '' }}"
                                               placeholder="{{ __('First Name') }}" value="{{ old('first_name') }}" required>
                                    </div>

                                    @if($errors->has('first_name'))
                                        <small class="uk-text-danger">
                                            {{ $errors->first('first_name') }}
                                        </small>
                                    @endif
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" data-uk-icon="icon: user"></span>
                                        <input name="last_name" id="last_name" class="uk-input{{ $errors->has('last_name') ? ' uk-form-danger' : '' }}"
                                               placeholder="{{ __('Last Name') }}" type="text" value="{{ old('last_name') }}" required>
                                    </div>

                                    @if($errors->has('last_name'))
                                        <small class="uk-text-danger">
                                            {{ $errors->first('last_name') }}
                                        </small>
                                    @endif
                                </div>

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
                                        {{ __('Create Account') }}
                                    </button>
                                </div>

                                <p class="uk-text-small uk-text-center uk-text-muted">
                                    Already have a {{ config('app.name') }} account? <a href="{{ route('login') }}">{{ __('Sign in') }}.</a>
                                </p>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
