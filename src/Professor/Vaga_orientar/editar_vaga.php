<?php

    echo '<meta charset="UTF-8">';
    session_start();
    
    include("../../conecta.php");

    $id = $_POST["id"];
    $vagas= $_POST["vagas"];

    $sql = "UPDATE usuarios, professor SET professor.vagas = \"$vagas\"\n"
    . "WHERE usuarios.idusuarios = professor.idusuarios AND\n"
    . "professor.idusuarios = \"$id\"";

    mysqli_query($conexao,$sql);

    $linhasAfetadas = mysqli_affected_rows($conexao);

    if($linhasAfetadas > 0){
        $_SESSION["Sucesso"]= "Número de vagas editado com sucesso!";
        header("Location:formcadastrar_vaga.php");
    } else {
        $_SESSION["Erro"]= "Erro ao editar o número de vagas!";
        header("Location:formcadastrar_vaga.php");
    }
?>