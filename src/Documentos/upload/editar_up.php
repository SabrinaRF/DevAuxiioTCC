<?php

    echo '<meta charset="UTF-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
        $usuario = $_SESSION["UsuarioNome"];
    } else {
        header("Location:../../index.php");
    }
    include("../../conecta.php");

////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $id = $_POST["id"];
    $edtnome = $_POST["nome_arq"];
    $edtfile= $_FILES["arquivo"]["name"];
    $edttipo = $_POST["tipo"];

    $sql= "SELECT * FROM `documento` WHERE `iddocumento` = \"$id\"";
    $resultado = mysqli_query($conexao,$sql);
    $dados= mysqli_fetch_assoc($resultado);

    $pasta = "arquivos/";
    $caminho2 = $pasta . basename($dados['filenome']);
    $nomeAntigo = $dados['filenome'];
    
    if (file_exists($caminho2)) {       

        $caminho = $pasta . basename($_FILES["arquivo"]["name"]);
        $uploadOk = 1;
        $extencao = strtolower(pathinfo($caminho,PATHINFO_EXTENSION));

        if (file_exists($caminho)) {
            $_SESSION['Erro'] = "Desculpe, o arquivo já existe!";
            header("Location:../DocumentosC.php");
            $uploadOk = 0;
        
        }
        if ($_FILES["arquivo"]["size"] > 5242880) {
            $_SESSION['Erro'] = "Desculpe, o arquivo é grande demais.";
            header("Location:../DocumentosC.php");
            $uploadOk = 0;
    
        }
        if ($extencao != "pdf" && $extencao != "odt" && $extencao != "docx" && $extencao != "doc") {
            $_SESSION['Erro'] = "Desculpa, extenção errada ";
            header("Location:../DocumentosC.php");
            $uploadOk = 0;
    
        }
        if ($uploadOk == 0) {
            $_SESSION['Erro'] = "Verifique seu arquivo.";
            header("Location:../DocumentosC.php");
    
        }else{

            if (move_uploaded_file($_FILES["arquivo"]["tmp_name"],$caminho)) {

                $sql = "UPDATE `documento` SET `nome`=\"$edtnome\", `filenome`=\"$edtfile\", `tipo`=\"$edttipo\" WHERE `iddocumento`=\"$id\"";
                mysqli_query($conexao,$sql);

                $linhasAfetadas = mysqli_affected_rows($conexao);

                if($linhasAfetadas > 0){
                    
                    $deletado = unlink('arquivos/'.$nomeAntigo.'');
                    $_SESSION['Sucesso'] = "Documento editado com sucesso!";
                    header("Location:../DocumentosC.php");
                } else {
                    $_SESSION['Erro'] ="Erro ao editar no bd o arquivo!";
                    header("Location:../DocumentosC.php");
                }
                
            } else {
                $_SESSION['Erro'] = "Erro ao mover o arquivo.";
                header("Location:../DocumentosC.php");
            }
        }   
    } else {
        $_SESSION['Erro'] = "Desculpe, este arquivo não existe!";
        header("Location:../DocumentosC.php");
    } 
    





















































































































    /*
    $sql= "SELECT * FROM `documento` WHERE `iddocumento` = \"$id\"";
    $resultado = mysqli_query($conexao,$sql);
    $dados= mysqli_fetch_assoc($resultado);
    
    $pasta = "arquivos/";
    $caminho = $pasta . basename($dados['filenome']);

    if (file_exists($caminho)) {

        $deletado = unlink('arquivos/'.$dados['filenome'].'');
        if ($deletado == 1) {
    

            $sql = "UPDATE `documento` SET `nome`=\"$nome\", `tipo`=\"$tipo\" WHERE `iddocumento`=$id";
            mysqli_query($conexao,$sql);

            $linhasAfetadas = mysqli_affected_rows($conexao);

            if($linhasAfetadas > 0){

                $caminho = $pasta . basename($_FILES["arquivo"]["name"]);
                $uploadOk = 1;
                $extencao = strtolower(pathinfo($caminho,PATHINFO_EXTENSION));

                
                if ((isset($_FILES["arquivo"]["name"]))) {
    
                    $filenome = $_FILES["arquivo"]["name"];
                
                    if (file_exists($caminho)) {
                    $_SESSION['Erro'] = "Desculpe, o arquivo já existe!";
                    header("Location:../DocumentosC.php");
                    $uploadOk = 0;

                    } else if ($_FILES["arquivo"]["size"] > 5242880) {
                        $_SESSION['Erro'] = "Desculpe, o arquivo é grande demais.";
                        header("Location:../DocumentosC.php");
                        $uploadOk = 0;

                    } else if ($extencao != "pdf" && $extencao != "odt" && $extencao != "docx") {
                        $_SESSION['Erro'] = "Desculpa, extenção errada ";
                        header("Location:../DocumentosC.php");
                        $uploadOk = 0;

                    } else if ($uploadOk == 0) {
                        $_SESSION['Erro'] = "Erro ao fazer upload.";
                        header("Location:../DocumentosC.php");

                        } else {

                            if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $caminho)) {

                                $sql = "UPDATE `documento` SET `filenome`=\"$filenome\" WHERE `iddocumento`=$id";
                                mysqli_query($conexao,$sql);
                                        
                                $linhasAfetadas = mysqli_affected_rows($conexao);
                                
                                if($linhasAfetadas > 0){
                                    $_SESSION['Sucesso'] = "O arquivo ". htmlspecialchars( basename( $_FILES["arquivo"]["name"])). " fez upload.";;
                                    header("Location:../DocumentosC.php");
                                }else{
                                    $_SESSION['Erro'] = "Erro nenhuma linha afetada";
                                    header("Location:../DocumentosC.php");
                                }

                            } else {
                            $_SESSION['Erro'] = "Erro ao fazer o Upload.";
                            header("Location:../DocumentosC.php");
                            }
                        }

                }else{//
                    $_SESSION['ErroDados'] = "Campo Inválido..";
                    header("Location:../formupload.php");

                } 

            } else {
                $_SESSION['Erro'] ="Erro ao ediatar o arquivo!";
                header("Location:../DocumentosC.php");
            }
        }else {
            $_SESSION['Erro'] = "Erro ao editar o arquivo!";    
            header("Location:../DocumentoC.php");  
        }
    }else {
        $_SESSION['Erro'] = "Erro ao editar o arquivo!";    
    header("Location:../DocumentoC.php");
    }
*/
   
    
?>