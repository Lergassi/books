@extends("layouts.main")
@php
/** @var \App\nodeItem[] $nodes */
/** @var array $attributes */
@endphp
@section("content")
    <div class="block-simple">
        <table class="table">
            <thead>
                @foreach($columns as $column)
                    <th>{{\App\Helper::trans("nodeItem.attributes." . $column)}}</th>
                @endforeach
            </thead>
            @foreach($nodeItems as $nodeItem)
                <tr>
                    <td><a href="{{route("nodeItem.show", ["nodeItem" => $nodeItem->id])}}">{{$nodeItem->id}}</a></td>
                    <td>{{$nodeItem->text}}</td>
                    <td>{{$nodeItem->created_at}}</td>
                    <td><a href="{{route("node.show", ["node" => $nodeItem->node_id])}}">{{$nodeItem->node_id}}</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination-wrapper">
        {{$nodeItems->links()}}
    </div>
@endsection