<?php
    //echo "ola";
    include("../conecta.php");
    $area =$_POST['area'];
    //echo $area;

    $palavras = explode(" ",$area);

    $sql = 'SELECT  CONCAT (professor.area_atuante1," ",professor.area_atuante2," ",professor.area_atuante3) AS area_atuante, usuarios.nome  FROM usuarios, professor '
        . "WHERE usuarios.idusuarios = professor.idusuarios";

    $resultado = mysqli_query($conexao,$sql);
    //$rank = [][];

    while ($dados = mysqli_fetch_assoc($resultado)) {
        $rank []['nome'] = $dados['nome'];
        $i = sizeof($rank)-1;
        $palavras_area = explode(" ",$dados['area_atuante']);
        $cont = 0;
        foreach($palavras as $palavra){
            foreach($palavras_area as $palavra_area){
                if (strcasecmp($palavra,$palavra_area) ==  0) {
                    $cont++;
                }
            }

        } 
        $rank [$i]['valor'] = $cont;
        
    }
    foreach($rank as $chave => $valor){
        $nomes[$chave] = $valor['nome'];
        $valores[$chave] = $valor['valor'];
    }
    array_multisort($valores, SORT_DESC, $nomes, SORT_ASC, $rank);

    echo "1º ".$rank[0] ['nome']."<br>";
    echo "2º ".$rank[1] ['nome']." <br>";
    echo "3º ".$rank[2] ['nome'];
    //var_dump($rank);die;
    //echo json_encode($rank);

?>