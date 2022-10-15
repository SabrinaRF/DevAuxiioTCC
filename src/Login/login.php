<?php

	include("../conecta.php");

	session_start();


	if ((isset($_POST['user'])) && (isset($_POST['senha']))) {
		
		$user = mysqli_real_escape_string($conexao,$_POST["user"]);
		$senha = mysqli_real_escape_string($conexao,$_POST["senha"]);
		$senha = md5($senha);

		$sql ="SELECT * FROM `usuarios` WHERE user = \"$user\" AND senha = \"$senha\" LIMIT 1";

		$query = mysqli_query($conexao,$sql); 
		
		$linhasAfetadas = mysqli_affected_rows($conexao);

		if($linhasAfetadas > 0){
		    
			$resultado= mysqli_fetch_assoc($query);

			
			$_SESSION['IDusuario'] = $resultado['idusuarios'];
			$_SESSION['UsuarioNome'] = $resultado['user'];
            $_SESSION['UsuarioNivel'] = $resultado['nivel'];

             if ($_SESSION['UsuarioNivel'] == 0) {
				header("Location:../Aluno/PaginaInicial_Aluno.php");
				
			 } else if ($_SESSION['UsuarioNivel'] == 1) {
				header("Location:../Professor/PaginaInicial_Professor.php");

			 } else if ($_SESSION['UsuarioNivel'] == 2) {
                header("Location:../Coordenador/PaginaInicial_Coordenador.php");
             }	
		} else {
		
			$_SESSION['loginErro'] = "Usuário ou senha não encontrados!";
			header("Location:../index.php");
		} 
	} else{
		$_SESSION['loginErro'] = "Usuário ou senha inválido!";
		header("Location:../index.php");
	}
?>
