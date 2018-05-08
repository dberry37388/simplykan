<nav class="uk-navbar-container uk-light" uk-navbar>
    <div class="uk-navbar-left">

        <a class="uk-navbar-item uk-logo">
            <span class="material-icons">done_all</span> &nbsp;
            <img src="{{ asset('images/simplykan-logo.png') }}" alt="SimplyKan">
        </a>
    </div>

    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            @guest
                <li>
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>

                <li>
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li>
                    <a href="#">
                        <span uk-icon="icon: user"></span>
                    </a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>