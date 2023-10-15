@extends('layouts.App', ['pageSlug' => 'users'])
@section('content')
{!!Form::open()->put()->route('users.update',[$item->id])->fill($item) !!}
@include('users\form')
{!!Form::close()!!}
    @endsection
    