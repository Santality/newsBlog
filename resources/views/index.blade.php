<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NewsBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        .card-text {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
        }
    </style>
</head>

<body>
    <x-header></x-header>
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
        <h1 class="my-4">Популярные новости</h1>
        <div class="row">
            @forelse ($populars as $popular)
                <div class="col-12 col-md-4">
                    <div class="card mb-4">
                        <img src="/storage/news/{{ $popular->photo }}" class="card-img-top" alt="{{ $popular->photo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $popular->title }}</h5>
                            <p class="card-text">{{ $popular->content }}</p>
                            <a href="/news/{{ $popular->id }}" class="btn btn-info">Читать далее...</a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <h1 class="my-4">Категории</h1>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <li class="list-group-item">
                                <a href="/list/{{ $category->id }}" class="card-link link-info">
                                    {{ $category->name }}
                                </a>
                            </li>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <h1 class="my-4">Последние новости</h1>
        <div class="row">
            @forelse ($latest as $last)
                <div class="col-12 col-md-3">
                    <div class="card mb-3">
                        <img src="/storage/news/{{ $last->photo }}" class="card-img-top" alt="{{ $last->photo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $last->title }}</h5>
                            <p class="card-text">{{ $last->content }}</p>
                            <a href="/news/{{ $last->id }}" class="btn btn-info">Читать далее...</a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <div class="mt-3">{{ $latest->withQueryString()->links('pagination::bootstrap-5') }}</div>
    </div>
</body>

</html>
