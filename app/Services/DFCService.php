<?php

namespace App\Services;

use App\Models\MovimentoCaixa;
use Carbon\Carbon;

class DFCService
{
    public function gerarDemonstracao(Carbon $dataInicio, Carbon $dataFim, float $saldoInicial = 0.00): array
    {
        $fluxos = MovimentoCaixa::query()
            ->whereBetween('data_transacao', [$dataInicio, $dataFim])
            ->get()
            ->groupBy('tipo_atividade');

        $demonstracao = [
            'periodo_inicio' => $dataInicio->toDateString(),
            'periodo_fim' => $dataFim->toDateString(),
            'saldo_inicial' => $saldoInicial,
            'atividades' => [
                'Operacional' => 0.00,
                'Investimento' => 0.00,
                'Financiamento' => 0.00,
            ],
            'fluxo_liquido_total' => 0.00,
            'saldo_final' => 0.00,
        ];

        $fluxoLiquido = 0.00;

        foreach ($demonstracao['atividades'] as $atividade => $total) {
            if (isset($fluxos[$atividade])) {
                $totalAtividade = $fluxos[$atividade]->sum('valor');

                $demonstracao['atividades'][$atividade] = $totalAtividade;

                $fluxoLiquido += $totalAtividade;
            }
        }

        $demonstracao['fluxo_liquido_total'] = $fluxoLiquido;
        $demonstracao['saldo_final'] = $saldoInicial + $fluxoLiquido;

        return $demonstracao;
    }
}
