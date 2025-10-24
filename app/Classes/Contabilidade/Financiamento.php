<?php

namespace App\Classes\Contabilidade;

use App\Classes\Contabilidade\MovimentoCaixaBase;

class Financiamento extends MovimentoCaixaBase
{

    public function getAtividade()
    {
        return 'Financiamento';
    }
}
