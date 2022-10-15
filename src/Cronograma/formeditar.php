<?php

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
        $usuario = $_SESSION["UsuarioNome"];
    } else {
        header("Location:../index.php");
    }

    include("../conecta.php");

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM `cronograma` WHERE `idcronograma`=$id";
    $busca = mysqli_query($conexao,$sql);
    
    $dados = mysqli_fetch_assoc($busca);
    $data = $dados['data'];
    $data = date('d/m/Y',strtotime($data));
    $data = implode("/",array_reverse(explode("-",$data)));

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo_cronograma.css">
    <title>Sistema de Auxílio à Orientação de TCC</title>   
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
                    <a class="nav-link" href="../Coordenador/PaginaInicial_Coordenador.php">Início <span class="sr-only">(Página atual)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="CronogramaC.php">Cronograma</a>
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
            
            
                <li class="navbar-nav nav-item dropdown">
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
<div class="container" id="container-corpo">
        <h1>
        Cronograma
        <small class="text-muted">Atividades e prazos do TCC.<br>Editando...</small>
        </h1>

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
  
        <!----------------------------------------------------------------------------------------------------------------->

        <form  method="post" action="editar.php">
        
            <input type="hidden" name="id" size="10" value="<?php echo $dados['idcronograma']; ?>">
            <table class="table table-striped table-bordered table-hover">
            <thead scope="col"> <tr class="table-secondary"> <th scope="col">#</th> <th scope="col">ATIVIDADE</th> <th>DATA</th> </tr> </thead>
            <tbody> <tr> <th scope="row"> </th> <td><input type="text" name="atividade" class="caixa_texto" size="50" required value="<?php echo $dados['atividade']; ?>" ></td> <td><input type="date" name="data" class="caixa_texto"size="20" value="<?php echo $data; ?>"></td> </tr> </tbody> 
            </table>

            <br>
            <br>
            <input class="btn btn-outline-primary" type="submit" value="Salvar">  
        </form>
<div>
    
    
    <!-- Containers Footer -->
	<div class="container mt-5 pt-4">
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
