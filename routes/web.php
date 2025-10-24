<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DFCController;
use App\Http\Controllers\TransacaoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você registra as rotas web para a sua aplicação DFC.
|
*/

// 1. Rota de Boas-vindas (Redireciona para o Relatório)
// Quando o usuário acessa a raiz do site, ele é levado diretamente para o relatório DFC.
Route::get('/', function () {
    return redirect('/relatorio');
});

// 2. Rota para o Relatório DFC (Visualização)
// O DFCController chama o DFCService para calcular e mostrar a Demonstração.
Route::get('/relatorio', [DFCController::class, 'mostrarRelatorio'])->name('dfc.relatorio');

// 3. Rota para o Formulário de Lançamento (GET)
// Exibe a view 'lancamento.blade.php' para inserir novos movimentos.
Route::get('/lancamento', [TransacaoController::class, 'mostrarFormulario'])->name('lancamento.form');

// 4. Rota de Submissão do Formulário (POST)
// Recebe os dados, o TransacaoController orquestra a criação do objeto POO e salva via Service.
Route::post('/lancamentos', [TransacaoController::class, 'salvar'])->name('lancamento.salvar');
