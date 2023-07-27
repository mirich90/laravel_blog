@extends('layouts.layout', ['title' => "Редактировать категорию '$category->title'"])

@section('content')
    <form action="{{ route('category.update', ['id'=>$category->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <h3>Редактировать категорию</h3>
        @include('categories.parts.form')

        <input type="submit" value="Редактировать категорию" class="btn btn-primary">
        <a href="{{ route('category.index') }}" class="btn btn-outline-danger">Отмена</a>
    </form>

@endsection