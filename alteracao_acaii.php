<?php

    include("conexao.php");

    $id = $_POST["id"];
    $tipo = $_POST["tipo"];
    $preco = $_POST["preco"];
    $recipiente = $_POST["recipiente"];
    

    $update = "UPDATE acai SET tipo = '$tipo', 
                                   preco = '$preco', 
                                   recipiente = '$recipiente'
                WHERE id_acai='$id'";

    mysqli_query($conexao,$update) or die(mysqli_error($conexao));
			
			
		echo "1";
?>