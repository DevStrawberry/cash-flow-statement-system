<?php

namespace App\Services;

use App\Models\MovimentoCaixa;
use Carbon\Carbon;

class DFCService
{
    public function gerarDemonstracao(Carbon $dataInicio, Carbon $dataFim, float $saldoInicial = 0.00): array
    {
        $movimentos = MovimentoCaixa::query()
            ->whereBetween('data_transacao', [$dataInicio, $dataFim])
            ->get();

        $demonstracao = [
            'periodo_inicio' => $dataInicio->toDateString(),
            'periodo_fim' => $dataFim->toDateString(),
            'saldo_inicial' => $saldoInicial,
            'atividades' => [
                'Operacional' => ['entradas' => 0.00, 'saidas' => 0.00, 'liquido' => 0.00],
                'Investimento' => ['entradas' => 0.00, 'saidas' => 0.00, 'liquido' => 0.00],
                'Financiamento' => ['entradas' => 0.00, 'saidas' => 0.00, 'liquido' => 0.00],
            ],
            'fluxo_liquido_total' => 0.00,
            'saldo_final' => 0.00,
        ];

        foreach ($movimentos as $movimento) {
            $atividade = $movimento->tipo_atividade;
            $valor = (float) $movimento->valor;

            if (isset($demonstracao['atividades'][$atividade])) {
                if ($valor >= 0) {
                    // Entrada (Recebimento)
                    $demonstracao['atividades'][$atividade]['entradas'] += $valor;
                } else {
                    $demonstracao['atividades'][$atividade]['saidas'] += abs($valor);
                }
            }
        }

        $fluxoLiquido = 0.00;

        foreach ($demonstracao['atividades'] as $atividade => $dados) {
            $liquido = $dados['entradas'] - $dados['saidas'];
            $demonstracao['atividades'][$atividade]['liquido'] = $liquido;

            $fluxoLiquido += $liquido;
        }


        $demonstracao['fluxo_liquido_total'] = $fluxoLiquido;
        $demonstracao['saldo_final'] = $saldoInicial + $fluxoLiquido;

        return $demonstracao;
    }
}
