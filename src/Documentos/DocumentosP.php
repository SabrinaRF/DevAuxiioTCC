<?php

	session_start();
	if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 1 ) {
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
	<link rel="stylesheet" href="../Cronograma/estilo_cronograma.css">
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
				<li class="nav-item ">
					<a class="nav-link" href="../Professor/PaginaInicial_Professor.php">Início <span class="sr-only">(Página atual)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../Cronograma/CronogramaP.php">Cronograma</a>
				</li>

				<li class="nav-item active">
					<a class="nav-link" href="DocumentosP.php">Documentos</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Outros</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="../Professor/Vaga_orientar/formcadastrar_vaga.php">Vagas para orientação</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="../Professor/lista_orientando.php">Lista de orientandos</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="../Professor/lista_banca.php">Banca examinadora</a>
					</div>
				</li>
				</ul>		

					<li class=" navbar-nav nav-item dropdown ">
					<a class="nav-link dropdown-toggle" href="#" id="dropConf" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Configurações<!--<img src="../imagens/config.png" width="30" height="30" alt="Logo IFfar"> li-> dropleft-->
					</a>
						<div class="dropdown-menu" aria-labelledby="dropConf">
								<a class="dropdown-item" href="../Professor/GerenPerfil_P.php">Perfil do usuário</a>
								<div class="dropdown-divider"></div>
							    <a class="dropdown-item" href="../sobre_nosP.php">Sobre</a>
								
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
	
	<!-- Container do Corpo do Página (DOCUMENTOS) -->
	<div class="container" id="container-corpo">
        <div class="list-group list-group-flush">
            <h1>
            Documentos
            <small class="text-muted"><br>Formulários</small>
            </h1>
				<?php /////////          FORMULÁRIO              ///////////
					
					echo'<meta charset="UTF-8">';

					$sql = "SELECT * FROM `documento` WHERE `tipo`= \"formulário\" ORDER BY `nome` ASC";      
					$resultado = mysqli_query($conexao,$sql);

					while ($dados= mysqli_fetch_assoc($resultado)) {
						echo '<div class="row">';
						echo '<div class="col-lg-11 md-12 sm-12 ">';
							echo '<a href="" class="list-group-item list-group-item-action" >'.$dados['nome'].'</a>';
						echo '</div>';
						echo '<div class="col-lg-1 md-12 sm-12 ">';

							//        Botão para baixar
							
							echo '<button type="button" class="btn btn-transparent btn-sm bg-transparent">
									<a href="upload/download_arquivos.php?arquivo=arquivos/'.$dados['filenome'].'">
										<img src="../imagens/download60.png" class="rounded" height="30" width="30"alt="Baixar">
									</a>
								</button>';
							echo '</div>';
						echo '</div>';	
					}

				?> 
        </div>
        
        <div class="list-group list-group-flush">
            <h1>
            <small class="text-muted"><br>Regulamento</small>
            </h1>
				<?php /////////          REGULAMENTOS              ///////////
					
					echo'<meta charset="UTF-8">';

					$sql = "SELECT * FROM `documento` WHERE `tipo`= \"regulamento\" ORDER BY `nome` ASC";      
					$resultado = mysqli_query($conexao,$sql);

					while ($dados= mysqli_fetch_assoc($resultado)) {
						echo '<div class="row">';
						echo '<div class="col-lg-11 md-12 sm-12 ">';
							echo '<a href="" class="list-group-item list-group-item-action" >'.$dados['nome'].'</a>';
						echo '</div>';
						echo '<div class="col-lg-1 md-12 sm-12 ">';

							//        Botão para baixar
							
							echo '<button type="button" class="btn btn-transparent btn-sm bg-transparent">
									<a href="upload/download_arquivos.php?arquivo=arquivos/'.$dados['filenome'].'">
										<img src="../imagens/download60.png" class="rounded" height="30" width="30"alt="Baixar">
									</a>
								</button>';
							echo '</div>';
						echo '</div>';	
					}

				?> 
        </div>

        <div class="list-group list-group-flush">
            <h1>
            <small class="text-muted"><br>TCCs dos anos anteriores</small>
            </h1>
				<?php /////////          TCCs ANTIGOS              ///////////
					
					echo'<meta charset="UTF-8">';

					$sql = "SELECT * FROM `documento` WHERE `tipo`= \"TCCs Anteriores\" ORDER BY `nome` ASC";      
					$resultado = mysqli_query($conexao,$sql);

					while ($dados= mysqli_fetch_assoc($resultado)) {
						echo '<div class="row">';
						echo '<div class="col-lg-11 md-12 sm-12 ">';
							echo '<a href="" class="list-group-item list-group-item-action" >'.$dados['nome'].'</a>';
						echo '</div>';
						echo '<div class="col-lg-1 md-12 sm-12 ">';

							//        Botão para baixar
							
							echo '<button type="button" class="btn btn-transparent btn-sm bg-transparent">
									<a href="upload/download_arquivos.php?arquivo=arquivos/'.$dados['filenome'].'">
										<img src="../imagens/download60.png" class="rounded" height="30" width="30"alt="Baixar">
									</a>
								</button>';
							echo '</div>';
						echo '</div>';	
					}

				?> 
        </div>
    </div>	
    
    <!-- Containers Footer -->
	<div class="container mt-5 pt-5 ">
	<hr class="mb-4 ">
       
        <footer>
    	
		<div class="row mb-4">
            <div class="col lg-10 md-10 sm-10  text-center pt-3">
              
                  <p class="text-secondary">&copy; Copyright 2020 - Sistema de Auxílio à Orientação de TCC | Desenvolvido por Sabrina Rodrigues Fernandes</p>
            </div>
            <div class="lg-2 md-2 sm-2 text-right pt-3">
      
                  <a href="../Professor/PaginaInicial_Professor.php">Voltar ao Início</a>
            </div>   
        </div>   
        </footer>
        
    </div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>