<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovimentoCaixaService;
use App\Classes\Contabilidade\Operacional;
use App\Classes\Contabilidade\Investimento;
use App\Classes\Contabilidade\Financiamento;
use Illuminate\Validation\ValidationException;

class TransacaoController extends Controller
{
    protected MovimentoCaixaService $movimentoService;

    public function __construct(MovimentoCaixaService $movimentoService)
    {
        // Injeção de Dependência
        $this->movimentoService = $movimentoService;
    }

    public function mostrarFormulario()
    {
        return view('lancamento');
    }

    public function salvar(Request $request)
    {
        try {
            $request->validate([
                // CORREÇÃO: Removemos 'min:0.01' para permitir valores negativos.
                // Agora aceita qualquer valor numérico.
                'valor' => 'required|numeric',

                'descricao' => 'required|string|max:255',
                'data_transacao' => 'required|date',
                'tipo_atividade' => 'required|in:Operacional,Investimento,Financiamento',
            ]);
        } catch (ValidationException $e) {
            // Se a validação falhar, redireciona de volta com os erros
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $valor = $request->input('valor');
        $descricao = $request->input('descricao');
        $data = $request->input('data_transacao');
        $tipoAtividade = $request->input('tipo_atividade');

        $movimentoPuro;
        if ($tipoAtividade == 'Operacional') {
            $movimentoPuro = new Operacional($valor, $descricao);
        } elseif ($tipoAtividade == 'Investimento') {
            $movimentoPuro = new Investimento($valor, $descricao);
        } elseif ($tipoAtividade == 'Financiamento') {
            $movimentoPuro = new Financiamento($valor, $descricao);
        }

        $this->movimentoService->registrar($movimentoPuro, $data);

        return redirect('/relatorio')->with('success', 'Lançamento registrado com sucesso!');
    }
}
