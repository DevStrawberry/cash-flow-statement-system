<?php

namespace App\Classes\Contabilidade;

use App\Classes\Contabilidade\MovimentoCaixaBase;

class Operacional extends MovimentoCaixaBase
{

    public function getAtividade()
    {
        return 'Operacional';
    }
}
