@extends('book._form')

@section("target", "/book/" . $book->id)
@section("method", "put")

@section("buttons")
    <a href="{{route("book.show", ["book" => $book->id])}}" class="btn">Назад</a>
    <input type="submit" name="update" value="Сохранить" class="btn btn_primary">
@endsection

@section("add-fields")
    {{ method_field("PUT") }}
@endsection
