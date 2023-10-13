@extends('layouts.App', ['pageSlug' => 'news.index'])
@section('content')
{!!Form::open()->put()->route('news.update',[$item->id])->fill($item) !!}
@include('news\form')
{!!Form::close()!!}
    @endsection
    