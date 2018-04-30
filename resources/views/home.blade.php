@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <dashboard-welcome-card :user="{{ auth()->user() }}"></dashboard-welcome-card>

           <div class="mt-3">
               <my-teams-card
                       :teams="{{ auth()->user()->teams()->with('owner')->with('parent')->get() }}">
               </my-teams-card>
           </div>
        </div>
    </div>
</div>
@endsection
