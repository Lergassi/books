@extends("layouts.main")
@php
/** @var \App\Book[] $books */
/** @var array $attributes */
@endphp
@section("content")
    <div class="block-simple">
        <table class="table">
            <thead>
                @foreach($columns as $column)
                    <th>{{\App\Helper::trans("book.attributes." . $column)}}</th>
                @endforeach
            </thead>
            @foreach($books as $book)
                <tr>
                    <td>{{$book->id}}</td>
                    <td><a href="{{route("book.show", ["book" => $book->id])}}">{{$book->title}}</a></td>
                    <td>{{$book->created_at}}</td>
                    <td>{{$book->updated_at}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination-wrapper">
        {{$books->links()}}
    </div>
@endsection