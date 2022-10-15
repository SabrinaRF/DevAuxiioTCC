<?php

    echo '<meta charset="UTF-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 1 ) {
        $usuario = $_SESSION["UsuarioNome"];
        $id = $_SESSION["IDusuario"];
    } else {
        header("Location:../index.php");
    }

    include("../conecta.php");

    $nome = $_POST["nome"];
    $user = $_POST["user"];
    $email= $_POST["email"];
    $cpf = $_POST["cpf"];
    if(isset($_POST["atuacao1"])){
        $atuacao1 = $_POST["atuacao1"];
    }
    if(isset($_POST["atuacao2"])){
        $atuacao2 = $_POST["atuacao2"];
    }
    if(isset($_POST["atuacao3"])){
        $atuacao3 = $_POST["atuacao3"];
    }

    if (empty($nome)) {
        if (empty($user)) {
            if (empty($email)) {
                if (empty($cpf)) {
                    if (empty($atuacao1)) {
                        if (empty($atuacao2)) {
                            if (empty($atuacao3)) {

                                $_SESSION['erro'] = "Erro em tudo !";
                                header("Location:GerenPerfil_P.php");
                
                            } else {
                                $sql= "UPDATE `professor` SET `area_atuante3`=\"$atuacao3\" WHERE `idusuarios`=\"$id\"";
                                mysqli_query($conexao,$sql);
        
                                $linhasAfetadas = mysqli_affected_rows($conexao);
        
                                if($linhasAfetadas > 0){
                                    $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                                    header("Location:GerenPerfil_P.php");
                                }else {
                                    $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                                    header("Location:GerenPerfil_P.php");
                                }  
                            }
            
                        } else {
                            $sql= "UPDATE `professor` SET `area_atuante2`=\"$atuacao2\" WHERE `idusuarios`=\"$id\"";
                            mysqli_query($conexao,$sql);
    
                            $linhasAfetadas = mysqli_affected_rows($conexao);
    
                            if($linhasAfetadas > 0){
                                $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                                header("Location:GerenPerfil_P.php");
                            }else {
                                $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                                header("Location:GerenPerfil_P.php");
                            }  
                        }
        
                    } else {
                        $sql= "UPDATE `professor` SET `area_atuante1`=\"$atuacao1\" WHERE `idusuarios`=\"$id\"";
                        mysqli_query($conexao,$sql);

                        $linhasAfetadas = mysqli_affected_rows($conexao);

                        if($linhasAfetadas > 0){
                            $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                            header("Location:GerenPerfil_P.php");
                        }else {
                            $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                            header("Location:GerenPerfil_P.php");
                        }  
                    }
                } else {
                    $sql= "UPDATE `usuarios` SET `cpf`=\"$cpf\" WHERE `idusuarios`=\"$id\"";
                    mysqli_query($conexao,$sql);

                    $linhasAfetadas = mysqli_affected_rows($conexao);

                    if($linhasAfetadas > 0){
                        $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                        header("Location:GerenPerfil_P.php");
                    }else {
                        $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                        header("Location:GerenPerfil_P.php");
                    }  
                }
            } else {
                $sql= "UPDATE `usuarios` SET `email`=\"$email\" WHERE `idusuarios`=\"$id\"";
                mysqli_query($conexao,$sql);

                $linhasAfetadas = mysqli_affected_rows($conexao);

                if($linhasAfetadas > 0){
                    $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                    header("Location:GerenPerfil_P.php");
                }else {
                    $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                    header("Location:GerenPerfil_P.php");
                }  
            }
        } else {

            $sql= "UPDATE `usuarios` SET `user`=\"$user\" WHERE `idusuarios`=\"$id\"";
            mysqli_query($conexao,$sql);

            $linhasAfetadas = mysqli_affected_rows($conexao);

            if($linhasAfetadas > 0){
                $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
                header("Location:GerenPerfil_P.php");
            }else {
                $_SESSION['erro'] = "Erro ao efetuar a alteração !";
                header("Location:GerenPerfil_P.php");
            }  
        }
    } else {
        
        $sql= "UPDATE `usuarios` SET `nome`=\"$nome\" WHERE `idusuarios`=\"$id\"";
        mysqli_query($conexao,$sql);

        $linhasAfetadas = mysqli_affected_rows($conexao);

        if($linhasAfetadas > 0){
            $_SESSION['alterado'] = "Alteração efetuada com sucesso!";
             header("Location:GerenPerfil_P.php");
        }else {
            $_SESSION['erro'] = "Erro ao efetuar a alteração !";
             header("Location:GerenPerfil_P.php");
        }      
    }
    
?>