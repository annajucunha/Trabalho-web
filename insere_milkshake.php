<?php
		
            include("conexao.php");
            
			$sabor = $_POST["sabor"];
			$preco = $_POST["preco"];
            $tamanho = $_POST["tamanho"];
            
			$insert =
			"INSERT INTO milkshake(sabor_m,tamanho,preco)
				 VALUES
			 ('$sabor','$tamanho','$preco')";

			mysqli_query($conexao,$insert) or die(mysqli_error($conexao));
			
			
				echo "1";
?>