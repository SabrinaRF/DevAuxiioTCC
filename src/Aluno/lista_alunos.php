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
					<li class="nav-item">
						<a class="nav-link" href="../Coordenador/PaginaInicial_Coordenador.php">Início</a>
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
					<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Outros</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="../Professor/lista_professores.php">Lista de professores</a>
							<a class="dropdown-item" href="../Professor/Vaga_Orientar/tabela_vagas_C.php">Tabela: Vagas para orientação</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="lista_alunos.php">Lista de alunos</a>
							<a class="dropdown-item" href="../Pagina_Proposta/visualizacao_proposta.php">Propostas dos alunos</a>
						</div>
					</li>
				</ul>
				
					<li class="navbar-nav nav-item dropdown ">
					<a class="nav-link dropdown-toggle" href="#" id="dropConf" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Configurações<!--<img src="../imagens/config.png" width="30" height="30" alt="Logo IFfar"> li-> dropleft-->
					</a>
						<div class="dropdown-menu" aria-labelledby="dropConf">
								<a class="dropdown-item" href="../Coordenador/GerenPerfil_C.php">Perfil do usuário</a>
								<div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../Coordenador/TrocarCoordenador.php">Trocar coordenador</a>
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

    <!-- Container do Corpo da Página (Cronograma/Manter) -->
    <div class="container mt-5 pt-5" id="container-corpo">
        <h1 class="h2 mt-5">
        Lista de alunos
        <br>
        <small class="text-muted">Todos os alunos que possuem cadastro.</small>
        </h1>
        <br>

        <!--     CÓDIGO EM PHP DO ALERTA    -->      
			<p> 
				<?php
				if ((isset($_SESSION['Sucesso']))) {
					echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
							'.$_SESSION['Sucesso'].'
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>';
					unset($_SESSION['Sucesso']);
                }
                if ((isset($_SESSION['editado']))) {
					echo'<div class="alert alert-warding alert-dismissible fade show" role="alert">
							'.$_SESSION['editado'].'
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>';
					unset($_SESSION['editado']);
                }

                if ((isset($_SESSION['Erro']))) {
					echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
							'.$_SESSION['Erro'].'
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>';
					unset($_SESSION['Erro']);
                }
                ?>
            </p>
    
        <?php
			$sql = "SELECT usuarios.idusuarios, usuarios.nome, usuarios.email, usuarios.cpf, aluno.matricula, aluno.idaluno "
					."FROM `usuarios`, `aluno` WHERE usuarios.`idusuarios` = aluno.`idusuarios`  ORDER BY `nome` ASC";
        
			$resultado = mysqli_query($conexao,$sql);
			$qtd = mysqli_num_rows($resultado);

			if($qtd == 0){
				echo '<p class="lead"> Ainda não existem alunos cadastrados no sistema. </p>';
			} else {
				echo '<p class="lead"> Há '.$qtd.' alunos cadastrados no sistema. </p>';

				echo '<table class="table table-striped table-bordered table-hover">';
				echo '<thead scope="col"> <tr class="table-secondary"> <th scope="col">#</th> '.' <th>NOME</th> '.' <th>EMAIL</th> '.'<th>CPF</th>'.'<th>MATRÍCULA</th> '.'<th>RELATÓRIO FINAL</th> <th>OPÇÃO</th> </tr> </thead>';
				$n= 1 ;
				while ($dados = mysqli_fetch_assoc($resultado)) { 
					
					echo '<tbody>';
					echo '<tr>';
					echo '<th scope="row">'.$n.'</th>';
					echo '<td>'. $dados['nome'] .'</td>';
					echo '<td>'. $dados['email'] .'</td>';
					echo '<td>'. $dados['cpf'] .'</td>';
					echo '<td>'. $dados['matricula'] .'</td>';

					$id_aluno=$dados["idaluno"];
					$sql1 = "SELECT banca.filenome FROM `aluno`,`banca`,`proposta` WHERE aluno.`idaluno`=proposta.idaluno AND proposta.idproposta=banca.idproposta AND aluno.`idaluno`=\"$id_aluno\"";
					$resultado1 = mysqli_query($conexao,$sql1);
					$dados1 = mysqli_fetch_assoc($resultado1);
					
					$existe = $dados1["filenome"];
						if (empty($existe)) {
							echo '<td>  </td>';
						}else{
							echo '<td class="text-center"><button type="button" class="btn btn-transparent  btn-sm bg-transparent ">
									<a href="download_relatorio.php?relatorio=relatorios/'.$dados1['filenome'].'">
										<img src="../imagens/download60.png" height="30" width="30"alt="Baixar">
									</a>
								</button></td>';
						} 
					echo '<td class="text-center ">
								<button type="button" class="btn btn-transparent btn-sm bg-transparent">'
								. '<a href="excluir_aluno.php?id='.$dados['idusuarios'].'">'
								. '<img src="../imagens/excluir25.png" class="text-center "height="24" width="24"alt="Excluir">'
								. '</a>'
								. '</button>'
							.'</td>';
					echo '</tr>';
					echo '<tbody>';
					$n++;
				}
				echo "</table>";
			}
        
        ?> 
    <br>
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
      
                  <a href="../Coordenador/PaginaInicial_Coordenador.php">Voltar ao Início</a>
            </div>   
        </div>     
        </footer>
        
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>