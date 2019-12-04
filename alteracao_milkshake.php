<?php

    include("conexao.php");

    $id = $_POST["id"];
    $sabor = $_POST["sabor"];
    $preco = $_POST["preco"];
    $tamanho = $_POST["tamanho"];
    

    $update = "UPDATE milkshake SET sabor_m = '$sabor', 
                                   tamanho = '$tamanho',
                                   preco = '$preco'
                WHERE id_milkshake='$id'";

    mysqli_query($conexao,$update) or die(mysqli_error($conexao));
			
			
		echo "1";
?>