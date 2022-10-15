<?php

    echo '<meta charset="UTF-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 2 ) {
        $usuario = $_SESSION["UsuarioNome"];
        $id = $_SESSION["IDusuario"];
    } else {
        header("Location:../index.php");
    }

  include("../conecta.php");

    $sql= "SELECT * FROM `usuarios` WHERE `idusuarios` = \"$id\"";
    $resultado = mysqli_query($conexao,$sql);
    $dados= mysqli_fetch_assoc($resultado);

    $nomeAntigo = $dados['imgnome'];
  
    $pasta = "../Professor/arquivos_img/";

    $caminho = $pasta . basename($_FILES["arquivo"]["name"]);
    $uploadOk = 1;
    $extencao = strtolower(pathinfo($caminho,PATHINFO_EXTENSION));
  
    $imgnome = $_FILES["arquivo"]["name"];

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["arquivo"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }
      }

    if (file_exists($caminho)) {
      $uploadOk = 0;

    }
    if ($_FILES["arquivo"]["size"] > 5242880) {
      $uploadOk = 0;

    }
    if ($extencao != "png" && $extencao != "jpeg" && $extencao != "jpg") {
      $uploadOk = 0;

    }
    if ($uploadOk == 0) {
      $_SESSION['erro'] = "Verifique a extensão (PNG, JPEG ou JPG) ou o tamanho do arquivo (máx. 5MB).";
      header("Location:GerenPerfil_C.php");

    }else{
        if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $caminho)) {

        $sql= "UPDATE `usuarios` SET `imgnome`=\"$imgnome\" WHERE `idusuarios`=\"$id\"";
        mysqli_query($conexao,$sql);
              
        $linhasAfetadas = mysqli_affected_rows($conexao);
        
        if($linhasAfetadas > 0){

            if ($nomeAntigo == "perfil.png") {

              $_SESSION['alterado'] = "Foto alterada com sucesso!";;
              header("Location:GerenPerfil_C.php");
            }else {

              $deletado = unlink('arquivos_img/'.$nomeAntigo.'');
              $_SESSION['alterado'] = "Foto alterada com sucesso!";;
              header("Location:GerenPerfil_C.php");
            }
            
        }else{
          $_SESSION['erro'] = "Erro nenhuma linha afetada";
          header("Location:GerenPerfil_C.php");
        }

      } else {
        $_SESSION['erro'] = "Erro ao mover o arquivo.";
        header("Location:GerenPerfil_C.php");
      }
    }
    
  


?>