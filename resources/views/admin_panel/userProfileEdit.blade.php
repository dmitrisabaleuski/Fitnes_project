@extends('layouts.adminPanel')

@section('admincontent')
    <header id="admin-header">
        <div class="admin-page-back-to-main"><a href="/adminPanel">В Панель Администратора</a></div>
        <div class="admin-page-title"><h1>{{$pageName}}</h1></div>
        <div class="admin-page-user"><a href="{{route('userProfile',['id'=>$user_info['id']])}}">Вернуться к просмотру
                профиля{{ Auth::user()->name }}</a></div>
    </header>

    <div class="edit-profile-content">
        <div class="user-profile-content">
            <form id="userProfileEdit" method="POST" action="{{ route('userProfileUpdate',['id'=>$user_info['id']]) }}"
                  enctype="multipart/form-data">
                <div class="user-profile-avatar">
                    <p>Аватар</p>
                    <img src="{{$profile_image}}" alt="avatar">
                    <?php
                    echo Form::file('profile_image');
                    ?>
                    <div class="default_avatar">
                        <input id="delete_avatar" type="checkbox" name="delete_avatar">
                        <label for="delete_avatar">Вернуть стандартный аватар</label>
                    </div>
                </div>
                <ul>
                    <li>
                        <p>Имя: </p>
                        <input type="text" required placeholder="Введите ваше Имя" name="name"
                               value="{{ $user_info['name'] }}">
                    </li>
                    <li>
                        <p>Фамилия: </p>
                        <input type="text" required placeholder="Введите вашу Фамилию" name="second_name"
                               value="{{ $user_info['second_name'] }}">
                    </li>
                    <li>
                        <p>Ваша Роль: </p>
                        <select name="rule">
                            @foreach($roles as $role)
                                @if($role->id == $user_taxonomy)
                                    <option selected value="{{$role->id}}">{{$role->type}}</option>
                                @else
                                    <option value="{{$role->id}}">{{$role->type}}</option>
                                @endif
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <p>Контакты </p>
                        <ul>
                            <li>
                                <p>Email: </p>
                                <input type="text" required placeholder="Введите ваш Email" name="email"
                                       value="{{ $user_info['email'] }}">
                            </li>
                            <li>
                                <p>Телефон: </p>
                                <input type="text" placeholder="Введите ваш Телефон" name="tel"
                                       value="{{ $tel ?? '' }}">
                            </li>
                            <li>
                                <p>Адресс: </p>
                                <input type="text" placeholder="Введите ваш Город" name="city"
                                       value="{{$address['city'] ?? ''}}">
                                <input type="text" placeholder="Введите вашу Улицу" name="street"
                                       value="{{$address['street'] ?? ''}}">
                                <input type="text" placeholder="Введите номер вашего дома" name="build"
                                       value="{{$address['build'] ?? ''}}">
                                <input type="text" placeholder="Введите номер вашей квартиры" name="apartment"
                                       value="{{$address['apartment'] ?? ''}}">
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p>Доступ к видео: </p>
                        <span>{{$series_access ?? ''}}</span>
                    </li>
                    <button type="submit" class="btn btn-default">Сохранить</button>
                    {{csrf_field()}}
                </ul>
            </form>
        </div>
    </div>
@endsection
