<?php

	session_start();
	if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
		$usuario = $_SESSION["UsuarioNome"];
	} else {
		header("Location:../index.php");
	}
    include("../conecta.php");

    $sql = "SELECT usuarios.nome FROM `usuarios` WHERE nivel= \"2\"";
    $resultado = mysqli_query($conexao,$sql);
    $dado= mysqli_fetch_assoc($resultado);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema de Auxílio à Orientação de TCC</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="../estilo_pagina.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
					<a class="nav-link dropdown-toggle active" href="#" id="dropConf" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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


    <!--                               Containers corpo                               -->
    <div class="container pt-4" id="container-corpo">
		<div class="col-12 order-md-1 mt-5 bg-light border border-secondary" style="border-radius:10px;">
			<div class="row pt-2">
                <div class="col-12">
				<h1 class="mb-3 mt-4 ml-3 text-dark text-center">
				<p class="h3">Troca de Coordenador</p>
				<small class="text-muted"></small>
				</h1>
                </div>		
			</div>
            <div class="row pt-2">
                <div class="col-11 mt-5 pl-5 "> 
					<div class="row">
						<div class="col-9">
							<p><strong>Atual Coordenador: </strong><?php echo $dado["nome"];?></p>
						<br>
						</div>
                    </div>
                </div>
            </div>
            <!-- CÓDIGO EM PHP DO ALERTA --> 
			<?php
                      if ((isset($_SESSION['erro']))) {
                        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              '.$_SESSION['erro'].'
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                          unset($_SESSION['erro']);
                      }

                      if ((isset($_SESSION['alterado']))) {
                        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                              '.$_SESSION['alterado'].'
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                          unset($_SESSION['alterado']);
                      }
                      if ((isset($_SESSION['existe']))) {
                        echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              '.$_SESSION['existe'].'
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                          unset($_SESSION['existe']);
                      }
            ?>
            <!--------------------------------------------------------------------------------------------------------->
            <div class="row pl-3 pr-3">
                <div class="col-12">
                <?php
                    $sql = "SELECT usuarios.idusuarios, usuarios.nome, usuarios.cpf, usuarios.nivel, professor.area_atuante1, professor.area_atuante2, professor.area_atuante3 FROM `usuarios`, `professor` WHERE usuarios.idusuarios = professor.idusuarios ORDER BY `nome` ASC";       
                
                    $resultado = mysqli_query($conexao,$sql);

                    echo '<table class="table table-striped table-bordered table-hover ">';
                    echo '<thead scope="col"> <tr class="table-secondary"> <th scope="col">#</th> '.' <th>NOME DO PROFESSOR(A)</th> '.'<th>CPF</th> '.'<th>ÁREA ATUANTE</th> '.'<th>ACESSO</th>  <th> </th> </tr> </thead>';
                    $n= 1 ;
                    while ($dados = mysqli_fetch_assoc($resultado)) { 
                        
                        $id_prof = $dados["idusuarios"];
                        
                        if ($dados["nivel"] == 1) {
                            $acesso= "Professor";
                        }else {
                            $acesso= "Coordenador";
                        }
                                
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<th scope="row">'.$n.'</th>';
                        echo '<td>'. $dados['nome'] .'</td>';
                        echo '<td>'. $dados['cpf'] .'</td>';
                        if (empty($dados['area_atuante3']) and empty($dados['area_atuante2'])) {
                            echo '<td>1. '. $dados['area_atuante1'] .'<br></td>';
                        
                        }else if (empty($dados['area_atuante3'])) {
                            echo '<td>1. '. $dados['area_atuante1'] .'<br>
                                      2. '. $dados['area_atuante2'] .'<br></td>';
                        }else{
                            echo '<td>1. '. $dados['area_atuante1'] .'<br>
                                      2. '. $dados['area_atuante2'] .'<br>
                                      3. '. $dados['area_atuante3'] .'</td>';
                        }		
                        
                        echo '<td>'. $acesso .'</td>';
                        echo '<td id="op"> 
                                        <a href="TrocarCoor.php?id_prof='.$id_prof.'">
                                            <button type="button" class="btn btn-outline-dark  btn-sm " >
                                                Alterar
                                            </button>
                                        </a>
                              </td>';
                        echo '</tr>';
                        echo '<tbody>';
                        $n++;
                        }
                    echo "</table>";
                
                ?>
                </div>
            </div>
        </div>
    </div>
    

     <!-- Containers Footer -->
	<div class="container mt-5">
	    <hr class="mb-4 ">
       
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
    

</body>
</html>