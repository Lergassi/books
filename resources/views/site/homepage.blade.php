@extends('layouts.main')

@section('content')
    @include("book._list", ["books" => $books])
@endsection