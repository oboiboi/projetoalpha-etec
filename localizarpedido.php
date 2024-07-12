<?php

$idProd = $_SESSION['idprod'];

include "conexao.php";

            try
            {
                $SelecaoContato = $conexao->prepare("SELECT * FROM produtos WHERE id_prod=?");
                $SelecaoContato->bindParam(1, $idProd);

                if ($SelecaoContato->execute())
                {
                    if ($SelecaoContato->rowCount() > 0)
                    {
                        while ($Linha = $SelecaoContato->fetch(PDO::FETCH_OBJ))
                        {
                            $id = $Linha->id_prod;
                            $_SESSION['idproduto'] = $id;

                            $descprod = $Linha->descricao_produto;
                            $_SESSION['descprod'] = $descprod;

                            $valorprod = $Linha->valor_produto;
                            $_SESSION['valorprod'] = $valorprod;

                            $formapgto = $Linha->forma_pgto;
                            $_SESSION['formapgto'] = $formapgto;

                            $condicao = $Linha->condicao_pgto;
                            $_SESSION['condicao'] = $condicao;

                            $parcela = $Linha->valor_parcela;
                            $_SESSION['parcela'] = $parcela;

                            $_SESSION['controle'] = "localizado";
                            header('location:gerenciar.php');
                        }
                    }
                }
            }

            catch (PDOException $erro)
            {
                echo "Erro" . $erro->getMessage();
            }


?>