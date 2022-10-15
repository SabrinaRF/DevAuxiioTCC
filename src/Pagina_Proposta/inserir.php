<?php

    echo '<meta charset="UTF-8">';

    session_start();
    if (isset($_SESSION["UsuarioNome"]) and $_SESSION["UsuarioNivel"] == 0 ) {
        $usuario = $_SESSION["UsuarioNome"];
        $id =$_SESSION['IDusuario'];
    } else {
        header("Location:../index.php");
    }
    
    include("../conecta.php");

    $area1 = $_POST["area1"];
    $area2 = $_POST["area2"];
    $area3 = $_POST["area3"];
    $proposta = $_POST["proposta"];
    $ori_1 = $_POST["ori_1"];
    $ori_2 = $_POST["ori_2"];
    $ori_3 = $_POST["ori_3"];
    //variavel vazia
    $vazia = 0;


    if ((empty($area1)) or (empty($proposta)) or (empty($ori_1)) or (empty($ori_2)) or (empty($ori_3))){ 
           
        $_SESSION['ErroDados'] = "Preencha todos os campos!";
        header("Location:forminserir.php");
    }else{

        $sql2 = "SELECT idaluno FROM `aluno` WHERE `idusuarios`= \"$id\"";
        $resultado2 = mysqli_query($conexao,$sql2);
        $dados= mysqli_fetch_assoc($resultado2);
        $idalu = $dados["idaluno"];

        $sql3 = "SELECT * FROM `proposta` WHERE `idaluno`= \"$idalu\"";
        $resultado3 = mysqli_query($conexao,$sql3);
        $linhasAfetadas = mysqli_affected_rows($conexao);

        if ($linhasAfetadas > 0 ) {
            
            $_SESSION['alternativo'] = "Já possui um proposta cadastrada!";
            header("Location:forminserir.php");      
        } else {
            $sql = "INSERT INTO `proposta`(`area1`,`area2`,`area3`, `proposta`, `orientador1`, `orientador2`, `orientador3`, `orientador_def`, `idaluno`) VALUES (\"$area1\",\"$area2\",\"$area3\",\"$proposta\",\"$ori_1\",\"$ori_2\",\"$ori_3\",\"$vazia\",\"$idalu\")";

            mysqli_query($conexao,$sql);

            $linhasAfetadas = mysqli_affected_rows($conexao);

            if($linhasAfetadas > 0){

                $_SESSION['Cadastrado'] = "Proposta cadastrada!";
                header("Location:forminserir.php");
            } else {  
                
                $_SESSION['ErroDados'] = "Dados inválido!";
                header("Location:forminserir.php");
            }
        }   
    }
    
?>