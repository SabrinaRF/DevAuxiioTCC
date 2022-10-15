<?php

    echo '<meta charset ="utf-8">';

    session_start();
	if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
		$usuario = $_SESSION["UsuarioNome"];
	} else {
		header("Location:../index.php");
	}
    include("../conecta.php");

    $id_prof = $_GET["id_prof"];
    

    $sql = "SELECT usuarios.nivel, usuarios.nome FROM `usuarios` WHERE `idusuarios` =\"$id_prof\" ";
    $resultado = mysqli_query($conexao,$sql);

    $linhasAfetadas = mysqli_affected_rows($conexao);

    if ($linhasAfetadas > 0) {
        $dados = mysqli_fetch_assoc($resultado);
    }

    $nivel_prof = $dados["nivel"];
    $nome = $dados["nome"];

    if ($nivel_prof == 1) {

        $sql2 = "SELECT usuarios.idusuarios, usuarios.nivel, usuarios.nome FROM `usuarios` WHERE `nivel` =\"2\" ";
        $resultado2 = mysqli_query($conexao,$sql2);
        $linhasAfetadas2 = mysqli_affected_rows($conexao);

        if ($linhasAfetadas2 > 0) {
            $dados2 = mysqli_fetch_assoc($resultado2);
            $id_antigo_coordenador =  $dados2["idusuarios"];
            // Antigo coordenador volta para o nível 1
            $sql3 ="UPDATE `usuarios` SET `nivel`=\"1\"  WHERE idusuarios = \"$id_antigo_coordenador \"";
            mysqli_query($conexao,$sql3);
            // Novo coordenado passa para o nível 2
            $sql4 ="UPDATE `usuarios` SET `nivel`=\"2\"  WHERE idusuarios = \"$id_prof\"";
            mysqli_query($conexao,$sql4);

            $_SESSION["alterado"] = "Coordenador alterado com sucesso!";
            header("Location:TrocarCoordenador.php");

        }else{

            $_SESSION["erro"] = "Erro ao editar o coordenador!";
            header("Location:TrocarCoordenador.php");
        }

    }else{
        
        $_SESSION["existe"] = "Este usuário já é coordenador!";
        header("Location:TrocarCoordenador.php");
    }

?>