<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Fjalla+One&display=swap" rel="stylesheet">
    <title>GERENCIAR</title>
</head>

<body>
    <div class="container2">
        <div class="header">
            <h2>GERENCIAR</h2>
        </div>

        <form action="gerenciar.php?valor=enviado" method="post" id="form" class="form">

            <?php
            session_start();
            include "conexao.php";

            $Matriz = $conexao->prepare("select * FROM produtos");
            $Matriz->execute();
            echo "<table>";

            echo "<tr>";
            echo "<td>Id</td>";
            echo "<td>Descrição</td>";
            echo "<td>Valor (R$)</td>";
            echo "<td>Forma de Pagamento</td>";
            echo "<td>Condição de Pagamento</td>";
            echo "<td>Valor da Parcela</td>";
            echo "</tr>";

            while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) {
                $idProd = $Linha->id_prod;
                $descProd = $Linha->descricao_produto;
                $valorProd = $Linha->valor_produto;
                $formaPgto = $Linha->forma_pgto;
                $condicaoPgto = $Linha->condicao_pgto;
                $parcela = $Linha->valor_parcela;

                echo "<div >";
                echo "<tr>";
                echo "<td>" . $idProd . "</td>";
                echo "<td>" . $descProd . "</td>";
                echo "<td>" . $valorProd . "</td>";
                echo "<td>" . $formaPgto . "</td>";
                echo "<td>" . $condicaoPgto . "</td>";
                echo "<td>" . $parcela . "</td>";
                echo "</tr>";
                echo "</div>";
            }

            echo "</table><br><br>";
            ?>

            <?php

            if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) {
                $botao = $_POST['botao'];

                if ($botao == "alterar") {
                    $nome = $_POST['nome_cadastro'];
                    $endereco = $_POST['endereco_cadastro'];

                    $id = $_SESSION['id_usuario'];

                    $atualizarNovo = $conexao->prepare("UPDATE cadastro SET nome_usuario=?, endereco_usuario=? WHERE id_usuario=?");
                    $atualizarNovo->bindParam(1, $nome);
                    $atualizarNovo->bindParam(2, $endereco);
                    $atualizarNovo -> bindParam(3, $id);


                    $atualizarNovo->execute();
                    echo "<script> alert('Alteração realizada com sucesso!!') </script>";

                    $_SESSION['nome'] = $nome;
                    $_SESSION['endereco'] = $endereco;
                }
            }

            ?>

            <div class="form-control">
                <label for="">Nome:</label>
                <p><input type="text" name="nome_cadastro" placeholder="Preencher Nome" value="<?php echo $_SESSION['nome'] ?>"></p><br>

                <label for="">Endereço:</label>
                <p><input type="text" name="endereco_cadastro" placeholder="preencher email" value="<?php echo $_SESSION['endereco'] ?>"></p><br>

                <button type="submit" name="botao" value="alterar">Alterar</button><br>
            </div>

        </form>

    </div>

</body>

</html>