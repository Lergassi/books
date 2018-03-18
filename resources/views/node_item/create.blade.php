@extends('node_item._form')
@php
    /** @var \App\NodeItem $nodeItem */
@endphp

@section("target", route("node_item.store"))

@section("buttons")
    <a href="{{route("node_item.index")}}" class="btn">Назад</a>
    <input type="submit" name="create" value="Создать" class="btn btn_success">
@endsection