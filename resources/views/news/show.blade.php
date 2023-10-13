@extends('layouts.App', ['pageSlug' => 'news.index'])
@section('content')
    <p>{{$item->title}}</p>
    <p>{{$item->author}}</p>
    <p>{{$item->content}}</p>
    @endsection
    