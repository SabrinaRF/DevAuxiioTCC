<?php

  include("../../conecta.php");
  session_start();
  $pasta = "arquivos/";

  $caminho = $pasta . basename($_FILES["arquivo"]["name"]);
  $uploadOk = 1;
  $extencao = strtolower(pathinfo($caminho,PATHINFO_EXTENSION));
  
  
    $nome= $_POST["nome_arq"];
    $filenome = $_FILES["arquivo"]["name"];
    $tipo= $_POST["tipo"];
  

    if (file_exists($caminho)) {
      $_SESSION['ErroDados'] = "Desculpe, o arquivo já existe!";
      header("Location:../formupload.php");
      $uploadOk = 0;

    }
    if ($_FILES["arquivo"]["size"] > 5242880) {
      $_SESSION['ErroDados'] = "Desculpe, o arquivo é grande demais.";
      header("Location:../formupload.php");
      $uploadOk = 0;

    }
    if ($extencao != "pdf" && $extencao != "odt" && $extencao != "docx" && $extencao != "doc") {
      $_SESSION['ErroDados'] = "Desculpa, extenção errada ";
      header("Location:../formupload.php");
      $uploadOk = 0;

    }
    if ($uploadOk == 0) {
      $_SESSION['ErroDados'] = "Verifique seu arquivo.";
      header("Location:../formupload.php");

    }else{
        if (move_uploaded_file($_FILES["arquivo"]["tmp_name"],$caminho)) {

        $sql= "INSERT INTO `documento`( `nome`, `filenome`, `tipo`) VALUES (\"$nome\",\"$filenome\",\"$tipo\")";
        mysqli_query($conexao,$sql);
              
        $linhasAfetadas = mysqli_affected_rows($conexao);
        
        if($linhasAfetadas > 0){
          $_SESSION['Sucesso'] = "O arquivo ". htmlspecialchars( basename( $_FILES["arquivo"]["name"])). " fez upload.";;
          header("Location:../formupload.php");
        }else{
          $_SESSION['ErroDados'] = "Erro nenhuma linha afetada";
          header("Location:../formupload.php");
        }

      } else {
        $_SESSION['ErroDados'] = "Erro ao mover o arquivo.";
        header("Location:../formupload.php");
      }
    }
    
  

  

?>