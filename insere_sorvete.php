<?php
		
            include("conexao.php");
            
			$sabor = $_POST["sabor"];
			$preco = $_POST["preco"];
            $recipiente = $_POST["recipiente"];
            
			$insert =
			"INSERT INTO sorvete(sabor,preco,recipiente)
				 VALUES
			 ('$sabor','$preco','$recipiente')";

			mysqli_query($conexao,$insert) or die(mysqli_error($conexao));
			
			
				echo "1";
?>