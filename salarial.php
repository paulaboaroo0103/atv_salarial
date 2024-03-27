<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calculadora de Salário para Vendedores</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        label {
            font-size: 16px;
            color: #555;
        }

        input[type="text"],
        input[type="number"] {
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 200px;
            outline: none;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #8a2be2;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #6c1c9c;
        }

        .resultado {
            margin-top: 20px;
            text-align: center;
        }

        p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
<h1>Calculadora de Salário para Vendedores</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<label for="nome">Nome do vendedor:</label><br>
<input type="text" id="nome" name="nome" required><br><br>
<label for="meta_semanal">Meta de venda semanal (em R$):</label><br>
<input type="number" id="meta_semanal" name="meta_semanal" required><br><br>
<label for="meta_mensal">Meta de venda mensal (em R$):</label><br>
<input type="number" id="meta_mensal" name="meta_mensal" required><br><br>
<input type="submit" value="Calcular Salário">
</form>
 
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obter os valores submetidos
            $nome = $_POST["nome"];
            $metaSemanal = $_POST["meta_semanal"];
            $metaMensal = $_POST["meta_mensal"];
 
            // Definir valores das faixas salariais
            $faixa1 = 1856.94;
            $faixa2 = 1927.02;
            $faixa3 = 1989.86;
            $faixa4 = 2134.88;
 
            // Determinar o salário mínimo com base na faixa salarial
            if ($metaSemanal >= 20000) {
                $salarioMinimo = $faixa1;
            } elseif ($metaSemanal >= 1816.60) {
                $salarioMinimo = $faixa2;
            } elseif ($metaSemanal >= 1877.19) {
                $salarioMinimo = $faixa3;
            } else {
                $salarioMinimo = $faixa4;
            }
 
            // Definir valores constantes
            $percentualSobreMetaSemanal = 0.01;
            $percentualExcedenteSemanal = 0.05;
            $percentualExcedenteMensal = 0.10;
 
            // Inicializar o salário final com o salário mínimo
            $salarioFinal = $salarioMinimo;
 
            // Se a meta semanal for atingida, calcular os bônus
            if ($metaSemanal >= 20000) {
                // Calcular o bônus do excedente de meta semanal
                $excedenteSemana = $metaSemanal - 20000;
                $bonusSemana = $excedenteSemana * $percentualExcedenteSemanal;
 
                // Calcular o bônus do excedente de meta mensal
                $excedenteMensal = $metaMensal - 80000;
                if ($excedenteMensal > 0) {
                    $bonusMensal = $excedenteMensal * $percentualExcedenteMensal;
                } else {
                    $bonusMensal = 0;
                }
 
                // Calcular o salário final
                $salarioFinal = $salarioMinimo + ($metaSemanal * $percentualSobreMetaSemanal) + $bonusSemana + $bonusMensal;
            }
 
            // Exibir o resultado
            echo "<h2>Resultado</h2>";
            echo "<p>O salário final de $nome é: R$ " . number_format($salarioFinal, 2, ',', '.') . "</p>";
        }
        ?>
</div>
</body>
</html>

