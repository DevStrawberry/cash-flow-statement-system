<?php

namespace App\Services;

use App\Classes\Contabilidade\MovimentoCaixaBase;
use App\Classes\Contabilidade\Operacional;
use App\Models\MovimentoCaixa;

class MovimentoCaixaService
{
    public function registrar(MovimentoCaixaBase $movimento)
    {
        $atividade = $movimento->getAtividade();

        MovimentoCaixa::create([
            'valor' => $movimento->getValor(),
            'descricao' => $movimento->getDescricao(),
            'tipo_atividade' => $atividade,
        ]);

        return true;
    }
}
