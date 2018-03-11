@extends('layouts.main')
@php
/** @var \App\Node $node */
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
                @if(\App\Helper::hasOldAttribute($node, "node.title") != null)
                    <input type="hidden" name="node[id]" value="{{\App\Helper::hasOldAttribute($node, "id")}}">
                @endif
                <div class="input-group">
                    <label for="" class="label">Заголовок</label>
                    {!! \App\Html::input("node[title]", \App\Helper::hasOldAttribute($node, "node.title"), ["class" => "input"]) !!}
                </div>
                <div class="input-group">
                    <label for="" class="label">Текст</label>
                    {!! \App\Html::input("node[text]", \App\Helper::hasOldAttribute($node, "node.text"), ["class" => "input"]) !!}
                </div>
                <div class="input-group">
                    <label for="" class="label">Книга</label>
                    {!! App\Html::select("node[book_id]", \App\Book::getItems("title"), $node->book_id, ["class" => "select"]) !!}
                </div>

                <div class="block-simple__line"></div>

            </div>
            <div class="block-simple">
                @yield("buttons")
            </div>
        </form>
    </div>
@endsection