@extends('layouts.app')

@section('content')

    <div class="uk-container">

        <ul class="uk-breadcrumb">
            <li><a href="">Projects</a></li>
            <li><span>{{ $project->title }}</span></li>
        </ul>


        @card
            @slot('title')
                {{ $project->title }}
            @endslot

            <p class="project__description">
                {{ $project->description }}
            </p>
        @endcard
    </div>

@endsection