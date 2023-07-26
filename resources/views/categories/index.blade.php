@extends('layouts.layout', ['title' => 'Категории'])

@section('content')

<div class="container">
    <h1 class="row">Категории</h1>

    <div class="row">
        @if(count($categories) > 0)

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Действие</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->title }}</td>
                        <td>
                            @auth
                                {{-- @if(Auth::user()->id == $category->author_id) --}}
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-outline-success">Редактировать</a>
                                
                                <form
                                    action="{{ route('category.destroy', $category->id) }}"
                                    method="POST"
                                    onsubmit="if (confirm('Точно удалить категорию {{ $category->id }}?')) { return true} else {return false}"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <input type="submit" class="btn btn-outline-danger" value="Удалить">
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
        <a href="{{ route('category.create')}}" class="btn btn-outline-primary">Создать новую категорию</a>
    </div>
</div>

@endsection