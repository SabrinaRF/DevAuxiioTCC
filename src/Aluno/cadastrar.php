<?php

    echo '<meta charset="UTF-8">';

    include("../conecta.php");
    session_start();

    $nome = $_POST["nome"];
    $user = $_POST["user"];
    $email= $_POST["email"];
    $cpf= $_POST["cpf"];
    $matricula= $_POST["matricula"];
    $curso= $_POST["curso"];
    $senha= $_POST["senha"];
    $confSenha= $_POST["confirma_senha"];
    $nivel = 0;
    $imgnome = "perfil.png";
        
    if ((empty($nome)) or (empty($user)) or (empty($email)) or (empty($cpf)) or (empty($matricula)) or (empty($curso)) or (empty($senha)) or (empty($confSenha))) {    
        
        $_SESSION['ErroDados'] = "Preencha todos os campos!";
        header("Location:formcadastrar.php");
    } else {
        
        if ($senha != $confSenha) {

                $_SESSION['ErroDados'] = " Senha inválida!";
                header("Location:formcadastrar.php");

        } else {

            $senha = md5($senha);

            $sql= "SELECT `user` FROM `usuarios` WHERE `user`= \"$user\"";
            mysqli_query($conexao,$sql);

            $linhasAfetadas = mysqli_affected_rows($conexao);
            if($linhasAfetadas > 0){

                $_SESSION['alternativo'] = "O nome de usuário <strong>$user </strong>não pode ser usado!";
                header("Location:formcadastrar.php");
            }else {
                $sql = "INSERT INTO `usuarios`(`nome`, `user`, `email`, `cpf`, `imgnome`,`senha`,`nivel`) VALUES (\"$nome\",\"$user\",\"$email\",\"$cpf\",\"$imgnome\",\"$senha\",\"$nivel\")"; 
                mysqli_query($conexao,$sql);
                
                $linhasAfetadas = mysqli_affected_rows($conexao);
                
                if($linhasAfetadas > 0){
                    
                    $idusu = mysqli_insert_id($conexao);
                    $sql2 = "INSERT INTO `aluno` (`matricula`, `curso`, `idusuarios`) VALUES (\"$matricula\",\"$curso\",\"$idusu\")";
                    mysqli_query($conexao,$sql2);

                    $_SESSION['Cadastrado'] = "Aluno cadastrado!";
                    header("Location:../index.php");
                } else { 

                    $_SESSION['ErroDados'] = "Erro no cadastro!";
                    header("Location:formcadastrar.php");
                }
                
            }
            
        }    
    }
?>
