@extends('layouts.layout', ['title' => "Добавление пользователя"])

@section('content')
    <form action="{{ route('user.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <h3>Добавление пользователя</h3>
        @include('users.parts.form')

        @auth
            {{-- @if(Auth::user()->id == $post->author_id) --}}
                <input type="submit" value="Добавить пользователя" class="btn btn-primary">
            {{-- @endif --}}

        @endauth
    </form>

@endsection