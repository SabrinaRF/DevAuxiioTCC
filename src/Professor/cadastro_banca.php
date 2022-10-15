<?php

    echo '<meta charset="UTF-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 1 ) {
        $usuario = $_SESSION["UsuarioNome"];
    } else {
        header("Location:../index.php");
    }

    include("../conecta.php");

    $siape=$_POST["siape"];
    $nome_aluno=$_POST["aluno"];
    $examinador1=$_POST["examinador1"];
    $examinador2=$_POST["examinador2"];
    $examinador3=$_POST["examinador3"];

    $sql="SELECT proposta.idproposta FROM `proposta`,`aluno`, `usuarios` WHERE usuarios.idusuarios = aluno.idusuarios "
        ."AND aluno.idaluno=proposta.idaluno AND usuarios.nome = \"$nome_aluno\"";
    $resultado=mysqli_query($conexao,$sql);
    $dados=mysqli_fetch_assoc($resultado);
    $id_prop = $dados["idproposta"];

    $sql="SELECT professor.idprofessor FROM `professor`, `usuarios` WHERE usuarios.idusuarios = professor.idusuarios "
        ."AND usuarios.nome =  \"$examinador1\"";
    $resultado=mysqli_query($conexao,$sql);
    $dados=mysqli_fetch_assoc($resultado);
    $id_examinador1 = $dados["idprofessor"];

    $sql="SELECT professor.idprofessor FROM `professor`, `usuarios` WHERE usuarios.idusuarios = professor.idusuarios "
        ."AND usuarios.nome =  \"$examinador2\"";
    $resultado=mysqli_query($conexao,$sql);
    $dados=mysqli_fetch_assoc($resultado);
    $id_examinador2 = $dados["idprofessor"];

    $sql="SELECT professor.idprofessor FROM `professor`, `usuarios` WHERE usuarios.idusuarios = professor.idusuarios "
        ."AND usuarios.nome =  \"$examinador3\"";
    $resultado=mysqli_query($conexao,$sql);
    $dados=mysqli_fetch_assoc($resultado);
    $id_examinador3 = $dados["idprofessor"];


    // "$siape <br> $id_prop <br> $id_examinador1<br> $id_examinador2 <br> $id_examinador3";

    $sql="INSERT INTO `banca` (`siape`,`examinador1`,`examinador2`,`examinador3`,`suplente`,`filenome`,`idproposta`) VALUES (\"$siape\",\"$id_examinador1\",\"$id_examinador2\",\"$id_examinador3\",\"$id_examinador3\",\"\",\"$id_prop\")";
    mysqli_query($conexao,$sql);

    $linhasAfetadas=mysqli_affected_rows($conexao);

    if ($linhasAfetadas > 0) {
        $_SESSION["cadastrado"]="Banca examinadora cadastrada com sucesso!";
        header("Location:lista_orientando.php");
    } else {
        $_SESSION["erro"]="Erro ao cadastrar a banca examinadora!";
        header("Location:lista_orientando.php");
        
    }
    


?>
