<?php

	session_start();
	if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 0 ) {
        $usuario = $_SESSION["UsuarioNome"];
	} else {
		header("Location:../index.php");
	}
    include("../conecta.php");
    
    $sql="SELECT usuarios.nome, aluno.idaluno FROM `usuarios`,`aluno` WHERE usuarios.`idusuarios`=aluno.`idusuarios` AND usuarios.`user`=\"$usuario\"";
    $resu = mysqli_query($conexao,$sql);
    $dados=mysqli_fetch_assoc($resu);
    $nome_aluno=$dados["nome"];
    $id_aluno=$dados["idaluno"];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema de Auxílio à Orientação de TCC</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilo_cadastro.css">
</head>
<body >
	<!-- Barra de Navegação -->
	<header >
		<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light" >		
			<a class="navbar-brand" href="#">
				<img src="../imagens/logotipopng.png" width="20" height="30" alt="Logo IFfar"> Sistema de Auxílio à Orientação de TCC
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link" href="PaginaInicial_Aluno"> Início <span class="sr-only">(Página atual)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../Cronograma/CronogramaA.php">Cronograma</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../Documentos/DocumentosA.php">Documentos</a>
				</li>
				<li class="nav-item dropdown active">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Outros</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="banca_examinadora.php">Banca examinadora</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="../Pagina_Proposta/forminserir.php">Proposta Inicial</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="../Professor/Vaga_Orientar/tabela_vagas_A.php">Tabela: Vagas para orientação</a>
					</div>
				</li>

				</ul>
				

					<li class=" navbar-nav nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropConf" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Configurações<!--<img src="../imagens/config.png" width="30" height="30" alt="Logo IFfar"> li-> dropleft-->
					</a>
						<div class="dropdown-menu" aria-labelledby="dropConf">
								<a class="dropdown-item " href="../Aluno/GerenPerfil_A.php">Perfil do usuário</a>
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

    <!--Código input file -->

	<div class="container" id="container-corpo">
        <div class="col-md-9 order-md-1 bg-light border border-secondary" style="border-radius:10px;">
        <br>
        <form enctype="multipart/form-data" action="upload_docbanca.php" method="post">
            <h1 class="h3 text-center">
                Relatório final do Trabalho de Conclusão de Curso  
            </h1>
            <p class="text-muted"><br>Este formulário enviará o relatório final do Trabalho de Conclusão de Curso (TCC)
                para sua banca examinadora e coordenador de TCC.</p>
            <!--     CÓDIGO EM PHP DO ALERTA    -->      
                <p> 
                    <?php
                    if ((isset($_SESSION['ErroDados']))) {
                        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                '.$_SESSION['ErroDados'].'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        unset($_SESSION['ErroDados']);
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
            
            <?php
                $sql="SELECT proposta.orientador_def, banca.`examinador1`, banca.`examinador2`, banca.`examinador3`, proposta.`idproposta` "
                    ."FROM `banca`,`proposta`,`aluno` WHERE proposta.idproposta=banca.idproposta AND aluno.idaluno=proposta.idaluno "
                    ."AND aluno.idaluno = \"$id_aluno\"";
                $resultado = mysqli_query($conexao,$sql);

                while ($dados = mysqli_fetch_assoc($resultado)) {

                        $id_proposta=$dados["idproposta"];
    
                        $id = $dados['orientador_def'] ;
                        $sql1 = "SELECT usuarios.nome FROM usuarios,professor WHERE usuarios.idusuarios=professor.idusuarios AND professor.idprofessor = \"$id\"";
                        $resultado1 = mysqli_query($conexao,$sql1);
                        $dados1 = mysqli_fetch_assoc($resultado1);
                    
                        $ori_def = $dados1['nome'];
                        
    
                        $id = $dados['examinador1'] ;
                        $sql1 = "SELECT usuarios.nome FROM usuarios,professor WHERE usuarios.idusuarios=professor.idusuarios AND professor.idprofessor = \"$id\"";
                        $resultado1 = mysqli_query($conexao,$sql1);
                        $dados1 = mysqli_fetch_assoc($resultado1);
                    
                        $exa1 = $dados1['nome'];
    
                        $id = $dados['examinador2'] ;
                        $sql1 = "SELECT usuarios.nome FROM usuarios,professor WHERE usuarios.idusuarios=professor.idusuarios AND professor.idprofessor = \"$id\"";
                        $resultado1 = mysqli_query($conexao,$sql1);
                        $dados1 = mysqli_fetch_assoc($resultado1);
    
                        $exa2 = $dados1['nome'];
    
                        $id = $dados['examinador3'] ;
                        $sql1 = "SELECT usuarios.nome FROM usuarios,professor WHERE usuarios.idusuarios=professor.idusuarios AND professor.idprofessor = \"$id\"";
                        $resultado1 = mysqli_query($conexao,$sql1);
                        $dados1 = mysqli_fetch_assoc($resultado1);
                    
                        $exa3 = $dados1['nome'];
                }

                $sql = "SELECT usuarios.nome FROM `usuarios` WHERE nivel= \"2\"";
                $resultado = mysqli_query($conexao,$sql);
                $dado= mysqli_fetch_assoc($resultado);
                $coordenador =$dado["nome"];
                
            ?>

           <div class="mb-3">
                <input type="hidden" name="id_proposta" value="<?php echo $id_proposta;?>">
            </div>
            <div class="mb-3">
            <strong><label for="arq">Nome do aluno(a):</label></strong>
                <?php echo $nome_aluno;?>
            </div>
            <div class="mb-3">
            <strong><label for="arq">Coordenador:</label></strong>
                <?php echo $coordenador;?>
                <div class="invalid-feedback">
                    Por favor, insira um nome.
                </div>
            </div>
            <div class="mb-3">
            <strong><label for="arq">Orientador:</label></strong>
                <?php echo $ori_def;?>
                <div class="invalid-feedback">
                    Por favor, insira um nome.
                </div>
            </div>
            <div class="mb-3">
            <strong><label for="arq">Examinador 1:</label></strong>
                <?php echo $exa1;?>
                <div class="invalid-feedback">
                    Por favor, insira um nome.
                </div>
            </div>
            <div class="mb-3">
            <strong><label for="arq">Examinador 2:</label></strong>
                <?php echo $exa2;?>
                <div class="invalid-feedback">
                    Por favor, insira um nome.
                </div>
            </div>
            <div class="mb-3">
            <strong><label for="arq">Examinador 3 (Suplente):</label></strong>
                <?php echo $exa3;?>
                <div class="invalid-feedback">
                    Por favor, insira um nome.
                </div>
            </div>
            <div class="mb-3">Relatório final:</div>
            <div class="input-group mb-3">  
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="arquivo" id="arquivo" aria-describedby="inputGroupFileAddon01" required>
                    <label class="custom-file-label" for="arquivo">Escolher arquivo</label>
                </div>
                
                <input class="btn btn-outline-secondary"type="submit" value="Enviar" name="submit" />  
            </div>
            <p><em>* Somente é permitido extensão em pdf e tamanho máximo de 10MB</em></p>     
        </form>
        </div>
    </div>



 <!-- Containers Footer -->
    <div class="container ">
	    <hr class="mb-4 ">
       
        <footer>
    	
		<div class="row mb-4 ">
			<div class="col lg-2 md-3 sm-3 ">
	            
	        </div>
            <div class="col lg-8 md-9 sm-9 text-right pt-3">
              
                  <p class=" text-secondary">&copy; 2020 Sistema de Auxílio à Orientação de TCC</p>
            </div>
            <div class="col lg-2 md-3 sm-3 text-right pt-3">
      
                  <a href="PaginaInicial_Aluno.php">Voltar ao Início</a>
            </div>   
        </div>     
        </footer>
        
    </div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        //Código em JavaScript do file
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>
</html>