
<?php 
  session_start();
  // Recuperar dados da sessão
  $valorTotal = $_SESSION['valor'];
  $formaPagamento = $_POST['pagamento'];
  $_SESSION['pgto'] = $formaPagamento;
  
  // Calcular valor por parcela
  if ($formaPagamento === "pix") 
  {
    $valorParcela = $valorTotal; // Pix: pagamento à vista
  } 
  else 
  {   
    $parcelas = $_POST['parcelas'];
    $_SESSION['parcelas_'] = $parcelas;
    $valorParcela = $valorTotal / $parcelas;
  }

  // Formatar valores para exibição
  $valorTotalFormatado = number_format($valorTotal, 2, ',', '.');
  $valorParcelaFormatado = number_format($valorParcela, 2, ',', '.');

  $_SESSION['ValorFinal'] = $valorParcelaFormatado;
  header('location:pedido.php'); 

?>