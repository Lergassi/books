@extends('node._form')

@section("target", "/node/" . $node->id)
@section("method", "put")

@section("buttons")
    <a href="{{route("node.show", ["node" => $node->id])}}" class="btn">Назад</a>
    <input type="submit" name="update" value="Сохранить" class="btn btn_primary">
@endsection

@section("add-fields")
    {{ method_field("PUT") }}
@endsection
