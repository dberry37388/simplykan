@extends('layouts.app')

@section('content')

   <div class="uk-container">
       @card
           @slot('title')
               Create Project
           @endslot

           <form class="uk-form-horizontal" method="post" action="{{ route('storeProject') }}">

               @csrf

               @if ($errors->any())
                   <div class="uk-alert-danger" uk-alert>
                       {{ var_dump($errors->all()) }}
                   </div>
               @endif

               <div class="uk-margin">
                   <label class="uk-form-label" for="form-horizontal-text">{{ __('Prefix') }}</label>

                   <div class="uk-form-controls">
                       <input class="uk-input" id="prefix" name="prefix" type="text" placeholder="Give your project a prefix." maxlength="3">
                   </div>
               </div>

               <div class="uk-margin">
                   <label class="uk-form-label" for="form-horizontal-text">{{ __('Title') }}</label>

                   <div class="uk-form-controls">
                       <input class="uk-input" id="title" name="title" type="text" placeholder="Give your project a title.">
                   </div>
               </div>

               <div class="uk-margin">
                   <label class="uk-form-label" for="form-horizontal-text">{{ __('Description') }}</label>

                   <div class="uk-form-controls">
                       <textarea class="uk-textarea" name="description" id="description" rows="5" placeholder="Provide a brief description of the project."></textarea>
                   </div>
               </div>

               <div class="uk-margin">

                   <div class="uk-form-controls">
                       <button class="uk-button uk-button-primary">Create Project</button>
                   </div>
               </div>
           </form>
       @endcard
   </div>

@endsection