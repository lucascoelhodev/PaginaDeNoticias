@extends('layouts.App',['pageSlug' => 'users'])

@section('content')
<div class="col-md6">
    <a href="{{route('role.create')}}">
        <button class="btn btn-primary">Adicionar Papel</button>
    </a>
</div>
<table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="40">Não foram encontradas informações</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @endsection
    