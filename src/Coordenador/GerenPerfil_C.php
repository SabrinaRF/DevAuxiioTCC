<?php

	session_start();
	if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
		$usuario = $_SESSION["UsuarioNome"];
	} else {
		header("Location:../index.php");
	}
    include("../conecta.php");

	$id = $_SESSION["IDusuario"];
	$sql = "SELECT usuarios.nome, usuarios.user, usuarios.email, usuarios.cpf, usuarios.imgnome, professor.area_atuante1, professor.area_atuante2, professor.area_atuante3 FROM `usuarios`, `professor` WHERE usuarios.idusuarios = professor.idusuarios AND usuarios.idusuarios = \"$id\"";
	$resultado = mysqli_query($conexao,$sql);

	$linhasAfetadas = mysqli_affected_rows($conexao);

    if($linhasAfetadas > 0){
        $dados = mysqli_fetch_assoc($resultado);   
	}else {
		echo "erooooooooooooooo";
	}

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
		<div class="col-lg-8 md-10 order-md-1 mt-5 bg-light border border-secondary" style="border-radius:10px;">
			<div class="row pt-3">	
				<div class="col-12">		
				<h1 class="mb-3 mt-4 text-dark text-center">
				<p class="h3">Perfil</p>
				<small class="text-muted"></small>
				</h1>
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
            ?>
            <!--------------------------------------------------------------------------------------------------------->
			<div class="row pb-5 ">				
				<div class="col-12 mt-4 text-center">
					<button type="button" class="btn btn-light btn-sm bg-transparent" data-toggle="modal" data-target="#modalupload">
						<a>
							<img src="../Professor/arquivos_img/<?php echo $dados["imgnome"];?>" alt="Editar" class="rounded-circle"  width="150" height="150">
						</a>
					</button>
					
				</div>
				<?php //////////                PERFIL UPLOAD                 ////////////

					echo'<meta charset="UTF-8">';

						//     Modal Editar
					echo '<div class="modal " id="modalupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog " role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Edição de perfil</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
								
									<form enctype="multipart/form-data" action="perfil_up_C.php" method="post"> 
									<p>Escolha uma imagem: </p>    
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
										</div>
										<div class="custom-file">
											<input type="file" class="custom-file-input" name="arquivo" id="arquivo" aria-describedby="inputGroupFileAddon01" required>
											<label class="custom-file-label" for="arquivo">Escolher arquivo</label>
										</div>
									</div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									<button type="submit" class="btn btn-primary" name="submit">Confirmar alterações</button>
									</form>
								</div>
							</div>
							</div>
						</div>';
				?>				
				
				<div class="col-11 mt-5 pl-5 ml-5"> 
					<div class="row">
						<div class="col-9">
							<p>Nome do Professor(a): <?php echo $dados["nome"];?></p>
						<hr>
						</div>
						<div class="col-2 text-right">
							<p>
								<button type="button" class="btn btn-light btn-sm bg-transparent" data-toggle="modal" data-target="#modalnome">
									<a>
										<img src="../imagens/editar25.png" alt="Editar" class="rounded"  width="24" height="24">
									</a>
								</button>
							</p>
						</div>
						<?php //////////                PERFIL NOME                 ////////////

							echo'<meta charset="UTF-8">';

								//     Modal Editar
							echo '<div class="modal " id="modalnome" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog " role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edição de perfil</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										
											<form action="perfil_C.php" method="post">     
											<div class="mb-3">
												<label for="nome">Nome do professor(a):</label>
												<input type="text" class="form-control" id="nome" name="nome"  value="'.$dados['nome'].'"required>								
											</div>																				
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											<button type="submit" class="btn btn-primary">Confirmar alterações</button>
											</form>
										</div>
									</div>
									</div>
								</div>';
						?>
					</div>
					<div class="row">
						<div class="col-9">
							<p>Username: <?php echo $dados["user"];?></p>
						<hr>
						</div>
						<div class="col-2 text-right">
							<p>
								<button type="button" class="btn btn-light btn-sm bg-transparent" data-toggle="modal" data-target="#modaluser">
									<a>
										<img src="../imagens/editar25.png" alt="Editar" class="rounded"  width="24" height="24">
									</a>
								</button>
							</p>
						</div>
						<?php //////////                PERFIL USER	                      /////////////

							echo'<meta charset="UTF-8">';

								//     Modal Editar
							echo '<div class="modal " id="modaluser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog " role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edição de perfil</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										
											<form action="perfil_C.php" method="post">     
											<div class="mb-3">
												<label for="user">Username: </label>
												<input type="text" class="form-control" id="user" name="user"  value="'.$dados['user'].'"required>								
											</div>																				
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											<button type="submit" class="btn btn-primary">Confirmar alterações</button>
											</form>
										</div>
									</div>
									</div>
								</div>';
						?>
					</div>
					<div class="row">
						<div class="col-9">
							<p>Email: <?php echo $dados["email"];?></p>
						<hr>
						</div>
						<div class="col-2 text-right">
							<p>
								<button type="button" class="btn btn-light btn-sm bg-transparent" data-toggle="modal" data-target="#modalemail">
									<a>
										<img src="../imagens/editar25.png" alt="Editar" class="rounded"  width="24" height="24">
									</a>
								</button>
							</p>
						</div>
						<?php //////////                PERFIL EMAIL                      /////////////

							echo'<meta charset="UTF-8">';

								//     Modal Editar
							echo '<div class="modal " id="modalemail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog " role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edição de perfil</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										
											<form action="perfil_C.php" method="post">     
											<div class="mb-3">
												<label for="email">Email: </label>
												<input type="text" class="form-control" id="email" name="email"  value="'.$dados['email'].'"required>								
											</div>																				
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											<button type="submit" class="btn btn-primary">Confirmar alterações</button>
											</form>
										</div>
									</div>
									</div>
								</div>';
						?>
					</div>
					<div class="row">
						<div class="col-9">
							<p>CPF: <?php echo $dados["cpf"];?></p>
						<hr>
						</div>
						<div class="col-2 text-right">
							<p>
								<button type="button" class="btn btn-light btn-sm bg-transparent" data-toggle="modal" data-target="#modalcpf">
									<a>
										<img src="../imagens/editar25.png" alt="Editar" class="rounded"  width="24" height="24">
									</a>
								</button>
							</p>
						</div>
						<?php //////////                PERFIL CPF	                      /////////////

							echo'<meta charset="UTF-8">';

								//     Modal Editar
							echo '<div class="modal " id="modalcpf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog " role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edição de perfil</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										
											<form action="perfil_C.php" method="post">     
											<div class="mb-3">
												<label for="cpf">CPF: </label>
												<input type="text" class="form-control" id="cpf" name="cpf"  value="'.$dados['cpf'].'"required>								
											</div>																				
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											<button type="submit" class="btn btn-primary">Confirmar alterações</button>
											</form>
										</div>
									</div>
									</div>
								</div>';
						?>
					</div>
                    <div class="row">
						<div class="col-9">
							<p>Área atuante:</p>
							<p>1. <?php echo $dados["area_atuante1"];?> </p>
						<hr>
						</div>
						<div class="col-2 text-right mt-3 pt-4">
							<p>
								<button type="button" class="btn btn-light btn-sm bg-transparent" data-toggle="modal" data-target="#modalarea1">
									<a>
										<img src="../imagens/editar25.png" alt="Editar" class="rounded"  width="24" height="24">
									</a>
								</button>
							</p>
						</div>
					
						
						<?php //////////                PERFIL AREA	                      /////////////

							echo'<meta charset="UTF-8">';

								//     Modal Editar
							echo '<div class="modal " id="modalarea1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog " role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edição de perfil</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										
											<form action="perfil_C.php" method="post">     
											<div class="mb-3">
												<label for="atuacao">ÁREA ATUANTE:</label>
												<input type="text" class="form-control" id="atuacao" value="'.$dados['area_atuante1'].'" name="atuacao1"required><br>
											</div>																				
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											<button type="submit" class="btn btn-primary">Confirmar alterações</button>
											</form>
										</div>
									</div>
									</div>
								</div>';
						?>
					</div>
					<div class="row">
						<div class="col-9">
							<p>2. <?php echo $dados["area_atuante2"];?> </p>
						<hr>
						</div>
						<div class="col-2 text-right">
							<p>
								<button type="button" class="btn btn-light btn-sm bg-transparent" data-toggle="modal" data-target="#modalarea2">
									<a>
										<img src="../imagens/editar25.png" alt="Editar" class="rounded"  width="24" height="24">
									</a>
								</button>
							</p>
						</div>
					
						
						<?php //////////                PERFIL AREA	                      /////////////

							echo'<meta charset="UTF-8">';

								//     Modal Editar
							echo '<div class="modal " id="modalarea2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog " role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edição de perfil</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										
											<form action="perfil_C.php" method="post">     
											<div class="mb-3">
												<label for="atuacao">ÁREA ATUANTE:</label>
												<input type="text" class="form-control" id="atuacao" value="'.$dados['area_atuante2'].'" name="atuacao2"><br>
											</div>																				
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											<button type="submit" class="btn btn-primary">Confirmar alterações</button>
											</form>
										</div>
									</div>
									</div>
								</div>';
						?>
					</div>
					<div class="row">
						<div class="col-9">
							<p>3. <?php echo $dados["area_atuante3"];?> </p>
						<hr>
						</div>
						<div class="col-2 text-right">
							<p>
								<button type="button" class="btn btn-light btn-sm bg-transparent" data-toggle="modal" data-target="#modalarea3">
									<a>
										<img src="../imagens/editar25.png" alt="Editar" class="rounded"  width="24" height="24">
									</a>
								</button>
							</p>
						</div>
					
						
						<?php //////////                PERFIL AREA	                      /////////////

							echo'<meta charset="UTF-8">';

								//     Modal Editar
							echo '<div class="modal " id="modalarea3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog " role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edição de perfil</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										
											<form action="perfil_C.php" method="post">     
											<div class="mb-3">
												<label for="atuacao">ÁREA ATUANTE:</label>
												<input type="text" class="form-control" id="atuacao" value="'.$dados['area_atuante3'].'" name="atuacao3"><br>
											</div>																				
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
											<button type="submit" class="btn btn-primary">Confirmar alterações</button>
											</form>
										</div>
									</div>
									</div>
								</div>';
						?>
					</div>
				</div>
				
			</div>	
		</div>
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
      
                  <a href="PaginaInicial_Coordenador.php">Voltar ao Início</a>
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