<?php

	session_start();
	if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
		$usuario = $_SESSION["UsuarioNome"];
	} else {
		header("Location:../index.php");
	}
	include("../conecta.php");

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
<body>
	<!-- Barra de Navegação -->
	<header >
		<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">		
			<a class="navbar-brand" href="#">
				<img src="../imagens/logotipopng.png" width="20" height="30" alt="Logo IFfar"> Sistema de Auxílio à Orientação de TCC
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="PaginaInicial_Coordenador.php">Início</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../Cronograma/CronogramaC.php">Cronograma</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Cadastro</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="../Professor/formcadastrar.php">Professor(a)</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../Documentos/DocumentosC.php">Documentos</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Outros</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="../Professor/lista_professores.php">Lista de professores</a>
							<a class="dropdown-item" href="../Professor/Vaga_Orientar/tabela_vagas_C.php">Tabela: Vagas para orientação</a>			
							<div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../Aluno/lista_alunos.php">Lista de alunos</a>
							<a class="dropdown-item" href="../Pagina_Proposta/visualizacao_proposta.php">Propostas dos alunos</a>
						</div>
					</li>
				</ul>

					<li class="navbar-nav nav-item dropdown ">
					<a class="nav-link dropdown-toggle" href="#" id="dropConf" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Configurações<!--<img src="../imagens/config.png" width="30" height="30" alt="Logo IFfar"> li-> dropleft-->
					</a>
						<div class="dropdown-menu" aria-labelledby="dropConf">
								<a class="dropdown-item" href="GerenPerfil_C.php">Perfil do usuário</a>
								<div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="TrocarCoordenador.php">Trocar coordenador</a>
								<div class="dropdown-divider"></div>
							    <a class="dropdown-item" href="../sobre_nosC.php">Sobre</a>
						</div>
					</li>
                    <a class="nav-link" href="../Login/sair.php" >
						<button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="button">
							Sair
						</button>
					</a>
			</div>
		</nav>
    </header>

	<!-- Carousel -->
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img class="d-block w-100" src="../imagens/carosel1.png" alt="Primeiro Slide" >
	    </div>
	    <div class="carousel-item">
		  <img class="d-block w-100" src="../imagens/carosel2.png" alt="Segundo Slide" >
		  <div class="container ">
				<div class="carousel-caption text-left text-muted my-2 mb-5">
					<h1>Cadastro dos professores</h1>
					<p>Formulário para cadastrar professores.</p>
					<p><a class="btn btn-lg btn-primary" href="../Professor/formcadastrar.php" role="button">Acesse</a></p>
				</div>
            </div>
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="../imagens/carosel3.png" alt="Terceiro Slide" >
	    </div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Anterior</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Próximo</span>
	  </a>
	</div>

	<!-- Container do Corpo do Página -->
	<div class="container" id="container-corpo">
		<div class="row mb-2"> 
			<div class="col-md-6">
				<div class="card flex-md-row mb-4 shadow-sm h-md-250">
					<div class="card-body d-flex flex-column align-items-start">
					<strong class="d-inline-block mb-2 text-primary">Cronograma</strong>
					<h3 class="mb-0">
						<a class="text-dark" href="#">Atividades e prazos</a>
					</h3>
					<br>
					<p class="card-text mb-auto">Confira o cronograma para gerenciar as atividades e prazos do TCC.</p><br>
					<a href="../Cronograma/CronogramaC.php"><button type="button" class="btn btn-outline-primary  ">
                    Acessar
                  </button></a>
					</div>
					<img class="card-img-right flex-auto d-none d-lg-block" src="../imagens/calendario.png" alt="Card image cap">
				</div>
			</div>
			<div class="col-md-6">
				<div class="card flex-md-row mb-4 shadow-sm h-md-250">
					<div class="card-body d-flex flex-column align-items-start">
					<strong class="d-inline-block mb-2 text-success">Documentos</strong>
					<h3 class="mb-0">
						<a class="text-dark" href="#">Anexos</a>
					</h3>
					<br>
					<p class="card-text mb-auto">Acesse os documentos para gerenciar os formulários, anexos, regulamento e TCCs dos anos anteriores.</p><br>
					<a href="../Documentos/DocumentosC.php"><button type="button" class="btn btn-outline-success ">
                    Acessar
                  </button></a>
					</div>
					<img class="card-img-right flex-auto d-none d-lg-block" src="../imagens/documento.png" alt="Card image cap">
				</div>
			</div>
		</div>
	</div>

	<div class="container" >
		<div class="row"> 
			<div class="col">
			<div class="card flex-md-row  shadow-sm h-md-250">
				<div class="col-4">
					<div class="text-center">
						<img src="../imagens/grupo.png" wight="96" height="96"alt="Card image cap">
					</div>
					<div class="card-body d-flex flex-column align-items-start">
						
						<strong class="d-inline-block mb-2 text-primary"></strong>
						<h1 class="mb-0 h4">
							<a class="text-center" >Lista dos Alunos</a>
						</h1>
						<br>
						<p class="card-text mb-auto">Acesse a lista dos alunos cadastrados no sistema.</p><br>
						<a href="../Aluno/lista_alunos.php" class="btn btn-outline-info btn-block" role="button">
								Acessar
						</a>
					</div>	
				</div>
				<div class="col-4">
					<div class="text-center">
						<img src="../imagens/grupo.png" wight="96" height="96"alt="Card image cap">
					</div>
					<div class="card-body d-flex flex-column align-items-start">
						
						<strong class="d-inline-block mb-2 text-primary"></strong>
						<h1 class="mb-0 h4">
							<a class="text-center" >Lista dos Professores</a>
						</h1>
						<br>
						<p class="card-text mb-auto">Acesse a lista dos professores cadastrados no sistema.</p><br>
						<a href="../Professor/lista_professores.php" class="btn btn-outline-info btn-block" role="button">
								Acessar
						</a>
					</div>
				</div>
				<div class="col-4">
					<div class="text-center">
						<img src="../imagens/grupo.png" wight="96" height="96"alt="Card image cap">
					</div>
					<div class="card-body d-flex flex-column align-items-start">
						
						<strong class="d-inline-block mb-2 text-primary"></strong>
						<h1 class="mb-0 h4">
							<a class="text-center" >Lista das propostas</a>
						</h1>
						<br>
						<p class="card-text mb-auto">Acesse a lista das propostas cadastradas no sistema.</p><br>
						<a href="../Pagina_Proposta/visualizacao_proposta.php" class="btn btn-outline-info btn-block" role="button">
								Acessar
						</a>
					</div>	
				</div>
				
			</div>
			</div>
		</div>
	</div>

	<!-- Containers Footer -->
	<div class="container">
	<hr class="mb-4 mt-5">
       
        <footer>
    	
		<div class="row mb-4">
            <div class="col lg-10 md-10 sm-10  text-center pt-3">
              
                  <p class="text-secondary">&copy; Copyright 2020 - Sistema de Auxílio à Orientação de TCC | Desenvolvido por Sabrina Rodrigues Fernandes</p>
            </div>
            <div class="lg-2 md-2 sm-2 text-right pt-3">
      
                  <a href="PaginaInicial_Coordenador.php">Voltar ao Início</a>
            </div>   
        </div>     
        </footer>
        
    </div>
    


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>