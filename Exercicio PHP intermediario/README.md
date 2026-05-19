# 📚 Lista 1 – Exercícios PHP Básico

> Coleção de exercícios introdutórios em PHP cobrindo formulários, estruturas condicionais, laços de repetição e arrays.

---

## 🗂️ Estrutura do Projeto

```
lista1-php/
├── exercicio1-calculadora/
│   └── index.php          # Calculadora com POST e switch
├── exercicio2-par-impar/
│   └── index.php          # Verificador com GET e if/elseif/else
├── exercicio3-tabuada/
│   └── index.php          # Tabuada dinâmica com for
├── exercicio4-sistema-notas/
│   └── index.php          # Boletim escolar com média e condições
├── exercicio5-cadastro/
│   └── index.php          # Cadastro com array, foreach + Desafio Extra
└── README.md
```

---

## 🧪 Exercícios

### Exercício 1 – Calculadora Simples
**Conceitos:** `POST`, `switch`, operadores aritméticos, tratamento de erro

Formulário com dois campos numéricos e um `<select>` para escolher entre soma, subtração, multiplicação e divisão. Inclui tratamento de divisão por zero.

**Conceitos-chave:**
- `$_POST` para receber dados do formulário
- `switch/case` para selecionar a operação
- Validação condicional antes de dividir

---

### Exercício 2 – Verificador de Par ou Ímpar
**Conceitos:** `GET`, `if/elseif/else`, operador módulo (`%`)

O usuário digita um número e o sistema informa se é par ou ímpar, e se é positivo, negativo ou zero.

**Conceitos-chave:**
- `$_GET` para receber dados pela URL
- Operador módulo `%` para verificar paridade
- Encadeamento `if / elseif / else`

---

### Exercício 3 – Tabuada Dinâmica
**Conceitos:** `POST`, laço `for`, tabela HTML

Gera a tabuada completa (de 1 a 10) de qualquer número informado, exibida em uma tabela HTML estilizada.

**Conceitos-chave:**
- Laço `for` com inicialização, condição e incremento
- Geração dinâmica de linhas de tabela HTML dentro do loop

---

### Exercício 4 – Sistema de Notas
**Conceitos:** `POST`, média aritmética, `if/elseif/else`, operadores relacionais

Recebe nome do aluno e três notas, calcula a média e exibe a situação: Aprovado (≥7), Recuperação (≥5 e <7) ou Reprovado (<5).

**Conceitos-chave:**
- Múltiplas variáveis numéricas via `$_POST`
- `htmlspecialchars()` para prevenir XSS
- `number_format()` para formatar valores decimais
- Operadores relacionais `>=`, `<`

---

### Exercício 5 – Mini Sistema de Cadastro com Lista
**Conceitos:** `POST`, arrays, `foreach`, tabela HTML, campo hidden

Permite cadastrar múltiplas pessoas (nome + idade) e lista todas em uma tabela com a situação de maioridade. Os dados são persistidos entre requisições via campo `<input type="hidden">` com JSON.

**Conceitos-chave:**
- Array indexado e array associativo em PHP
- `json_encode()` / `json_decode()` para serializar dados entre requisições
- `foreach` para iterar sobre o array de pessoas
- Campo `hidden` como estratégia simples de persistência sem banco de dados

#### ⭐ Desafio Extra (incluso no Exercício 5)
Conta e exibe ao final da tabela quantas pessoas são maiores e menores de idade, usando um contador incrementado dentro do `foreach`.

---

## 🚀 Como Executar

### Pré-requisitos
- PHP 7.4+ instalado ([php.net/downloads](https://www.php.net/downloads))
- Ou um ambiente como **XAMPP**, **Laragon** ou **WAMP**

### Rodando com o servidor embutido do PHP

```bash
# Clone o repositório
git clone https://github.com/seu-usuario/lista1-php.git
cd lista1-php

# Inicie o servidor na pasta de um exercício específico
cd exercicio1-calculadora
php -S localhost:8000

# Acesse no navegador
# http://localhost:8000
```

> Para trocar de exercício, pare o servidor (`Ctrl+C`), entre na pasta do próximo exercício e repita o comando.

### Rodando com XAMPP / Laragon
1. Copie a pasta `lista1-php/` para dentro de `htdocs/` (XAMPP) ou `www/` (Laragon)
2. Inicie o Apache
3. Acesse `http://localhost/lista1-php/exercicio1-calculadora/`

---

## 📖 Conceitos Abordados

| Conceito | Exercícios |
|---|---|
| Formulários HTML (`form`, `input`, `select`) | 1, 2, 3, 4, 5 |
| Método POST (`$_POST`) | 1, 3, 4, 5 |
| Método GET (`$_GET`) | 2 |
| Estrutura `switch/case` | 1 |
| Estrutura `if/elseif/else` | 2, 4, 5 |
| Laço `for` | 3 |
| Laço `foreach` | 5 |
| Arrays indexados e associativos | 5 |
| `json_encode` / `json_decode` | 5 |
| `htmlspecialchars` (segurança) | 4, 5 |
| `number_format` (formatação) | 1, 4 |
| Tabelas HTML dinâmicas | 3, 5 |

---

## 🛡️ Boas Práticas Utilizadas

- **`htmlspecialchars()`** em dados vindos do usuário para prevenir XSS
- **Verificação do método HTTP** com `$_SERVER['REQUEST_METHOD']` antes de processar
- **Conversão de tipos** (`(int)`, `(float)`) ao receber dados numéricos do formulário
- **Tratamento de casos especiais** (divisão por zero, array vazio)
- Código amplamente comentado para facilitar o estudo

---

## 📝 Licença

Projeto de fins educacionais. Livre para uso e adaptação.
