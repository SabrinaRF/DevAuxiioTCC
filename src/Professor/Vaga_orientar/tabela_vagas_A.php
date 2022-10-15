<?php

	session_start();
	if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 0 ) {
		$usuario = $_SESSION["UsuarioNome"];
	} else {
		header("Location:../../index.php");
	}
	include("../../conecta.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema de Auxílio à Orientação de TCC</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="../../Cronograma/estilo_cronograma.css">
</head>
<body>

	<!-- Barra de Navegação -->
	<header >
		<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">		
			<a class="navbar-brand" href="#">
				<img src="../../imagens/logotipopng.png" width="20" height="30" alt="Logo IFfar"> Sistema de Auxílio à Orientação de TCC
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link" href="../../Aluno/PaginaInicial_Aluno.php">Início <span class="sr-only">(Página atual)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../../Cronograma/CronogramaA.php">Cronograma</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../../Documentos/DocumentosA.php">Documentos</a>
				</li>

				<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Outros</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="../../Aluno/banca_examinadora.php">Banca examinadora</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="../../Pagina_Proposta/forminserir.php">Proposta Inicial</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="tabela_vagas_A.php">Tabela: Vagas para orientação</a>

						</div>
				</li>

				</ul>
				

				<li class="navbar-nav nav-item dropdown ">
				<a class="nav-link dropdown-toggle" href="#" id="dropConf" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Configurações<!--<img src="../imagens/config.png" width="30" height="30" alt="Logo IFfar"> li-> dropleft-->
				</a>
					<div class="dropdown-menu" aria-labelledby="dropConf">
							<a class="dropdown-item" href="../../Aluno/GerenPerfil_A.php">Perfil do usuário</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="../../sobre_nosA">Sobre</a>
					</div>
				</li>
				<a class="nav-link" href="../../Login/sair.php" >
					<button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="button">
						Sair
					</button>
				</a>
			</div>
		</nav>
    </header>

    <!-- Container do Corpo da Página -->
    <div class="container" id="container-corpo">
		<h1>
		Tabela de vagas para orientação
		<br><small class="text-muted">Professores que não constam nesta tabela devem ser consultados para possível orientação.</small>
		</h1>
		<br>

        <?php
            $sql = "SELECT  usuarios.idusuarios, usuarios.nome, usuarios.imgnome, professor.vagas FROM usuarios, professor \n"
					. "WHERE usuarios.idusuarios = professor.idusuarios";

            $resultado = mysqli_query($conexao,$sql);

            echo '<table class="table  table-striped table-bordered table-hover">';
            echo '<thead scope="col"> <tr class="table-secondary"> <th scope="col"></th> '.' <th>NOME DO PROFESSOR</th> '.'<th>Nº DE VAGAS</th> </tr> </thead>';
            
            while ($dados = mysqli_fetch_assoc($resultado)) {
                echo '<tbody>';
                echo '<tr>';
                echo '<th scope="row" class="text-center">'.'<img src="../arquivos_img/'.$dados['imgnome'].'"  class="rounded-circle " height="35" width="35">'.'</th>';
                echo '<td>'. $dados['nome'] .'</td>';
                echo '<td>'. $dados['vagas'] .'</td>';
                echo '</tr>';
                echo '<tbody>';
                
            }
            echo "</table>";
        
        ?>        

    </div>   
   
    <!-- Containers Footer -->
	<div class="container">
	<hr class="mb-4 ">
       
        <footer>
    	
		<div class="row mb-4">
            <div class="col lg-10 md-10 sm-10  text-center pt-3">
              
                  <p class="text-secondary">&copy; Copyright 2020 - Sistema de Auxílio à Orientação de TCC | Desenvolvido por Sabrina Rodrigues Fernandes</p>
            </div>
            <div class="lg-2 md-2 sm-2 text-right pt-3">
      
                  <a href="../../Aluno/PaginaInicial_Aluno.php">Voltar ao Início</a>
            </div>   
        </div>       
        </footer>
        
    </div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
