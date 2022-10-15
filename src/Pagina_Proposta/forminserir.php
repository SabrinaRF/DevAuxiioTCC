<?php
      session_start();
      if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 0 ) {
          $usuario = $_SESSION["UsuarioNome"];
      } else {
          header("Location:../index.php");
      }
    include("../conecta.php");   
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo_proposta.css">
    <link rel="icon" href="../imagens/logotipo2.png">
	  <title>Sistema de Auxílio à Orientação de TCC</title>
</head>
<body >
  
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
            <a class="nav-link" href="../Aluno/PaginaInicial_Aluno.php">Início</a>
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
              <a class="dropdown-item" href="../Aluno/banca_examinadora.php">Banca examinadora</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="forminserir.php">Proposta Inicial</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../Professor/Vaga_Orientar/tabela_vagas_A.php">Tabela: Vagas para orientação</a>
						</div>
					</li>

          </ul>
          
            <li class="navbar-nav nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropConf" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Configurações<!--<img src="../imagens/config.png" width="30" height="30" alt="Logo IFfar"> li-> dropleft-->
            </a>
              <div class="dropdown-menu" aria-labelledby="dropConf">
                  <a class="dropdown-item" href="../Aluno/GerenPerfil_A.php">Perfil do usuário</a>
                  <div class="dropdown-divider"></div>
						    	<a class="dropdown-item" href="../sobre_nosA">Sobre</a>
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


      <!-- -fluid-->
    <div class="container" id="container-corpo"> 
        <div class="col-md-8 order-md-1 pt-5 pb-5 bg-light border border-secondary" style="border-radius:10px;">
            <h4 class="mb-3 text-center ">Formulário de indicação de ordem de professores orientadores</h4>
            <br>

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
              </p>
      <!------------------------------------------------------------------------------------------->
            
            <form class="needs-validation" method="post" action="inserir.php" >            

                <div class="mb-3">
                  <label for="area1">Área do TCC:</label>
                    <input type="text" class="form-control" id="area1" placeholder="Ex. Programação" name="area1" required><br>
                    <input type="text" class="form-control" id="area2" placeholder="Ex. Banco de dados" name="area2"><br>
                    <input type="text" class="form-control" id="area3" placeholder="Ex. Programação" name="area3">
                    <div class="invalid-feedback" >
                      Por favor, insira uma área.
                    </div>
                    <p><em>*Somente uma área é obrigatória.</em></p>
                </div>

                <div class="mb-3">
                  <label for="prop">Proposta:</label>
                  <textarea class="form-control" id="prop" rows="3" name="proposta" required></textarea>
                  <div class="invalid-feedback">
                    Por favor, insira sua proposta.
                  </div>
                </div>

                <div class="mb-3 mt-4">
                  <a id="recomendar"><button type="button" class="btn btn-info pt-2 pb-2 btn-block">
                    Recomendar orientadores
                  </button></a>
                </div>
                
                <div class="mb-3">
                  <label id="sugestao"></label>
                </div>               

                <?php
                  $sql = "SELECT  usuarios.idusuarios, usuarios.nome  FROM usuarios, professor \n"
                        . "WHERE usuarios.idusuarios = professor.idusuarios ORDER BY `nome` ASC";
        
                    $resultado = mysqli_query($conexao,$sql);
        
                    echo '<div class="mb-3">';
                    echo '<label for="orientador1">Orientador 1:</label>';
                    echo '<select class="form-control" id="orientador1" name="ori_1" required>';

                    while ($dados = mysqli_fetch_assoc($resultado)) {
                        
                        echo '<option>'.$dados['nome'].'</option>';   
                        
                    }
                      echo '</select>';
                      echo '<div class="invalid-feedback">Por favor, insira um(a) professor(a).';
                      echo '</div>';
                      echo '</div>';
                ?>

                <?php
                  $sql = "SELECT  usuarios.idusuarios, usuarios.nome FROM usuarios, professor \n"
                        . "WHERE usuarios.idusuarios = professor.idusuarios ORDER BY `nome` ASC";
        
                    $resultado = mysqli_query($conexao,$sql);
        
                    echo '<div class="mb-3">';
                    echo '<label for="orientador2">Orientador 2:</label>';
                    echo '<select class="form-control" id="orientador2" name="ori_2" required>';

                    while ($dados = mysqli_fetch_assoc($resultado)) {
                        
                        echo '<option>'.$dados['nome'].'</option>';   
                        
                    }
                      echo '</select>';
                      echo '<div class="invalid-feedback">Por favor, insira um(a) professor(a).';
                      echo '</div>';
                      echo '</div>';
                ?>         
                <?php
                  $sql = "SELECT  usuarios.idusuarios, usuarios.nome FROM usuarios, professor \n"
                        . "WHERE usuarios.idusuarios = professor.idusuarios ORDER BY `nome` ASC";
        
                    $resultado = mysqli_query($conexao,$sql);
        
                    echo '<div class="mb-3">';
                    echo '<label for="orientador3">Orientador 3:</label>';
                    echo '<select class="form-control" id="orientador3" name="ori_3" required>';

                    while ($dados = mysqli_fetch_assoc($resultado)) {
                        
                        echo '<option>'.$dados['nome'].'</option>';   
                        
                    }
                      echo '</select>';
                      echo '<div class="invalid-feedback">Por favor, insira um(a) professor(a).';
                      echo '</div>';
                      echo '</div>';
                ?> 

                <div class="mb-3">
                  <label for="check1">
                    <p> <input type="checkbox" name="termo" id="check1" value="1" checked > Concordo com a escolha de professor orientador definida pelo Colegiado de Curso, 
                      que pode não contemplar nenhuma das possibilidades acima. 
                    </p>
                  </label>
                </div>

                <div class="mb-3">
                  <label for="check2">
                    <p> <input type="checkbox" name="termo" id="check2" value="1" checked > Estou ciente que essa é somente uma ideia inicial,
                     que poderá ser adaptada futuramente 
                    </p>
                  </label>
                </div>

            <button class="btn btn-primary btn-lg btn-block" type="submit" name="enviar">Enviar</button>

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
      
                  <a href="../Aluno/PaginaInicial_Aluno.php">Voltar ao Início</a>
            </div>   
        </div>       
        </footer>
        
    </div>
    
  <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script type="text/javascript" >
                  
      $(document).ready(function(){
        $("#recomendar").click(function(){
          $.post("recomendar.php",
          {
            area: $("#area1").val() + " " + $("#area2").val() + " " + $("#area3").val()
            
          },
          function(data, status){
            //alert("Data: " + data + "\nStatus: " + status);
            $("#sugestao").html(data);
          });
        });
      });
  </script>  
</body>
</html>