@extends('layouts.main')
@php
/** @var \App\Book $book */
@endphp
@section('content')
    @if($errors->any())
        <div class="block">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <form action="@yield("target")" method="post">
            <div class="block-simple">
                {{ csrf_field() }}
                @section("add-fields")
                @show
                @if(\App\Helper::hasOldAttribute($book, "title") != null)
                    <input type="hidden" name="book[id]" value="{{\App\Helper::hasOldAttribute($book, "id")}}">
                @endif
                <div class="input-group">
                    <label for="" class="label">Название</label>
                    {!! \App\Html::input("book[title]", \App\Helper::hasOldAttribute($book, "book.title"), ["class" => "input"]) !!}
                </div>
                <div class="input-group">
                    <label for="" class="label">Описание</label>
                    {!! \App\Html::input("book[description]", \App\Helper::hasOldAttribute($book, "book.description"), ["class" => "input"]) !!}
                </div>
                <div class="input-group">
                    <label for="" class="label">Статус</label>
                    {!! \App\Html::select("book[status]", \App\Book::getStatusLabels() , \App\Helper::hasOldAttribute($book, "book.status"), ["class" => "select"]) !!}
                </div>
            </div>
            <div class="block-simple">
                @yield("buttons")
            </div>
        </form>
    </div>
@endsection