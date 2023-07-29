@extends('layouts.layout', ['title' => 'Главная страница'])

@section('content')

@if(isset($_GET['search']))
    @if(count($posts) > 0)
        <h2>Результаты поиска по запросу '<?=$_GET['search']?>'</h2>
        <p class="lead"> Всего найдено {{ count($posts) }} постов</p>
    @else
        <h2>По запросу <?=htmlspecialchars($_GET['search'])?> ничего не найдено</h2>
        <a href="{{ route('post.index')}}" class="btn btn-outline-primary"> Отобразить все посты</a>
    @endif
@endif

<div class="row">
    @if(count($posts) > 0)

        @foreach($posts as $post)

        <div class="col-12">
            <div class="card">
                <div class="row g-0">

                    <a href="{{ route('post.show', $post->id) }}" class="col-md-6">
                        <img src="{{ $post->img ?? asset('img/default.webp') }}" class="img-fluid rounded-start" alt="{{ $post->short_descr }}">
                    </a>

                    <div class="col-md-6">
                        <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p class="card-text"><?= $post->short_descr ?></p>
                        <div class="row">
                            <div class="card-author">{{ $post->name }}</div>

                            <p class="card-text ml-auto"><small class="text-body-secondary">
                                {{ $post->created_at->diffForHumans() }}
                            </small></p>

                        </div>
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