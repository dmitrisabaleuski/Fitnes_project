@extends('layouts.adminPanel')

@section('admincontent')
    <header id="admin-header">
        <div class="admin-page-back-to-main"><a href="/adminPanel">В Панель Администратора</a></div>
        <div class="admin-page-title"><h1>{{$pageName}}</h1></div>
        <div class="admin-page-user">Привет <a href="{{route('userProfile',['id'=>Auth::user()->id])}}">{{ Auth::user()->name }}</a></div>
    </header>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="profile-content">
        <div class="user-profile-avatar">
            <p>Аватар</p>
            <img src="{{$profile_image}}" alt="avatar">
        </div>
        <div class="user-profile-content">
            <ul>
                <li>
                    <p>Имя: </p>
                    <span>{{ $user_info['name'] }}</span>
                </li>
                <li>
                    <p>Фамилия: </p>
                    <span>{{ $user_info['second_name'] }}</span>
                </li>
                <li>
                    <p>Ваша Роль: </p>
                    <span>{{$role}}</span>
                </li>
                <li>
                    <p>Контакты </p>
                    <span>
                        <ul>
                        <li>
                            <p>Email: </p>
                            <span>{{ $user_info['email'] }}</span>
                        </li>
                        <li>
                            <p>Телефон: </p>
                            <span>{{$tel}}</span>
                        </li>
                        <li>
                            <p>Адресс: </p>
                            <span>{{$address}}</span>
                        </li>
                    </ul>
                    </span>
                </li>
                <li>
                    <p>Доступ к видео: </p>
                    <span>{{$series_access}}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="profile-edit"><a href="{{route('userProfileEdit',['id'=>$user_info['id']])}}">Редактировать</a></div>
@endsection
