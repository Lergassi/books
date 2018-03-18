@extends('layouts.main')

@php
/** @var \App\Read $read */
@endphp

@section('content')
    <div class="node-read">
        <div class="node-read__title">
            {{$read->currentNode()->title}}
        </div>
        <div class="node-read__text">
            {{$read->currentNode()->text}}
        </div>
        <div class="node-read__items">
            @foreach($read->currentNode()->items as $item)
                <div class="node-read__item">
                    <a href="{{route("read.choice", ["book_id" => $read->getBook()->id, "nodeItem_id" => $item->id])}}">{{$item->text}}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection