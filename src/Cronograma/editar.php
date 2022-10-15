<?php

    echo '<meta charset="UTF-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
        $usuario = $_SESSION["UsuarioNome"];
    } else {
        header("Location:../index.php");
    }

    include("../conecta.php");

    $id = $_POST["id"];
    $atividade = $_POST["atividade"];
    $data= $_POST["data"];

    $sql = "UPDATE `cronograma` SET `atividade`=\"$atividade\", `data`=\"$data\"  WHERE `idcronograma`=\"$id\"";
    mysqli_query($conexao,$sql);

    $linhasAfetadas = mysqli_affected_rows($conexao);

    if($linhasAfetadas > 0){
    
        $_SESSION['editado'] = "Atividade editada!";    
        header("Location:CronogramaC.php");
    } else {
        $_SESSION['Erro'] = "Erro ao editar!";    
        header("Location:CronogramaC.php");
    }

    
?>