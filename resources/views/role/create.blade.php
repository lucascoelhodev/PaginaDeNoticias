@extends('layouts.App' ,['pageSlug' => 'users'])
@section('content')
{!!Form::open()->post()->route('role.store')!!}
@include('role\form')
{!!Form::close()!!}
@endsection