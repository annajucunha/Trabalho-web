<?php
		
            include("conexao.php");
            
			$tipo = $_POST["tipo"];
			$preco = $_POST["preco"];
            $recipiente = $_POST["recipiente"];
            
			$insert =
			"INSERT INTO acai(tipo,preco,recipiente)
				 VALUES
			 ('$tipo','$preco','$recipiente')";

			mysqli_query($conexao,$insert) or die(mysqli_error($conexao));
			
			
				echo "1";
?>