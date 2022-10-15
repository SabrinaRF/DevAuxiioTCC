<?php
$relatorio = $_GET["relatorio"];
   if(isset($relatorio) && file_exists($relatorio)){
   // faz o teste se a variavel não esta vazia e se o arquivo realmente existe
      switch(strtolower(substr(strrchr(basename($relatorio),"."),1))){
      // verifica a extensão do arquivo para pegar o tipo
         case "pdf": $tipo="application/pdf"; break;     
      }    
    }
      header("Content-Type: ".$tipo);
      // informa o tipo do arquivo ao navegador
      header("Content-Length: ".filesize($relatorio));
      // informa o tamanho do arquivo ao navegador
      header("Content-Disposition: attachment; filename=".basename($relatorio));
      // informa ao navegador que é tipo anexo e faz abrir a janela de download,
      //tambem informa o nome do arquivo
      readfile($relatorio); // lê o arquivo
      exit; // aborta pós-ações

?>