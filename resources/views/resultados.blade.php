@extends('layouts.App',['pageSlug' => 'news.index'])

@section('content')
<div class="col-md6">
    <a href="{{route('news.create')}}">
        <button class="btn btn-primary">Adicionar notícia</button>
    </a>
</div>
<table class="table table-striped">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Conteúdo</th>
                <th>Autor</th>
                <th>Editar</th>
                <th>Visualizar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($resultados as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->content}}</td>
                    <td>{{$item->user->name}}</td>
                    <td><a href="{{route('news.edit', $item->id)}}">Editar</a></td>
                    <td><a href="{{route('news.show', $item->id)}}">Visualizar</a></td>
                    <form action="{{route('news.destroy',$item->id)}}" method="post">
                        @csrf
                        @method('delete')
                    <td><button>Deletar</button></td>
                    </form>
                </tr>
            @empty
                <tr>
                    <td colspan="40">Não foram encontradas informações</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @endsection
    