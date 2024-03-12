<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NewsBlog - Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <x-header></x-header>
    <div class="container">
        <h2 class="mt-3">Регистрация</h2>
        <form method="POST" action="/signup">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Имя пользователя</label>
                <input type="text" name="username" class="form-control" id="username">
                @error('username')
                    <div class="alert alert-danger alert-dismissible">
                        <div class="alert-text">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Почта</label>
                <input type="email" name="email" class="form-control" id="email">
                @error('email')
                    <div class="alert alert-danger alert-dismissible">
                        <div class="alert-text">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label ">Пароль</label>
                <input type="password" name="password" class="form-control" id="password">
                @error('password')
                    <div class="alert alert-danger alert-dismissible">
                        <div class="alert-text">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label ">Повторите пароль</label>
                <input type="password" name="password_confirm" class="form-control" id="password_confirm">
                @error('password_confirm')
                    <div class="alert alert-danger alert-dismissible">
                        <div class="alert-text">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-info">Зарегистрироваться</button>
        </form>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible mt-3">
                <div class="alert-text">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
    </div>
</body>

</html>
