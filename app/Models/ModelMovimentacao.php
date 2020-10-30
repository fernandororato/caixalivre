<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMovimentacao extends Model
{
    protected $table = 'movimentacao';
    protected $fillable = ['id_categoria', 'id_user', 'valor', 'detalhe'];

    public function relUsers()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    public function relCategorias()
    {
        return $this->hasOne('App\Models\ModelCategoria', 'id', 'id_categoria');
    }
}
