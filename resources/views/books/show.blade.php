@extends('layouts.book')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
        <p>
            {{$article->content}}
        </p>
        </div>
    </div>
@endsection
