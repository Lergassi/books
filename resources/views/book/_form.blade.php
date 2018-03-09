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
                    <label for="">Название</label>
                    <input type="text" name="book[title]" value="{{\App\Helper::hasOldAttribute($book, "book.title")}}">
                </div>
                <div class="input-group">
                    <label for="">Описание</label>
                    <input type="text" name="book[description]" value="{{\App\Helper::hasOldAttribute($book, "book.description")}}">
                </div>
            </div>
            <div class="block-simple">
                @yield("buttons")
            </div>
        </form>
    </div>
@endsection