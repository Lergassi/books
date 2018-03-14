@extends('nodeItem._form')
@php
    /** @var \App\NodeItem $nodeItem */
@endphp

@section("target", route("nodeItem.store"))

@section("buttons")
    <a href="{{route("nodeItem.index")}}" class="btn">Назад</a>
    <input type="submit" name="create" value="Создать" class="btn btn_success">
@endsection