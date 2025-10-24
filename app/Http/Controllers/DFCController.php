<?php

namespace App\Http\Controllers;

use App\Services\DFCService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DFCController extends Controller
{
    protected DFCService $dfcService;

    public function __construct(DFCService $dfcService)
    {
        // Injeção de Dependência do Service
        $this->dfcService = $dfcService;
    }

    public function mostrarRelatorio(Request $request)
    {
        $dataInicio = Carbon::now()->startOfMonth();
        $dataFim = Carbon::now()->endOfMonth();

        $saldoInicial = 10000.00;

        $dfcRelatorio = $this->dfcService->gerarDemonstracao(
            $dataInicio,
            $dataFim,
            $saldoInicial
        );

        return view('relatorio_dfc', ['dfc' => $dfcRelatorio]);
    }
}
