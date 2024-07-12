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
    <title>PEDIDO</title>
</head>
<body>
    <div class="container">

        <div class="header">
            <h2>PEDIDO</h2>
        </div>

        <div style="padding: 10px;">
            <?php 
                $botao = $_POST['botao'] ?? "";
                session_start();

                if($_SESSION['pgto'] == "pix") 
                {
                    $_SESSION['parcelas_'] = null;
                }

                 echo  '<p>' . '<strong>' . "Nome: " . '</strong>' . $_SESSION['nome'] . '</p>' . '<br>';
            echo '<p>' . '<strong>' . "Endereço: " . '</strong>' . $_SESSION['endereco'] . '</p>' . '<br>';
            echo '<p>' . '<strong>' . "Forma de Pagamento: " . '</strong>'. $_SESSION['pgto'] . '</p>' . '<br>';
            echo '<p>' . '<strong>' . "Condição de Pagamento: " . '</strong>' . $_SESSION['parcelas_'] . '</p>' . '<br>';
            echo '<p>' . '<strong>' . "Valor do Pedido: " . '</strong>'. $_SESSION['valor'] . '</p>' . '<br>';
            echo '<p>' . '<strong>' . "Valor da parcela: " . '</strong>' . $_SESSION['ValorFinal'] . '</p>';
        
                
                if($botao == "Gerenciar") 
                {
                    include "conexao.php";
                    $comando = $conexao->prepare("INSERT INTO produtos (descricao_produto, valor_produto, forma_pgto, condicao_pgto, valor_parcela)
                                VALUES (?, ?, ?, ?, ?)");
                                $comando->bindParam(1, $_SESSION['descricao']);
                                $comando->bindParam(2, $_SESSION['valor']);
                                $comando->bindParam(3, $_SESSION['pgto']);
                                $comando->bindParam(4, $_SESSION['parcelas_']);
                                $comando->bindParam(5, $_SESSION['ValorFinal']);
                    $comando -> execute();

                    session_start();
                    header('location:gerenciar.php');
                }

            ?>
        </div>
        

        <form action="pedido.php" method="post" class="form" style="padding: 10px;">
            <div class="outro2">
                <button type="submit" value="Gerenciar" name="botao">Gerenciar</button>
            </div>
        </form>

    </div>
    
</body>
</html>
