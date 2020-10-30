<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelCategoria;
use App\Models\ModelMovimentacao;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $objUser;
    private $objCategoria;
    private $objMovimentacao;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->objUser          = new User();
        $this->objCategoria     = new ModelCategoria();
        $this->objMovimentacao  = new ModelMovimentacao();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

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

        $resultadoSaldo = number_format($saldoEntradas - $saldoSaidas, 2, ',', '.');

        # MOVIMENTACOES DO DIA
        $movimentacao = $this->objMovimentacao
            ->where('id_user', '=', $user->id)
            ->whereRaw('Date(created_at) = CURDATE()')->get();


//        $movimentacao = DB::table('movimentacao')
//            ->join('categoria','movimentacao.id_categoria','=','categoria.id')
//            ->where('movimentacao.id_user', $user->id)
//            ->select('movimentacao.*', 'categoria.tipo', 'categoria.descricao')
//            ->get();

        $resultado = ['saldoTotal'=>$resultadoSaldo, 'movimentacoes'=>$movimentacao];

        return view('home')
            ->with('movimentacao', $movimentacao)
            ->with('saldoTotal', $resultadoSaldo);

    }
}
