@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Novo Cadastro
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(isset($errors) && count($errors)>0)
                        <div class="text-center mt-4 mb-4 p-2 alert-danger">
                            @foreach ($errors->all() as $erro)
                                {{$erro}}<br>
                            @endforeach
                        </div>
                    @endif

                    <form name="formCad" id="formCad" method="post" action="{{url('movimentacao')}}">
                        @csrf
                        <input type="text" name="detalhe" id="detalhe"  class="form-control" placeholder="Detalhe da movimentação" required><br>

                        <select name="id_categoria" id="id_categoria" class="form-control" required>
                            <option value="">Selecione uma categoria</option>
                            @foreach ($categorias as $cat)
                                <option value="{{$cat->id}}">{{$cat->tipo}} - {{$cat->descricao}}</option>
                            @endforeach
                        </select><br>

                        <input type="text" name="valor" id="valor" placeholder="Digite o valor da transação" class="form-control" required><br>
                        <input type="submit" value="Cadastrar Movimentação" class="btn btn-primary">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
