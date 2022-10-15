<?php
    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
        $usuario = $_SESSION["UsuarioNome"];
    } else {
        header("Location:../index.php");
    }    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type= "text/javascript" src="../js/jquery-3.4.1.">       </script>
	  <script type= "text/javascript" src="../js/jquery.mask.min.js"> </script>
    <link rel="stylesheet" href="../estilo_cadastro.css">
	  <title>Sistema de Auxílio à Orientação de TCC</title>
    
</head>
<body >

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
          <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Cadastro</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="formcadastrar.php">Professor(a)</a>
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

    <div class="container" id="container-corpo" > <!-- -fluid-->
        <div class="col-md-9 order-md-1 bg-light border border-secondary" style="border-radius:10px;"><!---->
            <h4 class="mb-3 mt-4">Formulário de cadastro dos professores</h4><br>

            <!-- CÓDIGO EM PHP DO ALERTA --> 
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

                      if ((isset($_SESSION['Cadastrado']))) {
                        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                              '.$_SESSION['Cadastrado'].'
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                          unset($_SESSION['Cadastrado']);
                      }
                      if ((isset($_SESSION['alternativo']))) {
                        echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              '.$_SESSION['alternativo'].'
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                          unset($_SESSION['alternativo']);
                      }
                ?>
            <!--------------------------------------------------------------------------------------------------------->

            <form class="needs-validation" method="post" action="cadastrar.php" novalidate>
                <div class="mb-3">
                    <label for="nome">NOME DO PROFESSOR(A):</label>
                    <input type="text" class="form-control" id="nome" placeholder="Ex. Fulano Beltrano Sicrano " name="nome" required>
                    <div class="invalid-feedback" >
                    É obrigatório inserir um nome válido.
                    </div>
                </div>

                <div class="mb-3">
              <label for="username">NOME DE USUÁRIO:</label>
                <input type="text" class="form-control" id="username" placeholder="Ex. Fulano" name="user"required>
                <div class="invalid-feedback" >
                  Seu username é obrigatório.
                </div>
            </div>

            <div class="mb-3">
              <label for="email">EMAIL:</label>
              <input type="email" class="form-control" id="email" placeholder="Ex. Fulano.0000000000@aluno.iffar.edu.br" name="email" required>
              <div class="invalid-feedback">
                Por favor, insira um endereço de e-mail válido.
              </div>
            </div>

            <div class="mb-3">
              <label for="cpf">CPF:</label>
              <input type="text" min="1" max="14" class="form-control" id="cpf" placeholder="XXX.XXX.XXX-XX" name="cpf"required>
              <div class="invalid-feedback">
                Por favor, insira seu CPF.
              </div>
            </div>

            <div class="mb-3">
              <label for="atuacao">ÁREA ATUANTE:</label>
              <input type="text" class="form-control" id="atuacao" placeholder="Ex. Programação" name="atuacao1"required><br>
              <input type="text" class="form-control" placeholder="Ex. Banco de dados" name="atuacao2"><br>
              <input type="text" class="form-control" placeholder="Ex. Análise e modelagem de sistemas" name="atuacao3">
              <p><em>* Somente uma área é obrigatória. </em></p>
              <div class="invalid-feedback">
                Por favor, insira sua área de atuação.
              </div>
            </div>

            <div class="mb-3">
              <label for="senha">SENHA:</label>
              <input type="password" class="form-control" id="senha" name="senha" required>
              <div class="invalid-feedback">
                Por favor, insira uma senha.
              </div>
            </div>

            <div class="mb-3">
              <label for="conf_senha">CONFIRMAR SENHA:</label>
              <input type="password" class="form-control" id="conf_senha"  name="confirma_senha" required>
              <div class="invalid-feedback">
                Por favor, confira sua senha.
              </div>
            </div>

            <hr class="mb-4">
          
          
          <button class="btn btn-primary btn-lg btn-block mb-4" type="submit">Enviar</button>
          </form>
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
      
                  <a href="../Coordenador/PaginaInicial_Coordenador.php">Voltar ao Início</a>
            </div>   
        </div>     
        </footer>
        
    </div>

    <!-- MASCARA DO CPF -->
    <script type="text/javascript">
          $(document).ready(function(){
          $('#cpf').mask('999.999.999-99');
          })
    </script>
    <!------------------------------------------------------------------------------------------------------------------->
    
      
</body>
</html>