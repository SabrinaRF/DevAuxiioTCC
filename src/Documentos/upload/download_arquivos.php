<?php
$arquivo = $_GET["arquivo"];
   if(isset($arquivo) && file_exists($arquivo)){
   // faz o teste se a variavel não esta vazia e se o arquivo realmente existe
      switch(strtolower(substr(strrchr(basename($arquivo),"."),1))){
      // verifica a extensão do arquivo para pegar o tipo
         case "pdf": $tipo="application/pdf"; break;
         case "doc": $tipo="application/msword"; break; 
         case "docx": $tipo="application/msword"; break;  
         case "otd": $tipo="application/msword"; break;      
      }    
      }
      header("Content-Type: ".$tipo);
      // informa o tipo do arquivo ao navegador
      header("Content-Length: ".filesize($arquivo));
      // informa o tamanho do arquivo ao navegador
      header("Content-Disposition: attachment; filename=".basename($arquivo));
      // informa ao navegador que é tipo anexo e faz abrir a janela de download,
      //tambem informa o nome do arquivo
      readfile($arquivo); // lê o arquivo
      exit; // aborta pós-ações

?>