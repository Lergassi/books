@extends('layouts.main')
@php
/** @var \App\Node $node */
@endphp
@section('content')
    <div class="block-simple">
        <form action="{{route("node.destroy", ["node" => $node->id])}}" method="post" class="form">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <a href="{{route("node.edit", ["node" => $node->id])}}" class="btn btn_primary">Редактировать</a>
            <input type="submit" name="delete" value="Удалить" class="btn btn_danger">
            <a href="{{route("node.create", ["prev_node_id" => $node->id])}}" class="btn">Создать следующий узел</a>
        </form>
    </div>
    <table class="table">
        @foreach($node->getAttributes() as $attribute => $value)
            <tr>
                <td>{{\App\Helper::trans("node.attributes." . $attribute)}}</td>
                <td>{{$value}}</td>
            </tr>
        @endforeach
    </table>
@endsection