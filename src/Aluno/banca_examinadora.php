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
	<link rel="stylesheet" href="../Cronograma/estilo_cronograma.css">
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

    <!-- Container do Corpo do Página (Aluno) -->
    <div class="container  pt-5 mt-5" >
        <h1 class="mt-5 pt-2">
        Banca examinadora
        <small class="text-muted"><br>Banca examinadora do aluno(a) <?php echo $nome_aluno;?>.</small>
        </h1>

    <?php
            $sql="SELECT proposta.orientador_def, banca.`examinador1`, banca.`examinador2`, banca.`examinador3` "
                ."FROM `banca`,`proposta`,`aluno` WHERE proposta.idproposta=banca.idproposta AND aluno.idaluno=proposta.idaluno "
                ."AND aluno.idaluno = \"$id_aluno\"";
			$resultado = mysqli_query($conexao,$sql);
			$qtd = mysqli_num_rows($resultado);

			if($qtd == 0){
				echo '<p class="lead"> Ainda não existe uma banca examinadora cadastrada no sistema. </p>';
			} else {
				echo'<a class="btn btn-outline-info" href="docbanca.php" role="button">Enviar documento para banca</a><br><br>';
				
				/*$dados = mysqli_fetch_assoc($resultado);
				
				$ori_def = $dados["orientador_def"];
				$exa1 = $dados["examinador1"];
				$exa2 = $dados["examinador2"];
				$exa3 = $dados["examinador3"];
				$sql = "SELECT usuarios.nome,proposta.orientador_def, banca.`examinador1`, banca.`examinador2`, banca.`examinador3` \n"

				. "                FROM `banca`,`proposta`,`aluno`,usuarios,professor WHERE proposta.idproposta=banca.idproposta AND aluno.idaluno=proposta.idaluno AND usuarios.idusuarios=professor.idusuarios AND professor.idprofessor=banca.examinador1 \n"

				. "                AND aluno.idaluno = 70";

				$sql = "SELECT usuarios.nome FROM usuarios,professor WHERE usuarios.idusuarios=professor.idusuarios\n"

				. "                AND professor.idprofessor = 2";

				//$sql = "SELECT usuarios.nome FROM `professor`,usuarios WHERE usuarios.idusuarios=professor.idusuarios AND`idprofessor`IN(\"$ori_def\",\"$exa1\",\"$exa2\",\"$exa3\")";
				//$resultado = mysqli_query($conexao,$sql);
				//$dados = mysqli_fetch_assoc($resultado);
				
					$sql = "SELECT usuarios.nome FROM usuarios,professor WHERE usuarios.idusuarios=professor.idusuarios AND professor.idprofessor = \"$id\"";
					
				*/

				echo '<table class="table  table-hover ">';
				echo '<thead scope="col"> <tr> <th scope="col" >#</th> '.' <th scope="col">ORIENTADOR</th> '.'<th scope="col">EXAMINADOR 1</th> '.'<th scope="col">EXAMINADOR 2</th>'.'<th scope="col">EXAMINADOR 3 (Suplente)</th>  </tr> </thead>';
				$n= 1 ;
				while ($dados = mysqli_fetch_assoc($resultado)) {
					
					echo '<tbody>';
					echo '<tr>';
					echo '<th scope="row">'.$n.'</th>';

						$id = $dados['orientador_def'] ;
						$sql1 = "SELECT usuarios.nome FROM usuarios,professor WHERE usuarios.idusuarios=professor.idusuarios AND professor.idprofessor = \"$id\"";
						$resultado1 = mysqli_query($conexao,$sql1);
						$dados1 = mysqli_fetch_assoc($resultado1);
					
					echo '<td>'. $dados1['nome'] .'</td>';

						$id = $dados['examinador1'] ;
						$sql1 = "SELECT usuarios.nome FROM usuarios,professor WHERE usuarios.idusuarios=professor.idusuarios AND professor.idprofessor = \"$id\"";
						$resultado1 = mysqli_query($conexao,$sql1);
						$dados1 = mysqli_fetch_assoc($resultado1);
					
					echo '<td>'. $dados1['nome'] .'</td>';

						$id = $dados['examinador2'] ;
						$sql1 = "SELECT usuarios.nome FROM usuarios,professor WHERE usuarios.idusuarios=professor.idusuarios AND professor.idprofessor = \"$id\"";
						$resultado1 = mysqli_query($conexao,$sql1);
						$dados1 = mysqli_fetch_assoc($resultado1);

					echo '<td>'. $dados1['nome'] .'</td>';

						$id = $dados['examinador3'] ;
						$sql1 = "SELECT usuarios.nome FROM usuarios,professor WHERE usuarios.idusuarios=professor.idusuarios AND professor.idprofessor = \"$id\"";
						$resultado1 = mysqli_query($conexao,$sql1);
						$dados1 = mysqli_fetch_assoc($resultado1);
					
					echo '<td>'. $dados1['nome'] .'</td>';
					echo '</tr>';
					echo '<tbody>';
					$n++;
				}
				echo'</table>';
			}
    ?>
	
</div>

    <!-- Containers Footer -->
	<div class="container fixed-bottom">
	    <hr class="mb-4 ">
       
        <footer>
    	
		<div class="row mb-4">
            <div class="col lg-10 md-10 sm-10  text-center pt-3">
              
                  <p class="text-secondary">&copy; Copyright 2020 - Sistema de Auxílio à Orientação de TCC | Desenvolvido por Sabrina Rodrigues Fernandes</p>
            </div>
            <div class="lg-2 md-2 sm-2 text-right pt-3">
      
                  <a href="PaginaInicial_Aluno.php">Voltar ao Início</a>
            </div>   
        </div>    
        </footer>
        
    </div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>