@extends('layouts.layout', ['title' => 'Главная страница'])

@section('content')

    @if (isset($_GET['search']))
        @if (count($posts) > 0)
            <h2>Результаты поиска по запросу «<?= $_GET['search'] ?>»</h2>
            <p class="lead"> Всего найдено {{ count($posts) }} постов</p>
        @else
            <h2>По запросу <?= htmlspecialchars($_GET['search']) ?> ничего не найдено</h2>
        @endif
    @elseif(isset($_GET['category']))
        @if (count($posts) > 0)
            @if ($_GET['category'] == 0)
                <h2>Посты без категории</h2>
            @else
                <h2>Посты категории «<?= $category->title ?>»</h2>
            @endif
        @else
            <h2>Посты данной категории не найдены или категории не существует</h2>
        @endif
    @endif


    <div class="mt-4 mb-4">
        <a href="{{ route('post.index') }}"
            class="btn {{ isset($_GET['category']) ? 'btn-outline-primary' : 'btn-primary' }}"> Все посты</a>
        @if (count($categories) > 0)
            @foreach ($categories as $category)
                <a href=" {{ route('post.index', ['category' => $category->id]) }}"
                    class="btn {{ isset($_GET['category']) && $_GET['category'] == $category->id ? 'btn-primary' : 'btn-outline-primary' }}">
                    {{ $category->title }}
                    {{-- <span class="badge text-bg-secondary">4</span> --}}
                </a>
            @endforeach
        @endif
    </div>

    @if (count($posts) > 0)
        <div class="mt-4">
            @foreach ($posts as $post)
                <div class="card">

                    <a class="card-image" href="{{ route('post.show', $post->id) }}">
                        <img src="{{ $post->img ?? asset('img/default.webp') }}" class="img-fluid rounded-start"
                            alt="{{ $post->short_descr }}">
                    </a>

                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p class="card-text"><?= $post->short_descr ?></p>

                        <div class="d-flex justify-content-between">
                            <div class="card-author">{{ $post->name }}</div>

                            <p class="card-text"><small class="text-body-secondary">
                                    {{ $post->created_at->diffForHumans() }}
                                </small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h2>Постов пока нет</h2>
    @endif

    </div>

    {{ $posts->links() }}

@endsection
