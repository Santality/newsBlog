<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $category->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        .card-text {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            line-clamp: 4;
            -webkit-box-orient: vertical;
        }
    </style>
</head>

<body>
    <x-header></x-header>
    <div class="container">
        <h1 class="my-3">{{ $category->name }}</h1>
        <div class="row">
            @forelse ($filters as $news)
                <div class="col-6 col-md-4">
                    <div class="card mb-4">
                        <img src="/storage/news/{{ $news->photo }}" class="card-img-top" alt="{{ $news->photo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $news->title }}</h5>
                            <p class="card-text">{{ $news->content }}</p>
                            <a href="/news/{{ $news->id }}" class="btn btn-info">Читать далее...</a>
                        </div>
                    </div>
                </div>
            @empty
                <h2>Похоже новостей нет...</h2>
            @endforelse
        </div>
        <div class="mt-3">{{ $filters->withQueryString()->links('pagination::bootstrap-5') }}</div>
    </div>
</body>

</html>
