<?php

    echo '<meta charset ="utf-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
        $usuario = $_SESSION["UsuarioNome"];
    } else {
        header("Location:../index.php");
    }
    include("../conecta.php");

    $nome_prof = $_POST["ori_def"];
    $id_aluno = $_POST["id_aluno"];

    $sql= "SELECT professor.idprofessor FROM usuarios, professor WHERE usuarios.idusuarios=professor.idusuarios AND usuarios.nome=\"$nome_prof\"";
    $resultado = mysqli_query($conexao,$sql);
    $dados= mysqli_fetch_assoc($resultado);
    $id_professor = $dados['idprofessor'];

    $sql="UPDATE `proposta`SET `orientador_def`= \"$id_professor\" WHERE `idaluno`=\"$id_aluno\"";
    $resultado = mysqli_query($conexao,$sql);

    $linhas_afetadas= mysqli_affected_rows($conexao);

    if ($linhas_afetadas > 0) {
        $_SESSION["cadastrado"] = "Orientador alterado com sucesso!";
        header("Location:visualizacao_proposta.php");
    }else {
        $_SESSION["erro"] = "Erro ao alterar o orientador!";
        header("Location:visualizacao_proposta.php");  
    }
?>