<?php
    
    echo '<meta charset="utf8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
        $usuario = $_SESSION["UsuarioNome"];
    } else {
        header("Location:../index.php");
    }

    include("../conecta.php");

    $caixa1 = $_POST['caixa0'];
    $caixa2 =$_POST['caixa0-1'];

    if ((empty($caixa1)) or (empty($caixa2))) {
        
        $_SESSION['Erro'] = "Dados inálidos";
        header("Location:CronogramaC.php");

    } else {

        $sql ="INSERT INTO `cronograma`( `atividade`, `data`) VALUES (\"$caixa1\",\"$caixa2\")";
        mysqli_query($conexao,$sql);

        $linhasAfetadas= mysqli_affected_rows($conexao);

        if ($linhasAfetadas > 0 ) {

            $_SESSION['Sucesso'] = "Atividade adicionada!";
            header("Location:CronogramaC.php");
        } else {
            
            $_SESSION['Erro'] = "Dados inálidos!";
            header("Location:CronogramaC.php");
        }
        
    }

?>