@extends('layouts.layout', ['title' => 'Категории'])

@section('content')

    <div class="container">
        <h1 class="row">Категории</h1>

        <div class="row">
            @if (count($categories) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col" colspan="2">Действия</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->title }}</td>
                                <td>
                                    @auth
                                        {{-- @if (Auth::user()->id == $category->author_id) --}}
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn"><i
                                                class="fa-solid fa-pencil-alt"></i></a>
                                    @endauth
                                </td>

                                <td>
                                    @auth
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                            onsubmit="if (confirm('Точно удалить категорию {{ $category->id }}?')) { return true} else {return false}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="border-0 bg-transparent">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                        {{-- @endif --}}

                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Категорий пока нет</p>
            @endif

        </div>

        <div class="row">
            <a href="{{ route('category.create') }}" class="btn btn-primary">
                Создать новую категорию
            </a>
        </div>
    </div>

@endsection
