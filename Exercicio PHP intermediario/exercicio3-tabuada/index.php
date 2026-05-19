<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 3 – Tabuada Dinâmica</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #faf5ff;
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
            width: 380px;
        }
        h2 { color: #553c9a; text-align: center; margin-bottom: 1.5rem; }
        label { display: block; margin-bottom: 0.4rem; color: #4a5568; }
        input {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border: 1px solid #d6bcfa;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 1rem;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background: #805ad5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 600;
        }
        button:hover { background: #6b46c1; }
        h3 { color: #553c9a; text-align: center; margin-top: 1.5rem; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.5rem;
        }
        th {
            background: #805ad5;
            color: white;
            padding: 0.5rem 0.8rem;
            text-align: center;
        }
        td {
            padding: 0.45rem 0.8rem;
            text-align: center;
            border-bottom: 1px solid #e9d8fd;
            color: #2d3748;
        }
        tr:nth-child(even) td { background: #faf5ff; }
        tr:hover td { background: #e9d8fd; }
        .destaque { font-weight: bold; color: #553c9a; }
    </style>
</head>
<body>
<div class="card">
    <h2>📊 Tabuada Dinâmica</h2>

    <!-- Formulário enviado via POST, como exigido pelo enunciado -->
    <form method="POST" action="">
        <label for="numero">Digite um número:</label>
        <input type="number" id="numero" name="numero" required>
        <button type="submit">Gerar Tabuada</button>
    </form>

    <?php
    // Verifica se o formulário foi submetido via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $numero = (int) $_POST['numero'];

        echo "<h3>Tabuada do $numero</h3>";

        // Exibe a tabuada dentro de uma tabela HTML
        echo "<table>";
        echo "  <thead>
                    <tr>
                        <th>Multiplicação</th>
                        <th>Resultado</th>
                    </tr>
                </thead>";
        echo "<tbody>";

        /*
            ESTRUTURA DE REPETIÇÃO FOR:
            - Inicialização: $i = 1 (começa no 1)
            - Condição: $i <= 10 (executa enquanto $i for menor ou igual a 10)
            - Incremento: $i++ (adiciona 1 a $i a cada iteração)

            A cada volta do laço, calculamos e exibimos uma linha da tabuada.
        */
        for ($i = 1; $i <= 10; $i++) {

            $resultado = $numero * $i; // Calcula o produto da vez

            // Insere uma linha na tabela com a expressão e o resultado
            echo "<tr>
                    <td>$numero × $i</td>
                    <td class='destaque'>$resultado</td>
                  </tr>";
        }

        echo "</tbody></table>";
    }
    ?>
</div>
</body>
</html>
