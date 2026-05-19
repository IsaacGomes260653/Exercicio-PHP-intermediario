<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 5 – Cadastro com Lista</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0fff4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
            margin: 0;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 700px;
            margin-bottom: 2rem;
        }
        h2 { color: #276749; margin-bottom: 1.5rem; text-align: center; }
        h3 { color: #276749; margin-bottom: 1rem; }
        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .form-group { flex: 1; }
        label { display: block; margin-bottom: 0.3rem; color: #4a5568; font-size: 0.9rem; }
        input {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border: 1px solid #9ae6b4;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        button {
            padding: 0.7rem 1.5rem;
            background: #38a169;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 600;
            margin-top: 0.5rem;
        }
        button:hover { background: #276749; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.5rem;
        }
        th {
            background: #38a169;
            color: white;
            padding: 0.6rem 1rem;
            text-align: left;
        }
        td {
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #c6f6d5;
            color: #2d3748;
        }
        tr:nth-child(even) td { background: #f0fff4; }
        .badge {
            display: inline-block;
            padding: 0.2rem 0.7rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .maior { background: #bee3f8; color: #2c5282; }
        .menor { background: #feebc8; color: #7b341e; }
        .rodape {
            background: #e6fffa;
            border: 1px solid #81e6d9;
            border-radius: 8px;
            padding: 0.8rem 1.2rem;
            margin-top: 1rem;
            color: #234e52;
            font-size: 0.95rem;
        }
        .vazio { color: #a0aec0; font-style: italic; text-align: center; padding: 1rem; }
    </style>
</head>
<body>

<!--
    EXERCÍCIO 5 + DESAFIO EXTRA:
    Este arquivo implementa o exercício 5 e o desafio extra juntos.

    DESAFIO EXTRA: Conta quantas pessoas são maiores de idade e exibe ao final da tabela.

    ESTRATÉGIA DE PERSISTÊNCIA DOS DADOS:
    Como o PHP não mantém variáveis entre requisições (cada POST é um novo ciclo),
    usamos campos hidden (<input type="hidden">) para "passar" os dados anteriores
    de volta ao servidor a cada envio. Os dados ficam codificados em JSON.
-->

<div class="card">
    <h2>👥 Cadastro de Pessoas</h2>

    <form method="POST" action="">

        <div class="form-row">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Ex: Maria" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" min="0" max="120" required>
            </div>
        </div>

        <?php
        /*
            RECUPERAÇÃO DOS DADOS ANTERIORES:
            A cada envio do formulário, lemos o campo hidden "pessoas_json"
            que contém todos os cadastros anteriores em formato JSON.
            json_decode(..., true) converte JSON em array PHP.
        */
        $pessoas = [];
        if (!empty($_POST['pessoas_json'])) {
            $pessoas = json_decode($_POST['pessoas_json'], true);
        }

        // Se um novo cadastro foi enviado (campos nome e idade preenchidos)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nome'])) {

            // Cria um novo registro como array associativo
            $novaPessoa = [
                'nome'  => htmlspecialchars($_POST['nome']),
                'idade' => (int) $_POST['idade']
            ];

            /*
                ARRAY – adicionamos o novo registro ao final do array $pessoas.
                O operador [] equivale a array_push() e é a forma idiomática em PHP.
            */
            $pessoas[] = $novaPessoa;
        }

        /*
            CAMPO HIDDEN – armazena o array inteiro como JSON no formulário.
            Quando o usuário enviar o formulário novamente, esse valor volta
            no $_POST e conseguimos recuperar todos os cadastros anteriores.
        */
        $pessoasJson = htmlspecialchars(json_encode($pessoas));
        echo "<input type='hidden' name='pessoas_json' value='$pessoasJson'>";
        ?>

        <button type="submit">➕ Cadastrar</button>
    </form>
</div>

<!-- Tabela de pessoas cadastradas -->
<div class="card">
    <h3>📋 Pessoas Cadastradas</h3>

    <?php
    if (empty($pessoas)) {
        // Caso nenhuma pessoa tenha sido cadastrada ainda
        echo "<p class='vazio'>Nenhuma pessoa cadastrada ainda.</p>";
    } else {

        // ── DESAFIO EXTRA: contador de maiores de idade ───────────────────────
        $maioresDeIdade = 0; // Inicia o contador em zero

        echo "<table>";
        echo "<thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Situação</th>
                </tr>
              </thead>";
        echo "<tbody>";

        /*
            FOREACH – percorre cada elemento do array $pessoas.
            $index começa em 0; somamos 1 para exibir a numeração a partir de 1.
            $pessoa é um array associativo: $pessoa['nome'] e $pessoa['idade'].
        */
        foreach ($pessoas as $index => $pessoa) {

            $num   = $index + 1;
            $nome  = $pessoa['nome'];
            $idade = $pessoa['idade'];

            /*
                Verifica a situação de cada pessoa com operador relacional (<, >=).
                Simultaneamente, incrementamos o contador do Desafio Extra.
            */
            if ($idade >= 18) {
                $situacao = "<span class='badge maior'>✅ Maior de idade</span>";
                $maioresDeIdade++; // Incrementa o contador do desafio extra
            } else {
                $situacao = "<span class='badge menor'>⚠️ Menor de idade</span>";
            }

            echo "<tr>
                    <td>$num</td>
                    <td>$nome</td>
                    <td>$idade anos</td>
                    <td>$situacao</td>
                  </tr>";
        }

        echo "</tbody></table>";

        // ── DESAFIO EXTRA: Exibe o total de maiores de idade ao final ─────────
        $menoresDeIdade = count($pessoas) - $maioresDeIdade; // count() retorna o tamanho do array

        echo "
        <div class='rodape'>
            👤 Total cadastrado: <strong>" . count($pessoas) . " pessoas</strong> —
            ✅ Maiores de idade: <strong>$maioresDeIdade</strong> —
            ⚠️ Menores de idade: <strong>$menoresDeIdade</strong>
        </div>";
    }
    ?>
</div>

</body>
</html>
