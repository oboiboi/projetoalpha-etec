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
    <title>Document</title>
</head>
<body>

<?php

if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{
    session_start();

    $descricao = $_POST['descricao_produto'];
    $valor = $_POST['valor_produto'];
    $botao = $_POST['botao'];
    $_SESSION['descricao'] = $descricao;
    $_SESSION['valor'] = $valor;

    header("location:login.html");
}

?>
    <div class="container">
        <form action="produto.php?valor=enviado" method="post"  id="form" class="form">
            <?php
                if (isset($_GET['image'])) 
                {
                    $image = $_GET['image'];
                    echo "<img src='$image' alt='Imagem Selecionada' height='auto' width='250' class='centraliza'>";
                } 
            
                else 
                {
                    echo "<p>Imagem não encontrada.</p>";
                }
            ?>
            
            <div class="form-control">
                <label for="">Descrição: </label>
                <input type="text" name="descricao_produto" id="descricao_produto" placeholder="Preencher descrição">
                <br>
                <label for="">Valor (R$):</label>
                <input type="number" name="valor_produto" id="valor_produto" placeholder="Preencher valor">
                <br><br>
                <div class="outro5">
                    <button type="submit" name="botao" id="botao" value="comprar">Comprar</button>
                </div>

            </div>
        </form>
    </div>
    
</body>
</html>