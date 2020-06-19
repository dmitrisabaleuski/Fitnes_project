<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fitnes</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>
<body>
<header id="header">
    <div class="top_block">
        <div class="logo">
            <img src="https://via.placeholder.com/150" alt="logo">
        </div>
        <div class="nav">
            <nav>
                <ul>
                    <li><a href="#">nav1</a></li>
                    <li><a href="#">nav2</a></li>
                    <li><a href="#">nav3</a></li>
                    <li><a href="#">nav4</a></li>
                    <li><a href="#">nav5</a></li>
                </ul>
            </nav>
        </div>
        <div class="tel">
            <a href="tel:+1234567890">+1234567890</a>
            <a href="/adminPanel">Admin Panel</a>
            @guest
                <li><a href="{{ route('login') }}">Логин</a></li>
                <li><a href="{{ route('register') }}">Регистрация</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                Выход
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
        </div>
    </div>
    {{--<h1>Title</h1>
    <p class="text">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum
        sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies
        nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel,
        aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
    </p>--}}
</header>
<div class="content">
    <div class="fitnes_type_block">
        <div class="block_online">
            <div class="main_img_block">
                <img src="https://via.placeholder.com/1200" alt="img">
            </div>
            <div class="turn_side_content">
                <h2>Мужчины</h2>
            </div>
        </div>
        <div class="block_offline">
            <div class="main_img_block">
                <img src="https://via.placeholder.com/1200" alt="img">
            </div>
            <div class="turn_side_content">
                <h2>Женщины</h2>
            </div>
        </div>
        <div class="block_offline">
            <div class="main_img_block">
                <img src="https://via.placeholder.com/1200" alt="img">
            </div>
            <div class="turn_side_content">
                <h2>Коты</h2>
            </div>
        </div>
    </div>
    {{--<div class="feedback_form">
        <form action="POST">
            <label for="name">Ваше имя:</label>
            <input type="text" id="name" value="">
            <label for="email">Ваш email:</label>
            <input type="text" id="email" value="">
            <label for="feedback_text">Ваш отзыв:</label>
            <input type="textarea" id="feedback_text" value="">
            <input type="submit" id="submit" value="Отправить отзыв">
        </form>
    </div>
    <div class="pricelist">
        <ul>
            <li>price1</li>
            <li>price2</li>
            <li>price3</li>
            <li>price4</li>
            <li>price5</li>
            <li>price6</li>
            <li>price7</li>
            <li>price8</li>
        </ul>
    </div>--}}
    <div class="contact_block">
{{--        <div class="map"></div>
        <div class="contacts"></div>--}}
    </div>
</div>
<footer>
    <nav>
        <ul>
            <li><a href="#">nav1</a></li>
            <li><a href="#">nav2</a></li>
            <li><a href="#">nav3</a></li>
            <li><a href="#">nav4</a></li>
            <li><a href="#">nav5</a></li>
        </ul>
    </nav>
</footer>
{{--<script type="text/javascript" src="{{ asset('js/window_height.js') }}"></script>--}}
</body>
</html>
