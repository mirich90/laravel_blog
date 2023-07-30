<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Статьи</a>
        </li>

        <li class="breadcrumb-item">
            @if ($post->category)
                <a href="{{ route('post.index', ['category' => $post->category_id]) }}">
                    {{ $post->category }}
                </a>
            @else                    
                <a href="{{ route('post.index', ['category' => 0]) }}">без категории</a>
            @endif
        </li>

        <li class="breadcrumb-item active" aria-current="page">
            {{ (strlen ($post->title) > 30) ? mb_substr( $post->title, 0, 30 ).'...' : $post->title }}
        </li>
    </ol>
</nav>