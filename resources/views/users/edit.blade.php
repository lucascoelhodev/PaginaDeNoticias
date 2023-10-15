@extends('layouts.App', ['pageSlug' => 'users'])
@section('content')
{!!Form::open()->put()->route('users.update',[$item->id])->fill($item) !!}
@include('users\form')
{!!Form::close()!!}
{!!Form::open()->post()->route('remove',['id' => $item->id]) !!}
<div>
<select name="role_id">
        @foreach ($userRoles as $role)
            <option value="{{ $role->id }}" {{ auth()->user()->roles->contains('id', $role->id) ? 'selected' : '' }}>
            {{ $role->name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-danger">Remover Papel</button>
</div>
{!!Form::close()!!}


    @endsection
    