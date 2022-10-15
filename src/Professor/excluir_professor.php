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

    $sql = "DELETE usuarios.*, professor.* FROM usuarios, professor WHERE usuarios.`idusuarios` = professor.`idusuarios` AND usuarios.`idusuarios` = \"$id\"";
    mysqli_query($conexao,$sql);

    $linhasAfetadas = mysqli_affected_rows($conexao);

    if($linhasAfetadas > 0){
        $_SESSION['Sucesso'] ="Professor excluído com sucesso!";
        header("Location:lista_professores.php");
    } else {

        $_SESSION['Erro'] ="Erro ao excluir o professor!";
        header("Location:lista_professores.php");
    
    }

?>