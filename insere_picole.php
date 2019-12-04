<?php
		
            include("conexao.php");
            
			$sabor_picole = $_POST["sabor_picole"];
			$preco = $_POST["preco"];
            $categoria = $_POST["categoria"];
            
			$insert =
			"INSERT INTO picole(sabor_picole,preco,categoria)
				 VALUES
			 ('$sabor_picole','$preco','$categoria')";

			mysqli_query($conexao,$insert) or die(mysqli_error($conexao));
			
			
				echo "1";
?>