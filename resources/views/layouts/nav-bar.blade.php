<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">Все объявления<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                @include('category.index')
            </li>
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('add_advert')}}">Добавить объявление</a>
                </li>
            @endauth
        </ul>
        <ul class="navbar-nav ml-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('profile')}}">{{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">Выход</a>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Вход</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">Регистрация</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
