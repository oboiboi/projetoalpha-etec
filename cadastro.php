<!DOCTYPE html>
<html lang="pt-br">

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
    <title>CADASTRO</title>
</head>

<body>
    <?php
    session_start();
    include "conexao.php";

    if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
    {
        $botao = $_POST['botao'];

        if ($botao == "cadastrar") 
        {
            $nome = $_POST['nome_cadastro'];
            $email = $_POST['email_cadastro'];
            $endereco = $_POST['endereco_cadastro'];
            $senha_cadastro = $_POST['senha_cadastro'];

            try 
            {
                if ($_POST['senha_cadastro'] == $_POST['senha_cadastro_confirma']) 
                {
                    $comando = $conexao->prepare("INSERT INTO cadastro (nome_usuario, endereco_usuario, senha_usuario, email_usuario)
                     VALUES (?, ?, ?, ?)");
                    $comando->bindParam(1, $nome);
                    $comando->bindParam(2, $endereco);
                    $comando->bindParam(3, $senha_cadastro);
                    $comando->bindParam(4, $email);

                    if ($comando->execute()) 
                    {
                        if ($comando->rowCount() > 0) 
                        {
                            echo "<script> alert('Cadastro realizado com sucesso!!') </script>";
                            $_SESSION['nome'] = $nome;
                            $_SESSION['email'] = $email;
                            $_SESSION['endereco'] = $endereco;
                            $_SESSION['senha'] = $senha;

                            $nome = null;
                            $endereco = null;
                            $senha = null;
                            $email = null;

                            header('location:login.html');
                        } else 
                        {
                            echo "Erro ao tentar efetivar o contato.";
                        }
                    } else 
                    {
                        throw new PDOException("ERRO: Não foi possível executar a declaração SQL.");
                    }
                } else 
                {
                    echo ('Senha não confere.') . '<br>';
                    echo "<a href=\"cadastro.html\">cadastro</a>";
                }
            } catch (PDOException $erro) 
            {
                echo "Erro" . $erro->getMessage();
            }
        }
        if ($botao == "alterar")
        {
            $nome = $_POST['nome_cadastro'];
            $email = $_POST['email_cadastro'];
            $endereco = $_POST['endereco_cadastro'];
            $senha_cadastro = $_POST['senha_cadastro'];

            $id = $_SESSION['id_usuario'];

            $atualizarNovo = $conexao -> prepare("UPDATE cadastro SET nome_usuario=?, endereco_usuario=?, senha_usuario=?, email_usuario=? WHERE id_usuario=?");
            $atualizarNovo -> bindParam(1, $nome);
            $atualizarNovo -> bindParam(2, $endereco);
            $atualizarNovo -> bindParam(3, $senha_cadastro);
            $atualizarNovo -> bindParam(4, $email);
            $atualizarNovo -> bindParam(5, $id);

            $atualizarNovo -> execute();
            $_SESSION['nome'] = $nome;
            $_SESSION['endereco'] = $endereco;
            header('location:pagamento.html');
            echo "<script> alert('Alteração realizada com sucesso!!') </script>";
        }

        if ($botao == "confirmar") 
        {
            header('location:pagamento.html');
        }
    }
    else 
    {
    ?>
       <div class="container">
            <div class="header">
                <h2>CADASTRO</h2>
            </div>
            <form action="cadastro.php?valor=enviado" method="post" id="form" class="form">
                <div class="form-control">
                    <label for="">Nome:</label>
                    <input type="text" name="nome_cadastro" placeholder="Preencher nome." value="<?php echo $_SESSION['nome'] ?>">
                </div>
                <div class="form-control">
                    <label for="">E-mail:</label>
                    <input type="email" name="email_cadastro" placeholder="Preencher e-mail." value="<?php echo $_SESSION['email'] ?>">
                </div>
                <div class="form-control">
                    <label for="">Endereço:</label>
                    <input type="text" name="endereco_cadastro" placeholder="Preencher endereço." value="<?php echo $_SESSION['endereco'] ?>">
                </div>
                <div class="form-control">
                    <label for="">Senha:</label>
                    <input type="password" name="senha_cadastro" placeholder="Preencher senha." maxlength="8" required value="<?php echo $_SESSION['senha'] ?>">
                </div>
                <div class="form-control">
                    <label for="">Confirmar senha:</label>
                    <input type="password" name="senha_cadastro_confirma" placeholder="Preencher senha novamente." maxlength="8" required value="<?php echo $_SESSION['senha'] ?>">
                </div>
                
                <div class="outro">
                    <button type="submit" name="botao" value="confirmar">Confirmar Cadastro</button>
                    <button type="submit" name="botao" value="alterar">Alterar Cadastro</button>
                </div>
                
            </form>
        </div>
    <?php
    }
    ?>
</body>
</html>