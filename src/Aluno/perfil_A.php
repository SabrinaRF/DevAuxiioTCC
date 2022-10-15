<?php

    echo '<meta charset="UTF-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 0 ) {
        $usuario = $_SESSION["UsuarioNome"];
        $id = $_SESSION["IDusuario"];
    } else {
        header("Location:../index.php");
    }

    include("../conecta.php");

    if(isset($_POST["nome"])){
        $nome = $_POST["nome"];
    }
    if(isset($_POST["user"])){
        $user = $_POST["user"];
    }
    $email= $_POST["email"];
    $cpf = $_POST["cpf"];
    $matricula = $_POST["matricula"];
    $curso = $_POST["curso"];      

    
    if (empty($nome)) {
        if (empty($user)) {
            if (empty($email)) {
                if (empty($cpf))  {
                    if (empty($matricula)) {
                        if (empty($curso)) {

                            $_SESSION['erro'] = "Erro em tudo !";
                            header("Location:GerenPerfil_A.php");
            
                        } else {
                            $sql= "UPDATE `aluno` SET `curso`=\"$curso\" WHERE `idusuarios`=\"$id\"";
                            mysqli_query($conexao,$sql);
    
                            $linhasAfetadas = mysqli_affected_rows($conexao);
    
                            if($linhasAfetadas > 0){
                                $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                                header("Location:GerenPerfil_A.php");
                            }else {
                                $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                                header("Location:GerenPerfil_A.php");
                            }  
                        }
        
                    } else {
                        $sql= "UPDATE `aluno` SET `matricula`=\"$matricula\" WHERE `idusuarios`=\"$id\"";
                        mysqli_query($conexao,$sql);

                        $linhasAfetadas = mysqli_affected_rows($conexao);

                        if($linhasAfetadas > 0){
                            $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                            header("Location:GerenPerfil_A.php");
                        }else {
                            $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                            header("Location:GerenPerfil_A.php");
                        }  
                    }
                } else {
                    $sql= "UPDATE `usuarios` SET `cpf`=\"$cpf\" WHERE `idusuarios`=\"$id\"";
                    mysqli_query($conexao,$sql);

                    $linhasAfetadas = mysqli_affected_rows($conexao);

                    if($linhasAfetadas > 0){
                        $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                        header("Location:GerenPerfil_A.php");
                    }else {
                        $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                        header("Location:GerenPerfil_A.php");
                    }  
                }
            } else {
                $sql= "UPDATE `usuarios` SET `email`=\"$email\" WHERE `idusuarios`=\"$id\"";
                mysqli_query($conexao,$sql);

                $linhasAfetadas = mysqli_affected_rows($conexao);

                if($linhasAfetadas > 0){
                    $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                    header("Location:GerenPerfil_A.php");
                }else {
                    $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                    header("Location:GerenPerfil_A.php");
                }  
            }
        } else {

            $sql= "UPDATE `usuarios` SET `user`=\"$user\" WHERE `idusuarios`=\"$id\"";
            mysqli_query($conexao,$sql);

            $linhasAfetadas = mysqli_affected_rows($conexao);

            if($linhasAfetadas > 0){
                $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                header("Location:GerenPerfil_A.php");
            }else {
                $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                header("Location:GerenPerfil_A.php");
            }  
        }
    } else {
        
        $sql= "UPDATE `usuarios` SET `nome`=\"$nome\" WHERE `idusuarios`=\"$id\"";
        mysqli_query($conexao,$sql);

        $linhasAfetadas = mysqli_affected_rows($conexao);

        if($linhasAfetadas > 0){
            $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
            header("Location:GerenPerfil_A.php");
        }else {
            $_SESSION['erro'] = "Erro ao efetuar a alteração !";
            header("Location:GerenPerfil_A.php");
        }      
    }
    
    
    
    
?>