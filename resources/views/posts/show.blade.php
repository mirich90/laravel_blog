@extends('layouts.layout', ['title' => $post->title])

@section('content')

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $post->title }}</h2>
                    <div class="card-author">Автор: {{ $post->name }}</div>
                    <div class="card-date">{{ $post->created_at->diffForHumans() }}</div>
                </div>
                <div class="card-body">
                    <div class="card-img card-img__max" style="background-image: url({{ $post->img ?? asset('img/default.webp') }})"></div>

                    <div class="trix-content"><?= $post->descr ?></div>

                    <div class="card-btn">
                        <a href="{{ route('post.index') }}" class="btn btn-outline-primary">На главную</a>

                        @auth
                            @if(Auth::user()->id == $post->author_id)
                                <a href="{{ route('post.edit', ['id'=>$post->post_id]) }}" class="btn btn-outline-success">Редактировать</a>

                                <form action="{{ route('post.destroy', ['id'=>$post->post_id]) }}" method="post" onsubmit="if (confirm('Точно удалить пост?')) { return true} else {return false}">
                                    @csrf
                                    @method('DELETE')

                                    <input type="submit" class="btn btn-outline-danger" value="Удалить">
                                </a>
                            @endif

                        @endauth
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection