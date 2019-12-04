<?php

    include("conexao.php");

    $coluna = $_POST["coluna"];
    $id = $_POST["id"];
    $valor = $_POST["valor"];


    $update = "UPDATE milkshake SET $coluna = '$valor' WHERE id_milkshake='$id'";

    mysqli_query($conexao,$update) or die(mysqli_error($conexao));
			
			
		echo "1";
?>