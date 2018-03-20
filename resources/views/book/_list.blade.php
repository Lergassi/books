@php
/** @var \App\Book $books[] */
@endphp

<div class="block-simple clearfix-mod">
    <div class="block-simple__title block-simple__title_center">
        Книги
    </div>
    @foreach($books as $book)
        <div class="col-3">
            <div class="book-card">
                <div class="book-card__title">
                    {{$book->title}}
                </div>
                <div class="book-card__description">
                    {{$book->description}}
                </div>
                <div class="book-card__read">
                    <a href="{{route("read", ["read" => $book->id])}}">Читать{{\App\Read::hasObject($book) ? " (Продолжить)" : ""}}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>