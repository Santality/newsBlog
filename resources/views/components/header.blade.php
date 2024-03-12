<nav class="navbar bg-info navbar-expand-lg" data-bs-theme="light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">NewsBlog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="/reg">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth">Авторизация</a>
                </li>
                @endguest
                @auth
                @if (Auth::user()->id_role == 2)
                <li class="nav-item">
                    <a class="nav-link" href="/profile">Профиль</a>
                </li>
                @endif
                @if (Auth::user()->id_role == 1)
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Панель администратора</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addNews">Добавить новость</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/userList">Пользователи</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Выход</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
