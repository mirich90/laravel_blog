<div class="card-header">

    @include('posts.parts.breadcrumb')

    <h2>{{ $post->title }}</h2>

    {{-- @auth
        @if(Auth::user()->id !== $user->author_id) --}}

        {{-- <form
            action="#"
            method="POST"
        >
            <button type="submit" class="border-0 bg-transparent">
                <i class="far fa-heart text-danger"></i>
            </button>
        </form> --}}

        {{-- @endif

    @endauth --}}

    <div class="card-author"><b>Автор</b>: {{ $post->name }}</div>
    <div class="card-data"><b>Дата создания</b>: {{ $post->created_at }}</div>
    <div class="card-data"><b>Дата редактирования</b>: {{ $post->updated_at }}</div>
    <div class="card-date">{{ $post->created_at->diffForHumans() }}</div>
</div>