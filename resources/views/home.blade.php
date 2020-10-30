@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <p class="lead">
                            <h1>Saldo do dia {{today()->format('d/m/Y')}}: R$ {{$saldoTotal}}</h1>
                        </p>
                    <!-- Transações do Dia -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">

                                        <!-- Title -->
                                        <h4 class="card-header-title">
                                            Transações do Dia
                                        </h4>

                                    </div>
                                </div> <!-- / .row -->
                            </div>
                            <div class="table-responsive mb-0" >
                                <table class="table table-sm table-nowrap card-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Id Mov.</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Detalhe</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($movimentacao as $item)
                                        @php
                                            $categoria = $item->find($item->id)->relCategorias;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{$item->id}}</th>
                                            <td>
                                                @if($categoria->tipo == 'entrada')
                                                    <span class="badge badge-primary">entrada</span>
                                                @else
                                                    <span class="badge badge-danger">saída</span>
                                                @endif
                                            </td>
                                            <td>{{$categoria->descricao}}</td>
                                            <td>{{$item->valor}}</td>
                                            <td>{{$item->detalhe}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
