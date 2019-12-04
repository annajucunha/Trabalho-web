<?php

    include("conexao.php");

    $id = $_POST["id"];
    $sabor_picole = $_POST["sabor_picole"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];
    

    $update = "UPDATE picole SET sabor_picole = '$sabor_picole', 
                                   preco = '$preco', 
                                   categoria = '$categoria'
                WHERE id_picole='$id'";

    mysqli_query($conexao,$update) or die(mysqli_error($conexao));
			
			
		echo "1";
?>