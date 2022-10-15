<?php
	$bdServidor = 'localhost:3307';
	$bdUsuario = 'root';
	$bdSenha = '';
	$bdBanco = 'sistema';
	$conexao = mysqli_connect($bdServidor,$bdUsuario,$bdSenha,$bdBanco);

	if($conexao  === false)
	{
		echo "problemas para conectar no banco. Erro: ";
		echo mysqli_connect_error();
	}
?>
