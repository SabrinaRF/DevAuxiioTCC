<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema de Auxílio à Orientação de TCC</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="Login/login_estilo.css" rel="stylesheet">
</head>
<body  style="background-color:#008B45;">

	<!--     CÓDIGO DO FORMULÁRIO DE LOGIN    -->  
	<div class="container">
  		<div class="row justify-content-md-center mt-5">
		<div class="col-lg-5 order-md-1 bg-light border border-secondary text-center mt-5 pt-3" style="border-radius:10px; ">
			<form method="post" action="Login/login.php"class="form-signin">
			<h1 class="h3 mb-3 mt-5 font-weight-light text-muted ">Faça login</h1>
			
			<img class="mb-4" src="imagens/perfil_logo.png" alt="" width="62" height="62">
			
			<!--     CÓDIGO EM PHP DO ALERTA    -->      
				<p> 
					<?php
					if ((isset($_SESSION['loginErro']))) {
						echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
								'.$_SESSION['loginErro'].'
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>';
						unset($_SESSION['loginErro']);
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
					?>
				</p>
			<!-------------------------------------------------------------------------------------------------------------->
		
			<label for="inputUser" class="sr-only">Username</label>
			<input type="text" name="user" id="inputUser" class="form-control" placeholder="Nome do usuário" required autofocus>

			<label for="inputSenha" class="sr-only">Senha</label>
			<input type="password" name="senha" id="inputSenha" class="form-control" placeholder="Senha" required>
			
			
			<div class="mt-3 mb-3">	
				<input class="btn btn-outline-success" type="submit" value="Logar">	
			</div>	
			<!--     CÓDIGO DOS LINKS    -->      
					
				
			</form>
			<div>		
				<p class="font-weight-light mb-5">Aluno não possui cadastro? <a href="Aluno/formcadastrar.php">Cadastre-se aqui</a></p>
			</div>
		</div>
		</div>	
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>