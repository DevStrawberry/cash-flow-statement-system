<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DFCService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DFCController
{
    public function mostrarRelatorio(DFCService $dfcService, Request $request)
    {
        $dataInicio = Carbon::now()->startOfMonth();
        $dataFim = Carbon::now()->endOfMonth();
        $saldoAnterior = 10000.00;

        $dfcRelatorio = $dfcService->gerarDemonstracao($dataInicio, $dataFim, $saldoAnterior);

        return view('relatorio_dfc', ['dfc' => $dfcRelatorio]);
    }
}
