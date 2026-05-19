<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 2 – Par ou Ímpar</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f7fafc;
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
            width: 340px;
        }
        h2 { color: #2d3748; text-align: center; margin-bottom: 1.5rem; }
        label { display: block; margin-bottom: 0.4rem; color: #4a5568; }
        input {
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
            background: #48bb78;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 600;
        }
        button:hover { background: #38a169; }
        .resultado {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #f0fff4;
            border-left: 4px solid #48bb78;
            border-radius: 6px;
            color: #276749;
        }
        .resultado p { margin: 0.4rem 0; font-size: 1rem; }
        .badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.95rem;
        }
        .par   { background: #bee3f8; color: #2c5282; }
        .impar { background: #feebc8; color: #7b341e; }
        .pos   { background: #c6f6d5; color: #22543d; }
        .neg   { background: #fed7d7; color: #742a2a; }
        .zero  { background: #e2e8f0; color: #4a5568; }
    </style>
</head>
<body>
<div class="card">
    <h2>🔢 Par ou Ímpar?</h2>

    <!--
        MÉTODO GET – Os dados são enviados pela URL (ex: index.php?numero=7).
        Útil para buscas e verificações simples, pois o link pode ser salvo/compartilhado.
    -->
    <form method="GET" action="">

        <label for="numero">Digite um número inteiro:</label>
        <input type="number" id="numero" name="numero" required>

        <button type="submit">Verificar</button>
    </form>

    <?php
    /*
        Para o método GET, usamos o superglobal $_GET (em vez de $_POST).
        isset() verifica se a chave 'numero' existe no array $_GET,
        ou seja, se o formulário foi enviado.
    */
    if (isset($_GET['numero'])) {

        // Converte para inteiro; inteiros não têm casas decimais
        $numero = (int) $_GET['numero'];

        // ── VERIFICAÇÃO 1: Par ou Ímpar ──────────────────────────────────────
        /*
            O operador módulo (%) retorna o RESTO da divisão inteira.
            Ex: 6 % 2 = 0 → par | 7 % 2 = 1 → ímpar
        */
        if ($numero % 2 === 0) {
            $paridade = "<span class='badge par'>Par</span>";
        } else {
            $paridade = "<span class='badge impar'>Ímpar</span>";
        }

        // ── VERIFICAÇÃO 2: Positivo, Negativo ou Zero ─────────────────────────
        /*
            Aqui usamos a estrutura if / elseif / else para cobrir os três casos.
            A ordem importa: verificamos zero separadamente para não confundir
            com positivo (0 > 0 é falso, então cai no else corretamente).
        */
        if ($numero > 0) {
            $sinal = "<span class='badge pos'>Positivo ▲</span>";
        } elseif ($numero < 0) {
            $sinal = "<span class='badge neg'>Negativo ▼</span>";
        } else {
            $sinal = "<span class='badge zero'>Zero</span>";
        }

        // Exibe os resultados formatados
        echo "
        <div class='resultado'>
            <p>Número informado: <strong>$numero</strong></p>
            <p>Paridade: $paridade</p>
            <p>Sinal: $sinal</p>
        </div>";
    }
    ?>
</div>
</body>
</html>
