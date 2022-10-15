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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../Cronograma/estilo_cronograma.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="DocumentosC.php">Documentos</a>
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
    

    <!-- Container do Corpo do Página (DOCUMENTOS) -->
	<div class="container" id="container-corpo">
        <div class="list-group list-group-flush">
            <h1>
            Documentos
            <p><a class="btn btn-outline-info" href="formupload.php" role="button">Adicionar documento</a></p>
            <small class="text-muted"><br>Formulários</small>
            </h1>
            <!--     CÓDIGO EM PHP DO ALERTA    -->      
            <p> 
                    <?php
                    if ((isset($_SESSION['Erro']))) {
                        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                '.$_SESSION['Erro'].'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        unset($_SESSION['Erro']);
                    }
                    

                    if ((isset($_SESSION['Sucesso']))) {
                        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$_SESSION['Sucesso'].'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        unset($_SESSION['Sucesso']);
                    }
                    ?>
            </p>
            <!-------------------------------------------------------------------------------------------------------------->
            

        <?php //////////                 FORMULÁRIO               ////////////
            

            $sql = "SELECT * FROM `documento` WHERE `tipo`= \"formulário\" ORDER BY `nome` ASC";      
            $resultado = mysqli_query($conexao,$sql);

            while ($dados= mysqli_fetch_assoc($resultado)) {

            $id = $dados["iddocumento"];
            echo '<div class="row">';
                echo '<div class="col-lg-10 md-12 sm-12 ">';
                echo '<a href="" class="list-group-item list-group-item-action" >'.$dados['nome'].'</a>';
                echo '</div>';
                    echo '<div class="col-lg-1 md-12 sm-12 ">';
                    //        Botão para editar
                    echo '<a href="formeditar_documento.php?id='.$id.'" class="btn btn-info btn-block btn-sm" role="button">
                                Editar
                            </a>'; 
                    echo '</div>';
                    //        Botão para excluir
                    echo '<div class="col-lg-1 md-12 sm-12 ">';
                    echo '<a href="upload/excluir_up.php?id='.$id.'" class="btn btn-danger btn-block btn-sm" role="button">
                            Excluir
                        </a>';              
                    echo '</div>';
            echo '</div>';

        
            }
        ?>
        </div>
        
        <div class="list-group list-group-flush">
            <h1>
            <small class="text-muted"><br>Regulamentos</small>
            </h1>

            <?php //////////                REGULAMENTO                           /////////////

            echo'<meta charset="UTF-8">';

            $sql = "SELECT * FROM `documento` WHERE `tipo`= \"regulamento\" ORDER BY `nome` ASC";      
            $resultado = mysqli_query($conexao,$sql);
            

            while ($dados= mysqli_fetch_assoc($resultado)) {

                $id = $dados["iddocumento"];

                echo '<div class="row">';
                    echo '<div class="col-lg-10 md-12 sm-12 ">';
                    echo '<a href="" class="list-group-item list-group-item-action">'.$dados['nome'].'</a>';
                    echo '</div>';
                        echo '<div class="col-lg-1 md-12 sm-12 ">';
                        //        Botão para editar
                        echo '<a href="formeditar_documento.php?id='.$id.'" class="btn btn-info btn-block btn-sm" role="button">
                                    Editar
                                </a>'; 
                        echo '</div>';
                        //        Botão para excluir
                        echo '<div class="col-lg-1 md-12 sm-12 ">';
                        echo '<a href="upload/excluir_up.php?id='.$id.'" class="btn btn-danger btn-block btn-sm" role="button">
                                    Excluir
                                </a>';              
                        echo '</div>';
                echo '</div>';

            }
            
            ?>

        </div>

        <div class="list-group list-group-flush">
            <h1>
            <small class="text-muted"><br>Trabalho de Conclusão de Curso - Anos anteriores</small>
            </h1>

            <?php //////////////         TCCS ANTERIORES                    /////////////////

            echo'<meta charset="UTF-8">';

            $sql = "SELECT * FROM `documento` WHERE `tipo`= \"TCCs Anteriores\" ORDER BY `nome` ASC";      
            $resultado = mysqli_query($conexao,$sql);

            while ($dados= mysqli_fetch_assoc($resultado)) {

                $id = $dados["iddocumento"];
                echo '<div class="row">';
                    echo '<div class="col-lg-10 md-12 sm-12 ">';
                    echo '<a href="" class="list-group-item list-group-item-action" >'.$dados['nome'].'</a>';
                    echo '</div>';
                        echo '<div class="col-lg-1 md-12 sm-12 ">';
                        //        Botão para editar
                        echo '<a href="formeditar_documento.php?id='.$id.'" class="btn btn-info btn-block btn-sm" role="button">
                                Editar
                            </a>';  
                        echo '</div>';
                        //        Botão para  excluir
                        echo '<div class="col-lg-1 md-12 sm-12 ">';
                        echo '<a href="upload/excluir_up.php?id='.$id.'" class="btn btn-danger btn-block btn-sm" role="button">
                                Excluir
                            </a>';             
                        echo '</div>';
                echo '</div>';

            }
            
            ?>

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
      
                  <a href="../Coordenador/PaginaInicial_Coordenador.php">Voltar ao Início</a>
            </div>   
        </div>      
        </footer>
        
    </div>

    <script>
        //Código em JavaScript do file
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    
</body>
</html>