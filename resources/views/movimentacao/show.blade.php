@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @if($movimentacao['result'] == 0)
                    <div class="card-header danger">Atenção</div>
                    <div class="alert alert-danger" role="alert">
                        Movimentação não encontrada
                    </div>
                @else
                    <div class="card-header">Detalhe da Movimentação: #{{$movimentacao['dados']->id}}
                    {{$movimentacao['dados']->created_at}}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="card" style="width: 100%">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Tipo: {{$movimentacao['dados']->tipo}}</li>
                                    <li class="list-group-item">Categoria: {{$movimentacao['dados']->descricao}}</li>
                                    <li class="list-group-item">Detalhe da movimentação: {{$movimentacao['dados']->detalhe}}</li>
                                    <li class="list-group-item">Valor: R$ {{$movimentacao['dados']->valor}}</li>
                                </ul>
                            </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
