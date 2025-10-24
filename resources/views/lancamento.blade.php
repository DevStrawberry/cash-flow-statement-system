<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Lançamento de Caixa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f7f6; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;
        }
        button {
            background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px;
        }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
<div class="container">
    <h1>Registrar Movimento de Caixa</h1>

    {{-- O Laravel Blade usa a diretiva @csrf para proteção contra CSRF --}}
    <form method="POST" action="/lancamentos">
        @csrf

        {{-- Campo Valor --}}
        <label for="valor">Valor (R$):</label>
        <input type="number" id="valor" name="valor" step="0.01" required>

        {{-- Campo Descrição --}}
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required>

        {{-- Campo Data --}}
        <label for="data_transacao">Data da Transação:</label>
        <input type="date" id="data_transacao" name="data_transacao" value="{{ date('Y-m-d') }}" required>

        {{-- Campo Tipo de Atividade (Chave para sua lógica POO) --}}
        <label for="tipo_atividade">Classificação de Atividade:</label>
        <select id="tipo_atividade" name="tipo_atividade" required>
            <option value="" disabled selected>Selecione a atividade</option>
            {{-- Os valores abaixo são usados para instanciar as classes POO --}}
            <option value="Operacional">Operacional (Ex: Venda de Produto, Pagamento de Salário)</option>
            <option value="Investimento">Investimento (Ex: Compra de Máquina, Venda de Ativo)</option>
            <option value="Financiamento">Financiamento (Ex: Empréstimo, Aporte de Capital)</option>
        </select>

        <button type="submit">Salvar Lançamento</button>
    </form>
</div>
</body>
</html>
