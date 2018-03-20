@php
/** @var array $menu */
/** @var string $titleSite */
@endphp
<!doctype html>
<html lang="`">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titleSite}} - @yield("subTitle")</title>
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300,400,600&amp;subset=cyrillic" rel="stylesheet">
</head>
<body>

    <div class="wrapper">
        <div class="content">
            <div class="title-site">
                <a href="/">{{$titleSite}}</a>
            </div>
            @if(Auth::user() && Auth::user()->name == "admin")
                @include("layouts.menu", ["items" => $menu])
            @endif

            @yield("content")
        </div>

        <div class="footer">
            <div class="footer__link">
                <a href="#">ВКонтакте</a>
                <a href="#">О сайте</a>
            </div>
            <div class="footer__title">
                &copy; 2018
            </div>
        </div>
    </div>
</body>
</html>