@extends('layouts.adminPanel')

@section('admincontent')
    <header id="admin-header">
        <div class="admin-page-back-to-main"><a href="/">На Главную</a></div>
        <div class="admin-page-title"><h1>{{$pageName}}</h1></div>
        <div class="admin-page-user">Привет <a
                href="{{route('userProfile',['id'=>Auth::user()->id])}}">{{ Auth::user()->name }}</a></div>
    </header>
    <div class="content">
        <nav>
            <ul>
                <li>
                    <a href="/adminPanel/allUsers">Пользователи</a>
                </li>
                <li>
                    <a href="#">Контент</a>
                </li>
                <li>
                    <a href="#">Настройка сайта</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
