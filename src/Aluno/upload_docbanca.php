<?php

include("../conecta.php");
session_start();
$pasta = "relatorios/";

$caminho = $pasta . basename($_FILES["arquivo"]["name"]);
$uploadOk = 1;
$extencao = strtolower(pathinfo($caminho,PATHINFO_EXTENSION));


  
    $id_proposta= $_POST["id_proposta"];
    $filenome = $_FILES["arquivo"]["name"];

    $sql="SELECT `filenome` FROM `banca` WHARE `idproposta`=\"$id_proposta\"";
    $resultado=mysqli_query($conexao,$sql);
    $dados=mysqli_fetch_assoc($resultado);
    $existe=$dados["filenome"];

    if (isset($existe)) {
        $_SESSION['ErroDados'] = "Desculpe, é permitido somente um envio do relatóro!";
        header("Location:docbanca.php");

    }else{
        if ($_FILES["arquivo"]["size"] > 10485760) {
            $uploadOk = 0;

        }
        if ($extencao != "pdf" ) {
            $uploadOk = 0;

        }
        if ($uploadOk == 0) {
            $_SESSION['ErroDados'] = "Verifique a extensão (PDF) ou tamanho do arquivo (máx. 10MB).";
            header("Location:docbanca.php");

        }else{
            if (move_uploaded_file($_FILES["arquivo"]["tmp_name"],$caminho)) {

            $sql= "UPDATE `banca` SET `filenome`=\"$filenome\" WHERE `idproposta`=\"$id_proposta\"";
            mysqli_query($conexao,$sql);
                    
            $linhasAfetadas = mysqli_affected_rows($conexao);
            
            if($linhasAfetadas > 0){
                $_SESSION['Sucesso'] = "O relatório fez upload.";;
                header("Location:docbanca.php");
            }else{
                $_SESSION['ErroDados'] = "Erro nenhuma linha afetada";
                header("Location:docbanca.php");
            }

            } else {
            $_SESSION['ErroDados'] = "Erro ao mover o arquivo.";
            header("Location:docbanca.php");
            }
        }
    }

?>