@extends('layouts.app')

@section('content')

    <div class="uk-container">
        @card(['class' => 'uk-card-small'])
            @slot('title')
                Dashboard
            @endslot

            @if (session('status'))
                <div class="uk-alert-success" uk-alert>
                    {{ session('status') }}
                </div>
            @endif

            <p>
                Welcome back {{ auth()->user()->first_name }}
            </p>
        @endcard
    </div>
@endsection
