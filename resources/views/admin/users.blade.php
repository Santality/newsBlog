<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ панель</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <x-header></x-header>
    <main>
        <div class="container">
            <h1 class="my-3">Список пользователей</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Имя пользователя</th>
                        <th scope="col">Почта</th>
                        <th scope="col">Статус блокировки</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            @if ($user->is_blocked == 0)
                                <td class="text-success">Нет ограничений</td>
                            @else
                                <td class="text-danger">Забанен</td>
                            @endif
                            @if ($user->is_blocked == 0)
                                <td><a href="/blockUser/{{ $user->id }}"
                                        class="btn btn-danger">Заблокировать</a>
                                </td>
                            @else
                                <td><a href="/unblockUser/{{ $user->id }}"
                                        class="btn btn-success">Разблокировать</a></td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </main>
</body>

</html>
