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

                @include("node._fields")

                <div class="block-simple__line"></div>

                <div class="input-group">
                    <label for="" class="label">Предыдущий ответ</label>
                    {!! \App\Html::select("node[prev_item_id]", \App\NodeItem::createItems($nodeItemsCollection, "text"), $nodeItem->id, ["class" => "select", "disabled" => true]) !!}
                    {!! \App\Html::hidden("node[prev_item_id]", $nodeItem->id) !!}
                </div>

            </div>
            <div class="block-simple">
                @yield("buttons")
            </div>
        </form>
    </div>
@endsection