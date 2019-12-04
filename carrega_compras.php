<?php
    header("Content-type: application/json");
    session_start();
    include("conexao.php");

    $p= $_POST["pg"];

    $sql = "SELECT * FROM compras 
     INNER JOIN usuario
            ON compras.cod_usuario=usuario.id_usuario AND usuario.id_usuario='".$_SESSION["autorizado"]."'            
                        LEFT JOIN picole 
                        ON compras.cod_picole=picole.id_picole
                        LEFT JOIN sorvete
                        ON compras.cod_sorvete=sorvete.id_sorvete
                        LEFT JOIN milkshake
                        ON compras.cod_milkshake=milkshake.id_milkshake
                        LEFT JOIN acai
                        ON compras.cod_acai=acai.id_acai";

    if(isset($_POST["nome_filtro"]))
    {
        $nome = $_POST["nome_filtro"];
		$sql .= " WHERE picole.sabor_picole LIKE '%$nome%' OR sorvete.sabor LIKE '%$nome%' OR acai.tipo LIKE '%$nome%' OR milkshake.sabor_m LIKE '%$nome%'";
    }

    $sql .= " ORDER BY cod_picole LIMIT $p,5";
    $resultado = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
    while($linha=mysqli_fetch_assoc($resultado))
    {
        $matriz[]=$linha;
    }

    echo json_encode($matriz);




?>