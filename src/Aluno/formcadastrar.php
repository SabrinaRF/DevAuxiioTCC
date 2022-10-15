<?php
    session_start();
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
    <script type= "text/javascript" src="../js/jquery-3.4.1">       </script>
	  <script type= "text/javascript" src="../js/jquery.mask.min.js"> </script>
	  <link rel="icon" href="../imagens/logotipo2.png">
    <link rel="stylesheet" href="../estilo_cadastro.css">
	<title>Sistema de Auxílio à Orientação de TCC</title>
</head>
<body style="background-color:#008B45;">

  <!-- MASCARA DO CPF -->
    <script type="text/javascript">
      $(document).ready(function(){
      $('#cpf').mask('999.999.999-99');
      })
    </script>
  <!------------------------------------------------------------------------------------------------------------------->

    
	  <div class="container" id="container-corpo"> <!-- -fluid-->
        <div class="col-md-9 pl-4 pr-4 order-md-1 bg-white border border-secondary" style="border-radius:10px;">
            <h4 class="mb-3 mt-5 text-center ">Formulário de Cadastro dos Alunos </h4><br>

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
                <label for="nome">NOME DO ESTUDANTE: </label>
                <input type="text" class="form-control" id="nome" placeholder="EX. Fulano Beltrano Sicrano " name="nome" required>
                <div class="invalid-feedback" >
                  É obrigatório inserir um nome válido.
                </div>
              </div>

            <div class="mb-3">
              <label for="username">NOME DE USUÁRIO: </label>
                <input type="text" class="form-control" id="username" placeholder="EX. Fulano" name="user" required>
                <div class="invalid-feedback" >
                  Seu username é obrigatório.
                </div>
            </div>

            <div class="mb-3">
              <label for="email">EMAIL:</label>
              <input type="email" class="form-control" id="email" placeholder="EX. Fulano.0000000000@aluno.iffar.edu.br" name="email" required>
              <div class="invalid-feedback">
                Por favor, insira um endereço de e-mail válido.
              </div>
            </div>

            <div class="mb-3">
              <label for="cpf">CPF:</label>
              <input type="text" min="1" max="14" class="form-control" id="cpf" placeholder="XXX.XXX.XXX-XX" name="cpf" required>
              <div class="invalid-feedback">
                Por favor, insira seu CPF.
              </div>
            </div>

            <div class="mb-3">
              <label for="matricula">NÚMERO DA MATRÍCULA:</label>
              <input type="number" class="form-control" id="matricula" placeholder="XXXXXXXXXX" name="matricula" required>
              <div class="invalid-feedback">
                Por favor, insira sua matrícula.
              </div>
            </div>

            <div class="mb-3">
              <label for="curso">CURSO:</label>
                <select class="form-control" id="curso" name="curso"required>
                  <option>TÉCNICO EM INFORMÁTICA INTEGRADO AO ENSINO MÉDIO</option>
                </select>
              <div class="invalid-feedback">
                Por favor, insira uma opção.
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
             
            <button class="btn btn-success btn-lg btn-block mb-5" type="submit">Enviar</button>

            </form>
        </div> 
    </div>
    <div class="container" >
        <hr class="mb-4">
          <footer class="text-muted">     
                  <p class="float-right ">
                  <a href="../index.php" class="text-white">Voltar ao Início</a>
                  </p>
          </footer>    
    </div>
</body>
</html>