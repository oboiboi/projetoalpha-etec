<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
$botao = $_POST['botao'];
$email_rec = $_POST['email_recuperar'];
$corpo = $_SESSION['senha'];

var_dump($email_rec);

require("phpmailer/src/PHPMailer.php");
require("phpmailer/src/SMTP.php");
require("phpmailer/src/Exception.php");
include "remetente.php"; 

$para = $email_rec;
$de = 'alvaro.cavalcanti01@etec.sp.gov.br';
$de_nome = 'Alvaro Cavalcanti';
$assunto = 'Recuperar Senha';

function smtmailer($para, $de, $de_nome, $assunto, $corpo) 
{
    global $error;
    $mail = new PHPMailer();
    $mail -> IsSMTP();
    $mail -> SMTPDebug = 0;
    $mail -> SMTPAuth = true;
    $mail -> SMTPSecure = 'tls';
    $mail -> Host = 'smtp-mail.outlook.com';
    $mail -> Port = 587;
    $mail -> Username = USER;
    $mail -> Password = PWD;
    $mail -> SetFrom($de, $de_nome);
    $mail -> Subject = $assunto;
    $mail -> Body = $corpo;
    $mail -> AddAddress($para);
    if(!$mail->Send())
    {
        $error = 'Mail error: ' . $mail -> ErrorInfo;
        return false; 
    }
    else 
    {
        $error = 'Mensagem enviada!!';
        return true;  
    }
}

$Vai = "Aqui está sua senha: $corpo";

if ($botao == "Enviar") 
{
    if (smtmailer($email_rec, 'alvarocavalcanti5@hotmail.com', 'Alvaro Cavalcanti', 'Resposta do Contato', $Vai))
    {
        header('location:login.html');
    }
}
if(!empty($error)) echo $error;
?>