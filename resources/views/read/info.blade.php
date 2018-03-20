@extends("layouts.main")

@section("subTitle", $read->getBook()->title)

@section("content")
    <div class="block-simple">
        <div class="block-simple">
                <a href="{{route("read", ["read" => $read->getBook()->id])}}" class="btn btn_primary">Читать</a>
                <a href="{{route("read.reset", ["read" => $read->getBook()->id])}}" class="btn btn_danger">Сбросить сохранение</a>
            </form>
        </div>
        <div class="block-simple__title">
            Статистика по книге «{{$read->getBook()->title}}»
        </div>
        <div class="block-simple__content">
            <table class="table">
                <tr>
                    <td>Статус книги</td>
                    <td><b>{{$read->getStatusLabels($read->getStatus())}}</b></td>
                </tr>
                <tr>
                    <td>Текущий узел</td>
                    <td><a href="{{route("node.show", ["node" => $read->currentNode()->id])}}">{{$read->currentNode()->text}} ({{$read->currentNode()->id}})</a></td>
                </tr>
                <tr>
                    <td>Пройдено узлов</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
@endsection