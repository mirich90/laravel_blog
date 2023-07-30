@extends('layouts.layout', ['title' => 'Главная страница'])

@section('content')

@if(isset($_GET['search']))
    @if(count($posts) > 0)
        <h2>Результаты поиска по запросу «<?=$_GET['search']?>»</h2>
        <p class="lead"> Всего найдено {{ count($posts) }} постов</p>
    @else
        <h2>По запросу <?=htmlspecialchars($_GET['search'])?> ничего не найдено</h2>
        <a href="{{ route('post.index')}}" class="btn btn-outline-primary"> Отобразить все посты</a>
    @endif
    
@elseif(isset($_GET['category']))
    @if(count($posts) > 0)
        @if($_GET['category'] == 0)
            <h2>Посты без категории</h2>
        @else
            <h2>Посты категории «<?=$category->title;?>»</h2>
        @endif
    @else
        <h2>Посты данной категории не найдены или категории не существует</h2>
    @endif
    <a href="{{ route('post.index')}}"> Отобразить все посты</a>
@endif

@if(count($posts) > 0)
    <div class="mt-4">
        @foreach($posts as $post)

        <div class="card mb-4">
            <div class="row g-0">

                <div class="col-md-6 pe-auto ">
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="{{ $post->img ?? asset('img/default.webp') }}" class="img-fluid rounded-start" alt="{{ $post->short_descr }}">
                    </a>
                </div>

                <div class="col-md-6 card-body">
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
        </div>

        @endforeach
    @else
        <h2>Постов пока нет</h2>
    @endif

</div>

{{ $posts->links() }}

@endsection