<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 1 – Calculadora Simples</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 360px;
        }
        h2 { color: #2d3748; margin-bottom: 1.5rem; text-align: center; }
        label { display: block; margin-bottom: 0.3rem; color: #4a5568; font-size: 0.9rem; }
        input, select {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 1rem;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background: #4299e1;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 600;
        }
        button:hover { background: #3182ce; }
        .resultado {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #ebf8ff;
            border-left: 4px solid #4299e1;
            border-radius: 6px;
            color: #2b6cb0;
            font-size: 1.1rem;
            text-align: center;
        }
        .erro {
            background: #fff5f5;
            border-left-color: #fc8181;
            color: #c53030;
        }
    </style>
</head>
<body>
<div class="card">
    <h2>🧮 Calculadora</h2>

    <!--
        FORMULÁRIO – Envia dados via POST para a mesma página (action="").
        O PHP processa os dados quando o botão é clicado.
    -->
    <form method="POST" action="">

        <label for="num1">Primeiro número:</label>
        <input type="number" id="num1" name="num1" step="any" required>

        <label for="num2">Segundo número:</label>
        <input type="number" id="num2" name="num2" step="any" required>

        <!--
            SELECT – permite ao usuário escolher a operação desejada.
            O valor de cada <option> é o que chegará em $_POST['operacao'].
        -->
        <label for="operacao">Operação:</label>
        <select id="operacao" name="operacao">
            <option value="soma">➕ Soma</option>
            <option value="subtracao">➖ Subtração</option>
            <option value="multiplicacao">✖️ Multiplicação</option>
            <option value="divisao">➗ Divisão</option>
        </select>

        <button type="submit">Calcular</button>
    </form>

    <?php
    /*
        Verificamos se o formulário foi enviado checando se existe
        a chave 'num1' dentro do array superglobal $_POST.
        Isso evita executar o código de cálculo no primeiro carregamento da página.
    */
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Recupera e converte os valores para float (aceita decimais)
        $num1 = (float) $_POST['num1'];
        $num2 = (float) $_POST['num2'];
        $operacao = $_POST['operacao'];

        $resultado = null; // Variável que vai guardar o resultado
        $erro = '';        // Variável para mensagens de erro

        /*
            SWITCH – testa o valor de $operacao e executa o bloco correspondente.
            É mais legível do que vários if/elseif quando há múltiplas opções fixas.
        */
        switch ($operacao) {
            case 'soma':
                $resultado = $num1 + $num2;
                $simbolo = '+';
                break;

            case 'subtracao':
                $resultado = $num1 - $num2;
                $simbolo = '-';
                break;

            case 'multiplicacao':
                $resultado = $num1 * $num2;
                $simbolo = '×';
                break;

            case 'divisao':
                /*
                    TRATAMENTO DE DIVISÃO POR ZERO:
                    Antes de dividir, verificamos se o divisor ($num2) é igual a 0.
                    Divisão por zero em matemática é indefinida, então exibimos um erro.
                */
                if ($num2 == 0) {
                    $erro = '⚠️ Erro: divisão por zero não é permitida!';
                } else {
                    $resultado = $num1 / $num2;
                    $simbolo = '÷';
                }
                break;
        }

        // Exibe o resultado ou a mensagem de erro com HTML
        if ($erro) {
            echo "<div class='resultado erro'>$erro</div>";
        } else {
            // number_format() formata o número com 2 casas decimais e vírgula como separador
            $formatado = number_format($resultado, 2, ',', '.');
            echo "<div class='resultado'>$num1 $simbolo $num2 = <strong>$formatado</strong></div>";
        }
    }
    ?>
</div>
</body>
</html>
