@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @card
                @slot('title')
                    Dashboard
                @endslot

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                Welcome back {{ auth()->user()->first_name }}
            @endcard
        </div>
    </div>
</div>
@endsection
