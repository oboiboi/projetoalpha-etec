<?php 
$botao = $_POST['botao'];

if ($botao == "logar") 
{
    session_start();

    $login_usuario = $_POST['usuario_login'];
    $senha_usuario = $_POST['usuario_senha'];

    include "conexao.php";

    $comando = $conexao -> prepare("SELECT id_usuario, nome_usuario, endereco_usuario, senha_usuario, email_usuario FROM cadastro
    WHERE email_usuario = ? AND senha_usuario = ?");
    
    $comando -> bindParam(1, $login_usuario);
    $comando -> bindParam(2, $senha_usuario);

    if ($comando -> execute()) 
    {
        if ($comando -> rowCount() > 0)
        {
            while($linha = $comando -> fetch(PDO::FETCH_OBJ))
            {
                $id = $linha -> id_usuario;
                $_SESSION['id_usuario'] = $id; 

                $nome = $linha -> nome_usuario;
                $_SESSION['nome'] = $nome;

                $endereco = $linha -> endereco_usuario;
                $_SESSION['endereco'] = $endereco;

                $senha = $linha -> senha_usuario;
                $_SESSION['senha'] = $senha;

                $email = $linha -> email_usuario;
                $_SESSION['email'] = $email;
                
                header('location:cadastro.php');
            }
        }
        else 
        {
            echo "<script> alert('Usuário e/ou senha não confere!!')</script>";
            echo "<a href=\"login.html\">Retornar</a>";
        }
    }
}

if ($botao == "cadastro")
{
    session_start();
    header('location:cadastro.html');
}

if ($botao == "esqueci")
{
    session_start();
    header('location:recuperarsenha.html');
}

?>