@extends('node_item._form')

@section("target", "/node_item/" . $nodeItem->id)
@section("method", "put")

@section("buttons")
    <a href="{{route("node_item.show", ["nodeItem" => $nodeItem->id])}}" class="btn">Назад</a>
    <input type="submit" name="update" value="Сохранить" class="btn btn_primary">
@endsection

@section("add-fields")
    {{ method_field("PUT") }}
@endsection
