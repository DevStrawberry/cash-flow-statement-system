<?php

namespace App\Classes\Contabilidade;

use App\Classes\Contabilidade\MovimentoCaixaBase;

class Investimento extends MovimentoCaixaBase
{

    public function getAtividade()
    {
        return 'Investimento';
    }
}
