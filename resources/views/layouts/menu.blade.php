{{--@extends('layouts.main')--}}

@section("menu")
    <ul class="top-menu">
        @foreach($items as $item)
            <li class="{{$item["class"]}}"><a href="{{$item["url"]}}">{{$item["label"]}}</a></li>
        @endforeach
    </ul>
@show