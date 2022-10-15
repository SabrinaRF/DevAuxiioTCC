<?php

    echo '<meta charset="UTF-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
        $usuario = $_SESSION["UsuarioNome"];
    } else {
        header("Location:../index.php");
    }

    include("../conecta.php");

    $id = $_GET["id"];

    $sql = "DELETE FROM `cronograma` WHERE `idcronograma`= \"$id\"";
    mysqli_query($conexao,$sql);

    $linhasAfetadas = mysqli_affected_rows($conexao);

    if($linhasAfetadas > 0){
        $_SESSION['Sucesso'] ="Atividade excluída!";
        header("Location:CronogramaC.php");
    } else {
        $_SESSION['Erro'] ="Erro ao excluir a atividade";
        header("Location:CronogramaC.php");
    }

?>