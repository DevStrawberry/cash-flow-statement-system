<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentoCaixa
{
    use HasFactory;

    protected $fillable = [
        'valor',
        'descricao',
        'data_transacao',
        'tipo_atividade', // 'Operacional', 'Investimento', 'Financiamento'
    ];
}
