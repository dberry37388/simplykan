<div class="uk-card uk-card-default {{ $class ?? '' }}">

    <div class="uk-card-header">
        <h3 class="uk-card-title">{{ $title }}</h3>
    </div>

    <div class="uk-card-body">
        {{ $slot }}
    </div>
</div>