<?php

	session_start();
	if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 1 ) {
        $usuario = $_SESSION["UsuarioNome"];
        $id_usu = $_SESSION["IDusuario"];
	} else {
		header("Location:../index.php");
    }

    include("../conecta.php");

    $sql="SELECT `idprofessor` FROM professor WHERE idusuarios=\"$id_usu\"";
    $resu=mysqli_query($conexao,$sql);
    $dados=mysqli_fetch_assoc($resu);
    $id_prof= $dados["idprofessor"];


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
					<a class="nav-link" href="PaginaInicial_Professor.php">Início </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../Cronograma/CronogramaP.php">Cronograma</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="../Documentos/DocumentosP.php">Documentos</a>
				</li>
				<li class="nav-item dropdown active">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Outros</a>
					<div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="Vaga_orientar/formcadastrar_vaga.php">Vagas para orientação</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="lista_orientando.php">Lista de orientandos</a>
                        <div class="dropdown-divider"></div>
						<a class="dropdown-item" href="lista_banca.php">Banca examinadora</a>
					</div>
				</li>
				</ul>
                <li class=" navbar-nav nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="dropConf" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Configurações<!--<img src="../imagens/config.png" width="30" height="30" alt="Logo IFfar"> li-> dropleft-->
                </a>
                    <div class="dropdown-menu" aria-labelledby="dropConf">
                            <a class="dropdown-item" href="GerenPerfil_P.php">Perfil do usuário</a>
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

    <!-- Container do Corpo do Página (Aluno) -->
    <div class="container  pt-5 mt-5" >
        <h1 class="mt-5 pt-2">
        Orientandos
        <small class="text-muted"><br>Tabela com todos os orientandos</small>
        </h1>
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

                if ((isset($_SESSION['cadastrado']))) {
                    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                        '.$_SESSION['cadastrado'].'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    unset($_SESSION['cadastrado']);
                }
            ?>
        <!--------------------------------------------------------------------------------------------------------->

        <?php
            $sql = "SELECT usuarios.nome, proposta.proposta, proposta.idproposta FROM proposta,usuarios,aluno "
                ."WHERE usuarios.idusuarios = aluno.idusuarios AND aluno.idaluno=proposta.idaluno AND proposta.orientador_def= \"$id_prof\""
                . "ORDER BY  usuarios.nome ASC";
            $resultado = mysqli_query($conexao,$sql);
            $qtd = mysqli_num_rows($resultado);

			if($qtd == 0){
				echo '<p class="lead"> Ainda não existem orientandos cadastrados no sistema. </p>';
			} else {

                echo '<table class="table table-striped table-bordered table-hover ">';
                echo '<thead scope="col"> <tr class="table-secondary"> <th scope="col">#</th> '.' <th>NOME DO ALUNO</th> '.'<th>PROPOSTA</th>'.'<th>RELATÓRIO FINAL</th> </tr> </thead>';
                $n= 1 ;
                while ($dados = mysqli_fetch_assoc($resultado)) {
                    
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<th scope="row">'.$n.'</th>';
                    echo '<td>'. $dados['nome'] .'</td>';
                    echo '<td>'. $dados['proposta'] .'</td>'; 
                    $id_prop=$dados['idproposta'];
                    $sql1= "SELECT banca.filenome FROM banca WHERE banca.idproposta=\"$id_prop\""; 
                    $resultado1 = mysqli_query($conexao,$sql1);
                    $dados1 = mysqli_fetch_assoc($resultado1);
                    $existe = $dados1["filenome"];
						if (empty($existe)) {
							echo '<td>  </td>';
						}else{
							echo '<td class="text-center"><button type="button" class="btn btn-transparent  btn-sm bg-transparent ">
									<a href="../Aluno/download_relatorio.php?relatorio=relatorios/'.$dados1['filenome'].'">
										<img src="../imagens/download60.png" height="30" width="30"alt="Baixar">
									</a>
								</button></td>';
						} 
                    echo '</tr>';
                    echo '<tbody>';
                    $n++;
                }
                echo "</table>";
            
                echo '<button type="button" class="btn btn-info  " data-toggle="modal" data-target="#modalCadastro">
                         Cadastrar banca examinadora
                     </button>';
            }   

        ?>

        
    </div>

    <!--  Modal Editar -->  

            <div class="modal fade bd-example-modal-lg" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulário de indicação de banca examinadora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form enctype="multipart/form-data" action="cadastro_banca.php" method="post">     
                            <div class="mb-3">
                                <label for="siape">SIAPE:</label>
                                <input type="number" class="form-control" id="siape" name="siape" required>  
                                <div class="invalid-feedback" >
                                Por favor, insira uma opção.
                                </div>
                            </div>
                
                            <div class="mb-3">
                                <label for="aluno">Nome do aluno:</label>
                                <select class="form-control" id="aluno" name="aluno" required>
                                    <?php
                                        $sql = "SELECT usuarios.nome, proposta.proposta FROM proposta,usuarios,aluno "
                                        ."WHERE usuarios.idusuarios = aluno.idusuarios AND aluno.idaluno=proposta.idaluno AND proposta.orientador_def= \"$id_prof\""
                                        . "ORDER BY  usuarios.nome ASC";
                                        $resultado = mysqli_query($conexao,$sql);
                                        while ($dados = mysqli_fetch_assoc($resultado)) {
                                            
                                            echo '<option>'.$dados['nome'].'</option>';   
                                            
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">Por favor, insira um(a) professor(a).</div>
                            </div>

                            <div class="mb-3">
                                <label for="examinador1">Examinador 1: </label>
                                <?php
                                    $sql = "SELECT  usuarios.idusuarios, usuarios.nome  FROM usuarios, professor \n"
                                        . "WHERE usuarios.idusuarios = professor.idusuarios ORDER BY `nome` ASC";
                        
                                    $resultado = mysqli_query($conexao,$sql);
                        
                                    echo '<select class="form-control" id="examinador1" name="examinador1" required>';

                                    while ($dados = mysqli_fetch_assoc($resultado)) {
                                        
                                        echo '<option>'.$dados['nome'].'</option>';   
                                        
                                    }
                                    echo '</select>';
                                    echo '<div class="invalid-feedback">Por favor, insira um(a) professor(a).';
                                    echo '</div>';
                                ?>

                            </div>
                                  
                            <div class="mb-3">
                                <label for="examinador2">Examinador 2:</label>
                                <?php
                                    $sql = "SELECT  usuarios.idusuarios, usuarios.nome  FROM usuarios, professor \n"
                                        . "WHERE usuarios.idusuarios = professor.idusuarios ORDER BY `nome` ASC";
                        
                                    $resultado = mysqli_query($conexao,$sql);
                        
                                    echo '<select class="form-control" id="examinador2" name="examinador2" required>';

                                    while ($dados = mysqli_fetch_assoc($resultado)) {
                                        
                                        echo '<option>'.$dados['nome'].'</option>';   
                                        
                                    }
                                    echo '</select>';
                                    echo '<div class="invalid-feedback">Por favor, insira um(a) professor(a).';
                                    echo '</div>';
                                ?>
                            </div> 

                            <div class="mb-3">
                                <label for="examinador3">Examinador 3 (Suplente):</label>
                                <?php
                                    $sql = "SELECT  usuarios.idusuarios, usuarios.nome  FROM usuarios, professor \n"
                                        . "WHERE usuarios.idusuarios = professor.idusuarios ORDER BY `nome` ASC";
                        
                                    $resultado = mysqli_query($conexao,$sql);
                        
                                    echo '<select class="form-control" id="examinador3" name="examinador3" required>';

                                    while ($dados = mysqli_fetch_assoc($resultado)) {
                                        
                                        echo '<option>'.$dados['nome'].'</option>';   
                                        
                                    }
                                    echo '</select>';
                                    echo '<div class="invalid-feedback">Por favor, insira um(a) professor(a).';
                                    echo '</div>';
                                ?>
                            </div>
                            
                
                            
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success">Cadastrar</button>
                </form></div>
                </div>
            </div>
            </div>


	<!-- Containers Footer -->
	<div class="container mt-5 pt-5 ">
	    <hr class="mb-4 ">
       
        <footer >
    	
		<div class="row mb-4">
            <div class="col lg-10 md-10 sm-10  text-center pt-3">
              
                  <p class="text-secondary">&copy; Copyright 2020 - Sistema de Auxílio à Orientação de TCC | Desenvolvido por Sabrina Rodrigues Fernandes</p>
            </div>
            <div class="lg-2 md-2 sm-2 text-right pt-3">
      
                  <a href="Professor/PaginaInicial_Professor.php">Voltar ao Início</a>
            </div>   
        </div>    
        </footer>
        
    </div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>