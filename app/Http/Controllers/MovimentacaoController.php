<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovimentacaoRequest;
use Illuminate\Http\Request;
use App\Models\ModelCategoria;
use App\Models\ModelMovimentacao;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MovimentacaoController extends Controller
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
        $movimentacao = $this->objMovimentacao->where('id_user', '=', $user->id)->paginate(2);

        return view('movimentacao.index', compact('movimentacao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = $this->objCategoria->all();
        return view('movimentacao.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovimentacaoRequest $request)
    {
        $user = Auth::user();

        $cad = $this->objMovimentacao->create([
            'id_user'=>$user->id,
            'id_categoria'=>$request->id_categoria,
            'valor'=>$request->valor,
            'detalhe'=>$request->detalhe
        ]);

        if ($cad) {
            return redirect('movimentacao');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $movimentacao = DB::table('movimentacao')
            ->join('categoria','movimentacao.id_categoria','=','categoria.id')
            ->where('movimentacao.id', $id)
            ->where('movimentacao.id_user', $user->id)
            ->select('movimentacao.*', 'categoria.tipo', 'categoria.descricao')
            ->get();

        $result = ['result'=>count($movimentacao),'dados'=>$movimentacao[0]];
        return view('movimentacao.show', ['movimentacao'=>$result]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
