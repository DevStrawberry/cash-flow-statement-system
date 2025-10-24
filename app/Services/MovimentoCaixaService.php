<?php

namespace App\Services;

use App\Models\MovimentoCaixa;
use App\Classes\Contabilidade\MovimentoCaixaBase;

class MovimentoCaixaService
{
    public function registrar(MovimentoCaixaBase $movimentoPuro, string $data): MovimentoCaixa
    {
        $tipoAtividade = $movimentoPuro->getAtividade();

        $registro = MovimentoCaixa::create([
            'valor'          => $movimentoPuro->getValor(),
            'descricao'      => $movimentoPuro->getDescricao(),
            'data_transacao' => $data,
            'tipo_atividade' => $tipoAtividade,
        ]);

        return $registro;
    }
}
