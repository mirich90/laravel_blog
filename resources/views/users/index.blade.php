@extends('layouts.layout', ['title' => 'Пользователи'])

@section('content')
    <div class="container">
        <h1 class="row">Категории</h1>

        <div class="row">
            @if (count($users) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Логин</th>
                            <th scope="col">Эл.почта</th>
                            <th scope="col">Роль</th>
                            {{-- <th scope="col">Пароль</th> --}}
                            <th scope="col" colspan="2">Действия</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                {{-- <td>{{ $user->password }}</td> --}}
                                <td>
                                    @auth
                                        @if (Auth::user()->id == $user->id)
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn">
                                                <i class="fa-solid fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                    @endauth
                                </td>

                                <td>
                                    @auth

                                        @if (Auth::user()->id == $user->id)
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                onsubmit="if (confirm('Точно удалить пользователя {{ $user->id }}?')) { return true} else {return false}">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="border-0 bg-transparent">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        @endif

                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Пользователей пока нет</p>
            @endif

        </div>

        <div class="row">
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                Добавить нового пользователя
            </a>
        </div>
    </div>
@endsection
