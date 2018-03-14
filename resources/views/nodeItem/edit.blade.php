@extends('nodeItem._form')

@section("target", "/nodeItem/" . $nodeItem->id)
@section("method", "put")

@section("buttons")
    <a href="{{route("nodeItem.show", ["nodeItem" => $nodeItem->id])}}" class="btn">Назад</a>
    <input type="submit" name="update" value="Сохранить" class="btn btn_primary">
@endsection

@section("add-fields")
    {{ method_field("PUT") }}
@endsection
