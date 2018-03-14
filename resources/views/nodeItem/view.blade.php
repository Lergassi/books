@extends('layouts.main')
@php
/** @var \App\NodeItem $nodeItem */
@endphp
@section('content')
    <div class="block-simple">
        <form action="{{route("nodeItem.destroy", ["nodeitem" => $nodeItem->id])}}" method="post" class="form">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <a href="{{route("nodeItem.edit", ["nodeItem" => $nodeItem->id])}}" class="btn btn_primary">Редактировать</a>
            <input type="submit" name="delete" value="Удалить" class="btn btn_danger">
            <a href="{{route("node.create", ["nodeItem_id" => $nodeItem->id])}}" class="btn">Создать следующий узел</a>
        </form>
    </div>
    <table class="table">
        @foreach($nodeItem->getAttributes() as $attribute => $value)
            <tr>
                <td>{{\App\Helper::trans("nodeItem.attributes." . $attribute)}}</td>
                <td>{{$value}}</td>
            </tr>
        @endforeach
    </table>
@endsection