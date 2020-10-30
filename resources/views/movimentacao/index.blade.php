@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    <div class="text-center">
                        Histórico de Movimentação

                        <a href="{{url("movimentacao/create")}}">
                            <button class="btn btn-sm btn-success">Cadastrar</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Id Mov.</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($movimentacao as $item)
                                @php
                                    $categoria = $item->find($item->id)->relCategorias;
                                @endphp
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$categoria->tipo}}</td>
                                    <td>{{$categoria->descricao}}</td>
                                    <td>{{$item->valor}}</td>
                                    <td>
                                        <a href="{{url("movimentacao/$item->id")}}">
                                            <button class="btn btn-dark">Visualizar</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$movimentacao->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
