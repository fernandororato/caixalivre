<?php

use Illuminate\Database\Seeder;
use App\Models\ModelCategoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ModelCategoria $categoria)
    {
        $categoria->create([
            'tipo'=>'saida',
            'descricao'=>'Salário'
        ]);

        $categoria->create([
            'tipo'=>'saida',
            'descricao'=>'Material Expediente'
        ]);

        $categoria->create([
            'tipo'=>'saida',
            'descricao'=>'Luz, Água e Telefone'
        ]);

        $categoria->create([
            'tipo'=>'saida',
            'descricao'=>'Aluguel'
        ]);

        $categoria->create([
            'tipo'=>'entrada',
            'descricao'=>'Venda de Produtos'
        ]);

        $categoria->create([
            'tipo'=>'entrada',
            'descricao'=>'Venda de Serviços'
        ]);
    }
}
