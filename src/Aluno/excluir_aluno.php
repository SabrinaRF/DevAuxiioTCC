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

    $sql = "DELETE usuarios.*, aluno.*, proposta.*,banca.* FROM usuarios, aluno, proposta, banca WHERE usuarios.`idusuarios` = aluno.`idusuarios` AND aluno.`idaluno` = proposta.`idaluno` AND proposta.`idproposta`=banca.`idproposta` AND usuarios.`idusuarios` = \"$id\"";
    mysqli_query($conexao,$sql);

    $linhasAfetadas = mysqli_affected_rows($conexao);

    if($linhasAfetadas > 0){
        $_SESSION['Sucesso'] ="Aluno excluído com sucesso!";
        header("Location:lista_alunos.php");
    } else {   
        $sql = "DELETE usuarios.*, aluno.*, proposta.* FROM usuarios, aluno, proposta WHERE usuarios.`idusuarios` = aluno.`idusuarios` AND aluno.`idaluno` = proposta.`idaluno` AND usuarios.`idusuarios` = \"$id\"";
        mysqli_query($conexao,$sql);

        $linhasAfetadas = mysqli_affected_rows($conexao);

        if($linhasAfetadas > 0){
            $_SESSION['Sucesso'] ="Aluno excluído com sucesso!";
            header("Location:lista_alunos.php");
        } else {

            $sql = "DELETE usuarios.*, aluno.* FROM usuarios, aluno WHERE usuarios.`idusuarios` = aluno.`idusuarios` AND usuarios.`idusuarios` = \"$id\"";
            mysqli_query($conexao,$sql);

            $linhasAfetadas = mysqli_affected_rows($conexao);

            if($linhasAfetadas > 0){
                $_SESSION['Sucesso'] = "Aluno excluído com sucesso!";
                header("Location:lista_alunos.php");
            } else {

                $_SESSION['Erro'] ="Erro ao excluir o aluno";
                header("Location:lista_alunos.php");
        
            }
        }
    }
?>