@extends('layouts.layout_create', ['title' => "Создать новый пост"])

@section('content')
    <form action="{{ route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <h3>Создать пост</h3>
        @include('posts.parts.form')

        <input type="submit" value="Создать пост" class="btn btn-primary">
    </form>

@endsection