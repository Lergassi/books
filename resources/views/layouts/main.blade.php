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
    <title>@if(isset($title)){{$title}} - @endif{{$titleSite}}</title>
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300,400,600&amp;subset=cyrillic" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="title-site">
            <a href="/">Заголовок сайта</a>
        </div>

        @include("layouts.menu", ["items" => $menu])

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
</body>
</html>