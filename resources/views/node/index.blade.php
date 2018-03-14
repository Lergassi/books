@extends("layouts.main")
@php
/** @var \App\node[] $nodes */
/** @var array $attributes */
@endphp
@section("content")
    <div class="block-simple">
        <div>filter</div>
        <table class="table">
            <thead>
                @foreach($columns as $column)
                    <th>{{\App\Helper::trans("node.attributes." . $column)}}</th>
                @endforeach
            </thead>
            @foreach($nodes as $node)
                <tr>
                    <td><a href="{{route("node.show", ["node" => $node->id])}}">{{$node->id}}</a></td>
                    <td>{{$node->title}}</td>
                    <td>{{$node->created_at}}</td>
                    <td>{{$node->text}}</td>
                    <td><a href="{{route("book.show", ["book" => $node->book_id])}}">{{$node->book_id}}</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination-wrapper">
        {{$nodes->links()}}
    </div>
@endsection