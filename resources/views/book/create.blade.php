@extends('book._form')
@php
    /** @var \App\Book $book */
@endphp

@section("target", route("book.store"))

@section("buttons")
    <a href="{{route("book.index")}}" class="btn">Назад</a>
    <input type="submit" name="create" value="Создать" class="btn btn_success">
@endsection