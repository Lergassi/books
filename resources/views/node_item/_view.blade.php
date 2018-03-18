@php
    /** @var \App\NodeItem $nodeItem */
/*__d($nodeItem);*/
@endphp
@section('view-' . $nodeItem->id)
    <div class="block-simple">
        <div class="block-simple">
            <form action="{{route("node_item.destroy", ["nodeitem" => $nodeItem->id])}}" method="post" class="form">
                {{csrf_field()}}
                {{method_field("DELETE")}}
                <a href="{{route("node_item.edit", ["nodeItem" => $nodeItem->id])}}" class="btn btn_primary">Редактировать</a>
                <input type="submit" name="delete" value="Удалить" class="btn btn_danger">
                <a href="{{route("node.show", ["node" => $nodeItem->node_id])}}" class="btn">Узел</a>
                @if($nodeItem->next_node_id)
                    <a href="{{route("node.show", ["node" => $nodeItem->next_node_id])}}" class="btn">Следующий узел</a>
                @else
                    <a href="{{route("node.create", ["nodeItem_id" => $nodeItem->id])}}" class="btn">Создать следующий узел</a>
                @endif

            </form>
        </div>
        <table class="table">
            @foreach($nodeItem->getAttributes() as $attribute => $value)
                <tr>
                    <td>{{\App\Helper::trans("node_item.attributes." . $attribute)}}</td>
                    <td>{{$value}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@show