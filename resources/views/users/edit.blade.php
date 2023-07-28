@extends('layouts.layout', ['title' => "Редактировать пользователя '$user->name'"])

@section('content')
    <form action="{{ route('user.update', ['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <h3>Редактировать данные пользователя</h3>
        @include('users.parts.form')

        <input type="submit" value="Редактировать категорию" class="btn btn-primary">
        <a href="{{ route('user.index') }}" class="btn btn-outline-danger">Отмена</a>
    </form>

@endsection