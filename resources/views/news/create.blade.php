@extends('layouts.App' ,['pageSlug' => 'news.index'])
@section('content')
{!!Form::open()->post()->route('news.store') !!}
@include('news\form')
{!!Form::close()!!}
@endsection