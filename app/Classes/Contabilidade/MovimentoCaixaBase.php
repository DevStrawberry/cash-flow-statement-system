<?php

namespace App\Classes\Contabilidade;
abstract class MovimentoCaixaBase
{
    protected $valor;
    protected $descricao;

    public function __construct($valor, $descricao)
    {
        $this->valor = $valor;
        $this->descricao = $descricao;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    abstract public function getAtividade();
}
