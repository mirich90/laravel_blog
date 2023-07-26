@extends('layouts.layout', ['title' => "Создать новую категорию"])

@section('content')
    <form action="{{ route('category.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <h3>Создать категорию</h3>
        @include('categories.parts.form')

        @auth
            {{-- @if(Auth::user()->id == $post->author_id) --}}
                <input type="submit" value="Создать категорию" class="btn btn-outline-success">
            {{-- @endif --}}

        @endauth
    </form>

@endsection