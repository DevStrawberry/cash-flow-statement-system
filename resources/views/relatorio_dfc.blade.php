<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Demonstração do Fluxo de Caixa (DFC)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f7f6; }
        .container { max-width: 800px; margin: auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.2); }
        h1 { color: #007bff; text-align: center; margin-bottom: 20px; }
        .info { margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px; }
        .info p { margin: 5px 0; }
        .table-dfc { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table-dfc th, .table-dfc td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .table-dfc th { background-color: #f2f2f2; font-weight: bold; }
        .sub-row { background-color: #fafafa; font-size: 0.9em; padding-left: 20px !important; }
        .total-atividade-row { font-weight: bold; background-color: #e9ecef; }
        .final-saldo { background-color: #007bff; color: white; }
        /* Estilos adicionais para valores */
        .valor-positivo { color: green; }
        .valor-negativo { color: red; }
        .valor-neutro { color: #333; }
    </style>
</head>
<body>
<div class="container">
    <h1>Demonstração do Fluxo de Caixa</h1>

    <div class="info">
        <p><strong>Período:</strong> {{ $dfc['periodo_inicio'] }} a {{ $dfc['periodo_fim'] }}</p>
        <p><strong>Saldo Inicial de Caixa:</strong> R$ {{ number_format($dfc['saldo_inicial'], 2, ',', '.') }}</p>
    </div>

    <table class="table-dfc">
        <thead>
        <tr>
            <th>Atividade</th>
            <th>Valor Líquido (R$)</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($dfc['atividades'] as $atividade => $dados)
            {{-- Título da Atividade --}}
            <tr>
                <td>** FLUXO DE CAIXA DAS ATIVIDADES DE {{ strtoupper($atividade) }} **</td>
                <td></td>
            </tr>

            {{-- Detalhe: Entradas (Recebimentos) --}}
            <tr class="sub-row">
                <td>(+) Recebimentos de {{ $atividade }}</td>
                <td class="valor-positivo">R$ {{ number_format($dados['entradas'], 2, ',', '.') }}</td>
            </tr>

            {{-- Detalhe: Saídas (Pagamentos) --}}
            <tr class="sub-row">
                <td>(-) Pagamentos de {{ $atividade }}</td>
                {{-- CORREÇÃO: Adiciona o sinal de menos (-) manualmente --}}
                <td class="valor-negativo">- R$ {{ number_format($dados['saidas'], 2, ',', '.') }}</td>
            </tr>

            {{-- Total Líquido da Atividade --}}
            <tr class="total-atividade-row">
                <td>Resultado Líquido de {{ $atividade }}</td>
                <td class="{{ $dados['liquido'] >= 0 ? 'valor-positivo' : 'valor-negativo' }}">
                    R$ {{ number_format($dados['liquido'], 2, ',', '.') }}
                </td>
            </tr>
        @endforeach

        {{-- ---------------------------------------------------- --}}
        {{-- Fluxo Líquido Total --}}
        <tr class="total-row" style="background-color: #cce5ff;">
            <td>FLUXO DE CAIXA LÍQUIDO DO PERÍODO</td>
            <td class="{{ $dfc['fluxo_liquido_total'] >= 0 ? 'valor-positivo' : 'valor-negativo' }}">
                R$ {{ number_format($dfc['fluxo_liquido_total'], 2, ',', '.') }}
            </td>
        </tr>

        {{-- Saldo Final --}}
        <tr class="total-row final-saldo">
            <td>SALDO FINAL DE CAIXA E EQUIVALENTES</td>
            <td>R$ {{ number_format($dfc['saldo_final'], 2, ',', '.') }}</td>
        </tr>
        </tbody>
    </table>

    {{-- Usando a rota nomeada para maior robustez --}}
    <p style="margin-top: 30px; text-align: center;"><a href="{{ route('lancamento.form') }}">← Registrar Novo Lançamento</a></p>

</div>
</body>
</html>
