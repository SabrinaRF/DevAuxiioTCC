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
                    <li class="nav-item ">
                        <a class="nav-link" href="../Coordenador/PaginaInicial_Coordenador.php">Início <span class="sr-only">(Página atual)</span></a>
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
                                <a class="dropdown-item" href="../Aluno/lista_alunos.php">Lista de alunos</a>
                                <a class="dropdown-item" href="visualizacao_proposta.php"> Propostas dos alunos</a>
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

    <!-- Container do Corpo do Página (Aluno) -->
    <div class="container-fluid pl-5 pr-5" id="container-corpo">
    
        <h1>
        Propostas iniciais dos alunos
        <small class="text-muted"> </small>
        </h1><br>
        <!--     CÓDIGO EM PHP DO ALERTA    -->      
        <p> 
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
              </p>
      <!------------------------------------------------------------------------------------------->
    
        <?php
            $sql = "SELECT aluno.idaluno, usuarios.nome, proposta.proposta, proposta.orientador1, proposta.orientador2, proposta.orientador3, proposta.orientador_def \n"

            . "FROM proposta, usuarios, aluno \n"
        
            . "WHERE usuarios.idusuarios = aluno.idusuarios AND aluno.idaluno = proposta.idaluno \n"
        
            . "ORDER BY  usuarios.nome ASC";
            $resultado = mysqli_query($conexao,$sql);
            $qtd = mysqli_num_rows($resultado);

			if($qtd == 0){
				echo '<p class="lead"> Ainda não existem propostas cadastrados no sistema. </p>';
			} else {
				echo '<p class="lead"> Há '.$qtd.' propostas cadastrados no sistema. </p>';

                echo '<table class="table table-striped table-bordered table-hover ">';
                echo '<thead scope="col"> <tr class="table-secondary"> <th scope="col">#</th> '.' <th>NOME DO ALUNO</th> '.'<th>PROPOSTA</th>  <th scope="col" colspan="3">ORIENTADORES </th> '.'<th>ORIENTADOR DEFINIDO</th></tr> </thead>';
                $n= 1 ;
                while ($dados = mysqli_fetch_assoc($resultado)) {
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<th scope="row">'.$n.'</th>';
                    echo '<td>'. $dados['nome'] .'</td>';
                    echo '<td>'. $dados['proposta'] .'</td>';
                    echo '<td id="op"> 1 - '.$dados['orientador1'].' </td>';
                    echo '<td id="op"> 2 - '.$dados['orientador2'].' </td>';
                    echo '<td id="op"> 3 - '.$dados['orientador3'].'</td>';
                    
                    
                        $sql1 = "SELECT  usuarios.idusuarios, usuarios.nome, professor.idprofessor  FROM usuarios, professor \n"
                            . "WHERE usuarios.idusuarios = professor.idusuarios ORDER BY `nome` ASC";
                        
                        $resultado1 = mysqli_query($conexao,$sql1);
                        echo '<form  method="post" action="cadastrar_ori.php">';
                        echo '<td> <input type="hidden" name="id_aluno" value="'.$dados['idaluno'].'">';
                        
                        if ($dados['orientador_def'] == 0) {
                            echo '<p class="font-weight-light"><strong>Atual orientador: </strong>Nenhum</p>';
                        } else {
                            $id_prof=$dados['orientador_def'];
                            $sql2= "SELECT usuarios.nome FROM usuarios, professor WHERE usuarios.idusuarios=professor.idusuarios AND professor.idprofessor=\"$id_prof\"";
                            $resultado2 = mysqli_query($conexao,$sql2);
                            $dados2= mysqli_fetch_assoc($resultado2);

                            echo '<p class="font-weight-light"><strong>Atual orientador: </strong>'.$dados2["nome"].'</p>';
                        
                        }   

                        echo '<select class="form-control" name="ori_def" required>';
                        while ($dados1 = mysqli_fetch_assoc($resultado1)) {
                            
                            echo '<option>'.$dados1['nome'].'</option>';  
                            
                        }
                        echo '</select>';
                        echo '<button class="btn btn-primary btn-sm btn-block mt-2" type="submit" name="enviar"> Cadastrar orientador</button>
                                    
                            
                                </form></td>';  
                    echo '</tr>';
                    echo '<tbody>';
                    $n++;
                }
                echo "</table>";
            }
        
        ?>
    
    </div>

     <!-- Containers Footer -->
	<div class="container-fuid pl-5 pr-5 mt-5 pt-3">
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

