@extends('layouts.main')
@php
/** @var \App\Book $book */
@endphp
@section('content')
    <div class="block-simple">
        <form action="{{route("book.destroy", ["book" => $book->id])}}" method="post" class="form">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <a href="{{route("book.edit", ["book" => $book->id])}}" class="btn btn_primary">Редактировать</a>
            <input type="submit" name="delete" value="Удалить" class="btn btn_danger">
            <a href="{{route("node.create", ["book_id" => $book->id])}}" class="btn">Создать узел</a>
        </form>
    </div>
    <table class="table">
        @foreach($book->getAttributes() as $attribute => $value)
            <tr>
                <td>{{\App\Helper::trans("book.attributes." . $attribute)}}</td>
                <td>{{$value}}</td>
            </tr>
        @endforeach
    </table>
@endsection