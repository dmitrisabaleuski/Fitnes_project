@extends('layouts.adminPanel')

@section('admincontent')
    <header id="admin-header">
        <div class="admin-page-back-to-main"><a href="/adminPanel">В Панель Администратора</a></div>
        <div class="admin-page-title"><h1>{{$pageName}}</h1></div>
    </header>
    <div class="all-users-page-content">
        <ul>
            <li>
                <ul>
                    <li>ID пользователя</li>
                    <li>Имя</li>
                    <li>Фамилия</li>
                    <li>Email</li>
                    <li>Роль</li>
                    <li>Действие</li>
                    <li>Действие</li>
                </ul>
            </li>
            @foreach($users as $user)
                <li>
                    <ul>
                        <li>{{$user->id}}</li>
                        <li>{{$user->name}}</li>
                        <li>{{$user->second_name}}</li>
                        <li>{{$user->email}}</li>
                        <li>{{$user->type}}</li>
                        <li><a class="edit" href="{{route('userProfileEdit',['id'=>$user->id])}}">Редактровать</a></li>
                        <li><a class="delete" href="{{route('userProfileDelete',['id'=>$user->id])}}">Удалить</a></li>
                    </ul>
                </li>

            @endforeach
        </ul>
        <div class="users-pagination">
            {{ $users->links() }}
        </div>
    </div>
@endsection
