<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $id->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <x-header></x-header>
        @if ($id->is_blocked == 0)
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible mt-3">
                        <div class="alert-text">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible mt-3">
                        <div class="alert-text">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif
                <h1 class="my-2">{{ $id->title }}</h1>
                <p class="text-muted">Опубликовано: {{ date('d.m.Y', strtotime($id->created_at)) }}</p>
                <img style="max-width: 40%" src="/storage/news/{{ $id->photo }}" class="img-fluid mb-3"
                    alt="{{ $id->photo }}">
                <p class="card-text">{{ $id->content }}</p>
                <div class="my-2">
                    <a class="btn btn-info" href="/like/{{ $id->id }}">Лайки: {{ $id->LikeCount() }}</a>
                </div>
                <h2 class="my-4">Комментарии</h2>
                @auth
                <form method="POST" action="/commentCreate">
                    @csrf
                    <input type="hidden" name="id" value="{{$id->id}}">
                    <div class="mb-2">
                        <textarea class="form-control" rows="2" name="comment" placeholder="Оставьте комментарий первым"></textarea>
                    </div>
                    @error('comment')
                        <div class="alert alert-danger alert-dismissible">
                            <div class="alert-text">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-info">Оставить</button>
                </form>
                @endauth
                @foreach ($id->comment as $item)
                    <div class="card card-body mt-2">
                        <h5 class="card-title">{{ $item->usersComment->username }}</h5>
                        <p class="card-text">{{ $item->comment_text }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="container">
                <h2 class="text-danger mt-3">Новость заблокирована!</h2>
                <a href="/" class="btn btn-primary mt-2">На главную</a>
            </div>
        @endif
</body>

</html>
