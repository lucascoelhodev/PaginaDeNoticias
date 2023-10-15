@extends('layouts.App', ['pageSlug' => 'news.index'])
@section('content')
    <h1>{{$item->title}}</h1>
    
    <p style="border: 2px solid #000; padding: 10px;">{{$item->content}}</p>
    <h6><i>Escrito por {{$item->user->name}}</i></h6>
    @endsection
    