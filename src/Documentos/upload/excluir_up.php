<?php

    echo '<meta charset="UTF-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
        $usuario = $_SESSION["UsuarioNome"];
    } else {
        header("Location:../../index.php");
    }

    include("../../conecta.php");

    $id = $_GET["id"];

    $sql= "SELECT * FROM `documento` WHERE `iddocumento` = \"$id\"";
    $resultado = mysqli_query($conexao,$sql);
    $dados= mysqli_fetch_assoc($resultado);

    $pasta = "arquivos/";
    $caminho = $pasta . basename($dados['filenome']);

    if (file_exists($caminho)) {
        $deletado = unlink('arquivos/'.$dados['filenome'].'');
            if ($deletado == 1) {
                
                        $sql = "DELETE FROM `documento` WHERE `iddocumento`= \"$id\"";
                        mysqli_query($conexao,$sql);

                        $linhasAfetadas = mysqli_affected_rows($conexao);

                        if($linhasAfetadas > 0){
                            $_SESSION['Sucesso'] ="Arquivo excluído com sucesso!";
                            header("Location:../DocumentosC.php");
                        } else {
                            $_SESSION['Erro'] ="Erro ao excluir o arquivo!";
                            header("Location:../DocumentosC.php");
                        }

            } else {
            }
                
    } else {
        $sql = "DELETE FROM `documento` WHERE `iddocumento`= \"$id\"";
        mysqli_query($conexao,$sql);

        $linhasAfetadas = mysqli_affected_rows($conexao);

        if($linhasAfetadas > 0){
            $_SESSION['Sucesso'] ="Arquivo excluído com sucesso!";
            header("Location:../DocumentosC.php");
        } else {
            $_SESSION['Erro'] ="Erro ao excluir o arquivo!";
            header("Location:../DocumentosC.php");
        }
        
    } 
    
    
    
    

?>