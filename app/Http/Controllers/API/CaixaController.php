<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ModelCategoria;
use App\Models\ModelMovimentacao;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class CaixaController extends Controller
{
    private $objUser;
    private $objCategoria;
    private $objMovimentacao;

    public function __construct()
    {
        $this->objUser          = new User();
        $this->objCategoria     = new ModelCategoria();
        $this->objMovimentacao  = new ModelMovimentacao();
    }

    public function index()
    {

        $user = Auth::user();
        $movimentacao = $this->objMovimentacao->all();
        $data = $movimentacao->toArray();

        $response = [
            'success' => true,
            'user' => $user->id,
            'data' => $data,
            'message' => 'Books retrieved successfully.'
        ];



        # SALDO DO DIA
        $queryEnt = DB::table('movimentacao')
            ->join('categoria','movimentacao.id_categoria','=','categoria.id')
            ->where('movimentacao.id_user', $user->id)
            ->where('categoria.tipo','LIKE','entrada')
            ->whereRaw('Date(movimentacao.created_at) = CURDATE()')
            ->select(DB::raw('SUM(movimentacao.valor) as entradas'))
            ->get();

        $querySai = DB::table('movimentacao')
            ->join('categoria','movimentacao.id_categoria','=','categoria.id')
            ->where('movimentacao.id_user', $user->id)
            ->where('categoria.tipo','LIKE','saida')
            ->whereRaw('Date(movimentacao.created_at) = CURDATE()')
            ->select(DB::raw('SUM(movimentacao.valor) as saidas'))
            ->get();

        if (is_null($queryEnt[0]->entradas) == 1)
            $saldoEntradas  = 0;
        else
            $saldoEntradas  = $queryEnt[0]->entradas;

        if (is_null($querySai[0]->saidas) == 1)
            $saldoSaidas  = 0;
        else
            $saldoSaidas  = $querySai[0]->saidas;

        $resultadoSaldo = $saldoEntradas - $saldoSaidas;

        # MOVIMENTACOES DO DIA
        $movimentacao = $this->objMovimentacao
            ->select('created_at as data', 'id', 'valor', 'detalhe as descricao')
            ->where('id_user', '=', $user->id)
            ->whereRaw('Date(created_at) = CURDATE()')->get();

        $movimentacao = DB::table('movimentacao')
            ->join('categoria','movimentacao.id_categoria','=','categoria.id')
            ->where('movimentacao.id_user', $user->id)
            ->whereRaw('Date(movimentacao.created_at) = CURDATE()')
            ->select('movimentacao.created_at as data', 'movimentacao.id', 'movimentacao.valor', 'movimentacao.detalhe as descricao', 'categoria.id as id_categoria', 'categoria.descricao as desc_categoria', 'categoria.tipo')
            ->get();

        foreach ($movimentacao as $item) {
            $categoria  = ['id'=>$item->id_categoria, 'name'=>$item->desc_categoria];
            $json[] = ['data'=>$item->data, 'id'=>$item->id, 'categoria'=>$categoria, 'tipo'=>$item->tipo, 'valor'=>$item->valor, 'descricao'=>$item->descricao];
        }

        $resultado  = ['saldoTotal'=>$resultadoSaldo, 'movimentacoes'=>$json];
        $data       = $resultado;
        $response = [
            'success' => true,
            'data' => $data
        ];



        return response()->json($response, 200);
    }
}
