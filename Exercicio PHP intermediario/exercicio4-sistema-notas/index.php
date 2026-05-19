<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 4 – Sistema de Notas</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fffaf0;
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
        h2 { color: #c05621; text-align: center; margin-bottom: 1.5rem; }
        label { display: block; margin-bottom: 0.3rem; color: #4a5568; font-size: 0.9rem; }
        input {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border: 1px solid #fbd38d;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 1rem;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background: #ed8936;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 600;
        }
        button:hover { background: #dd6b20; }
        .boletim {
            margin-top: 1.5rem;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #fbd38d;
        }
        .boletim-header {
            background: #ed8936;
            color: white;
            padding: 0.8rem 1rem;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .boletim-body { padding: 1rem; }
        .linha {
            display: flex;
            justify-content: space-between;
            padding: 0.4rem 0;
            border-bottom: 1px dashed #fbd38d;
            font-size: 0.95rem;
            color: #2d3748;
        }
        .linha:last-child { border-bottom: none; }
        .situacao {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-weight: bold;
        }
        .aprovado     { background: #c6f6d5; color: #22543d; }
        .recuperacao  { background: #fefcbf; color: #744210; }
        .reprovado    { background: #fed7d7; color: #742a2a; }
    </style>
</head>
<body>
<div class="card">
    <h2>📋 Sistema de Notas</h2>

    <!-- Formulário POST com múltiplos campos de entrada -->
    <form method="POST" action="">

        <label for="nome">Nome do aluno:</label>
        <input type="text" id="nome" name="nome" placeholder="Ex: João Silva" required>

        <label for="nota1">Nota 1 (0 a 10):</label>
        <input type="number" id="nota1" name="nota1" min="0" max="10" step="0.1" required>

        <label for="nota2">Nota 2 (0 a 10):</label>
        <input type="number" id="nota2" name="nota2" min="0" max="10" step="0.1" required>

        <label for="nota3">Nota 3 (0 a 10):</label>
        <input type="number" id="nota3" name="nota3" min="0" max="10" step="0.1" required>

        <button type="submit">Calcular Média</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Recupera o nome e sanitiza (remove tags HTML para segurança)
        $nome  = htmlspecialchars($_POST['nome']);

        // Converte as notas para float
        $nota1 = (float) $_POST['nota1'];
        $nota2 = (float) $_POST['nota2'];
        $nota3 = (float) $_POST['nota3'];

        /*
            CÁLCULO DA MÉDIA ARITMÉTICA:
            Soma as três notas e divide por 3.
            round() arredonda para 2 casas decimais.
        */
        $media = round(($nota1 + $nota2 + $nota3) / 3, 2);

        /*
            SITUAÇÃO DO ALUNO com operadores relacionais (>=, <):
            - Aprovado:    média >= 7
            - Recuperação: média >= 5 e < 7   (usa && para combinar condições)
            - Reprovado:   média < 5

            A ordem dos if/elseif importa: testamos do maior para o menor.
        */
        if ($media >= 7) {
            $situacao = "<span class='situacao aprovado'>✅ Aprovado</span>";
        } elseif ($media >= 5) {
            // Entra aqui apenas se $media < 7 (o if anterior já eliminou >= 7)
            $situacao = "<span class='situacao recuperacao'>⚠️ Recuperação</span>";
        } else {
            // Entra aqui apenas se $media < 5
            $situacao = "<span class='situacao reprovado'>❌ Reprovado</span>";
        }

        // number_format formata o número com 2 casas decimais e vírgula decimal (padrão BR)
        $mediaFormatada = number_format($media, 2, ',', '');

        // Exibe o boletim formatado com HTML
        echo "
        <div class='boletim'>
            <div class='boletim-header'>📄 Boletim de $nome</div>
            <div class='boletim-body'>
                <div class='linha'><span>Nota 1</span><strong>$nota1</strong></div>
                <div class='linha'><span>Nota 2</span><strong>$nota2</strong></div>
                <div class='linha'><span>Nota 3</span><strong>$nota3</strong></div>
                <div class='linha'><span>Média</span><strong>$mediaFormatada</strong></div>
                <div class='linha'><span>Situação</span>$situacao</div>
            </div>
        </div>";
    }
    ?>
</div>
</body>
</html>
