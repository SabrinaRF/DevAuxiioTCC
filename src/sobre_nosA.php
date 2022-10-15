<?php

	session_start();
	if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 0 ) {
		$usuario = $_SESSION["UsuarioNome"];
	} else {
		header("Location:index.php");
	}

	include("conecta.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema de Auxílio à Orientação de TCC</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="../estilo_pagina.css">
</head>
<body >

	<!-- Barra de Navegação -->
	<header >
		<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light" >		
			<a class="navbar-brand" href="#">
				<img src="imagens/logotipopng.png" width="20" height="30" alt="Logo IFfar"> Sistema de Auxílio à Orientação de TCC
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link" href="Aluno/PaginaInicial_Aluno.php"> Início</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="Cronograma/CronogramaA.php">Cronograma</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="Documentos/DocumentosA.php">Documentos</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Outros</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="Aluno/banca_examinadora.php">Banca examinadora</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="Pagina_Proposta/forminserir.php">Proposta Inicial</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="Professor/Vaga_Orientar/tabela_vagas_A.php">Tabela: Vagas para orientação</a>
					</div>
				</li>

				</ul>
				
				
				<li class="navbar-nav nav-item dropdown ">
				<a class="nav-link dropdown-toggle active" href="#" id="dropConf" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Configurações<!--<img src="../imagens/config.png" width="30" height="30" alt="Logo IFfar"> li-> dropleft-->
				</a>
					<div class="dropdown-menu" aria-labelledby="dropConf">
							<a class="dropdown-item" href="Aluno/GerenPerfil_A.php">Perfil do usuário</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="sobre_nosA">Sobre</a>
					</div>
				</li>
				<a class="nav-link" href="Login/sair.php" >
					<button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="button">
						Sair
					</button>
				</a>

			</div>
		</nav>
    </header>


	<div class="container mt-5 pt-5" id="container-corpo">
		<h1 class="h3 mt-5 pl-2">
			Criação do sistema
			<small class="text-muted"></small>
			<br>
			<br>
		</h1>
		<div class="col-lg-11 md-10">
		<p class=" text-justify">Atualmente o Curso Técnico em Informática Integrado do Instituto Federal Farroupilha - Campus Avançado Uruguaiana 
		conta com um Trabalho de Conclusão de Curso (TCC), sendo obrigatório no currículo escolar. 
		O acompanhamento do TCC e o preenchimento dos formulários necessários são realizados pelo coordenador de TCC e pelo orientador(a) junto com orientando(a). </p>

		<p class=" text-justify">No momento presente todos os processos desde o início, até o término do Trabalho de Conclusão de Curso são realizados de forma manual, não tendo uma plataforma um site próprio para o trabalho. </p> 

		<p class=" text-justify">Pensando nisso, foi desenvolvido o Sistema de Auxílio à Orientação de TCC para auxiliar e facilitar o trabalho do orientando(a), do orientador(a), do coorientador e do coordenador de TCC. Assim esse sistema auxiliar os processos de modo que fiquem mais ordenados e acessíveis para as pessoas envolvidas. </p>
		</div>
	</div>


    	<!-- Containers Footer -->
	<div class="container mt-5 pt-5">
		<hr class="mb-4 ">
       
        <footer>
    	
		<div class="row mb-4">
            <div class="col lg-10 md-10 sm-10  text-center pt-3">
              
                  <p class="text-secondary">&copy; Copyright 2020 - Sistema de Auxílio à Orientação de TCC | Desenvolvido por Sabrina Rodrigues Fernandes</p>
            </div>
            <div class="lg-2 md-2 sm-2 text-right pt-3">
      
                  <a href="Aluno/PaginaInicial_Aluno.php">Voltar ao Início</a>
            </div>   
        </div>     
        </footer>
        
    </div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>