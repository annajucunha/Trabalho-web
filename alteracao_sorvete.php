<?php

    include("conexao.php");

    $id = $_POST["id"];
    $sabor = $_POST["sabor"];
    $preco = $_POST["preco"];
    $recipiente = $_POST["recipiente"];
    

    $update = "UPDATE sorvete SET sabor = '$sabor', 
                                   preco = '$preco', 
                                   recipiente = '$recipiente'
                WHERE id_sorvete='$id'";

    mysqli_query($conexao,$update) or die(mysqli_error($conexao));
			
			
		echo "1";
?>