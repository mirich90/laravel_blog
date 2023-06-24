<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="#">Блог</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Найти пост..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">

        @foreach($posts as $post)

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $post->short_title }}</h2>
                </div>
                <div class="card-body">
                    <div class="card-img" style="background-image: url({{ $post->img ?? asset('img/default.webp') }})"></div>
                    <p>{{ $post->descr }}</p>

                    <div class="row">
                        <div class="card-author">{{ $post->name }}</div>
                        <a href="#" class="btn btn-outline-primary">Посмотреть пост</a>
                    </div>
                </div>
            </div>
        </div>

        @endforeach()

        </div>

        {{ $posts->links() }}
    </div>

</body>

</html>