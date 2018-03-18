@extends('layouts.main')
@php
/** @var \App\NodeItem $nodeItem */
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
                @if(\App\Helper::hasOldAttribute($nodeItem, "id") != null)
                    <input type="hidden" name="nodeItem[id]" value="{{\App\Helper::hasOldAttribute($nodeItem, "id")}}">
                @endif
                <div class="input-group">
                    <label for="" class="label">Текст</label>
                    {!! \App\Html::input("nodeItem[text]", \App\Helper::hasOldAttribute($nodeItem, "nodeItem.text"), ["class" => "input"]) !!}
                </div>
                <div class="input-group">
                    <label for="" class="label">Узел</label>
                    {!! \App\Html::select("nodeItem[node_id]", \App\Node::createItems(\App\Node::where("book_id", \App\Node::find($nodeItem->node_id)->book->id)->get(), "text"), $nodeItem->node_id, ["class" => "select"]) !!}
                </div>

                <div class="block-simple__line"></div>

            </div>
            <div class="block-simple">
                @yield("buttons")
            </div>
        </form>
    </div>
@endsection