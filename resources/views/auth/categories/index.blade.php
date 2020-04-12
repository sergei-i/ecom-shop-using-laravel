@extends('auth.layouts.master')

@section('title', 'Категории')
@section('content')
    <div class="col-md-12">
        <h1>Категории</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            <tr>
                @foreach($categories as $category)
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('categories.destroy', $category) }}" method="post">
                                @csrf
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-success"
                                   type="button">
                                    Открыть
                                </a>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning"
                                   type="button">
                                    Редактировать
                                </a>
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="Удалить">
                            </form>
                        </div>
                    </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
        <a href="{{ url()->previous() }}" class="btn btn-default" type="button">Назад</a>
        <a href="{{ route('categories.create') }}" class="btn btn-success">Добавить категорию</a>
    </div>
@endsection
