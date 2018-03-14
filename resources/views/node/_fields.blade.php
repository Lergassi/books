@section("fields")
@if(\App\Helper::hasOldAttribute($node, "node.title") != null)
    <input type="hidden" name="node[id]" value="{{\App\Helper::hasOldAttribute($node, "id")}}">
@endif
<div class="input-group">
    <label for="" class="label">Заголовок</label>
    {!! \App\Html::input("node[title]", \App\Helper::hasOldAttribute($node, "node.title"), ["class" => "input"]) !!}
</div>
<div class="input-group">
    <label for="" class="label">Текст</label>
    {!! \App\Html::input("node[text]", \App\Helper::hasOldAttribute($node, "node.text"), ["class" => "input"]) !!}
</div>
<div class="input-group">
    <label for="" class="label">Книга</label>
    {!! App\Html::select("node[book_id]", \App\Book::getItems("title"), $node->book_id, ["class" => "select", "disabled" => true]) !!}
    {!! \App\Html::hidden("node[book_id]", $node->book_id) !!}
</div>
@show