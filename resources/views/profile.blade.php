<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NewsBlog - Профиль</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <x-header></x-header>
    <div class="container">
        <h2 class="mt-3">Профиль</h2>
        <form method="POST" action="/editProfile">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Имя пользователя</label>
                <input type="text" id="username" class="form-control" name="username" value="{{ Auth::user()->username }}">
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
                <input type="email" id="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
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
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Оставьте пустым если не хотите менять">
                @error('password')
                    <div class="alert alert-danger alert-dismissible">
                        <div class="alert-text">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-info">Сохранить</button>
        </form>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible mt-3">
                <div class="alert-text">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        <h2 class="mt-4">Комментарии пользователя</h2>
            @forelse ($comments as $comment)
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="/news/{{ $comment->news->id }}">
                            <h5 class="card-title">{{ $comment->news->title }}</h5>
                        </a>
                        <p class="card-text">{{ $comment->comment_text }}</p>
                    </div>
                </div>
            @empty
                <h5>Пусто...</h5>
            @endforelse
            <h2 class="mt-4">Лайки пользователя</h2>
            @forelse ($likes as $like)
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="/news/{{ $like->news->id }}">
                            <h5 class="card-title">{{ $like->news->title }}</h5>
                        </a>
                        <p class="card-text">Лайк поставлен: {{ date('d.m.Y', strtotime($like->created_at)) }}</p>
                    </div>
                </div>
            @empty
                <h5>Пусто...</h5>
            @endforelse
    </div>
</body>
</html>
