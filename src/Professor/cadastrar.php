<?php

    echo '<meta charset="UTF-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
        $usuario = $_SESSION["UsuarioNome"];
    } else {
        header("Location:../index.php");
    }

    include("../conecta.php");


    $nome = $_POST["nome"];
    $user = $_POST["user"];
    $email= $_POST["email"];
    $cpf= $_POST["cpf"];
    $atuacao1= $_POST["atuacao1"];
    $atuacao2= $_POST["atuacao2"];
    $atuacao3= $_POST["atuacao3"];
    $senha= $_POST["senha"];
    $confSenha= $_POST["confirma_senha"];
    $nivel = 1;
    $imgnome = "perfil.png";

        if ((empty($nome)) or (empty($user)) or (empty($email)) or (empty($cpf)) or (empty($atuacao1)) or (empty($senha)) or (empty($confSenha))) {    
        
        $_SESSION['ErroDados'] = "Campos Obrigatórios";
        header("Location:formcadastrar.php");
    } else {
   
        if ($senha != $confSenha) {

            $_SESSION['ErroDados'] = " Senha inválida";
            header("Location:formcadastrar.php");

        } else {
           
            $senha = md5($senha);

            $sql= "SELECT `user` FROM `usuarios` WHERE `user`= \"$user\"";
            mysqli_query($conexao,$sql);

            $linhasAfetadas = mysqli_affected_rows($conexao);
            if($linhasAfetadas > 0){

                $_SESSION['alternativo'] = "O nome de usuário $user não pode ser usado!";
                header("Location:formcadastrar.php");
            }else {

                $sql1 = "INSERT INTO `usuarios`(`nome`, `user`, `email`, `cpf`,`senha`,`imgnome`,`nivel`) VALUES (\"$nome\",\"$user\",\"$email\",\"$cpf\",\"$senha\",\"$imgnome\",\"$nivel\")"; 
                mysqli_query($conexao,$sql1);
                
                $linhasAfetadas = mysqli_affected_rows($conexao);

                if($linhasAfetadas > 0){

                    $idusu = mysqli_insert_id($conexao);
                    $sql2= "INSERT INTO `professor` (`area_atuante1`,`area_atuante2`,`area_atuante3`,`vagas`,`idusuarios`) VALUES (\"$atuacao1\",\"$atuacao2\",\"$atuacao3\",\"0\",\"$idusu\")";
                    mysqli_query($conexao,$sql2);

                    $_SESSION['Cadastrado'] = "Professor cadastrado com sucesso!";
                    header("Location:formcadastrar.php");
                } else {  
                    $_SESSION['ErroDados'] = "Dados inválido!";
                    header("Location:formcadastrar.php");
                }
                
            }
        }
    }
?>