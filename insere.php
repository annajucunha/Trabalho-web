<?php

            include("conexao.php");
            
			$nome = $_POST["nome"];
			$email = $_POST["email"];
			$telefone = $_POST["telefone"];
            $sexo = $_POST["sexo"];
			$senha = $_POST["senha"];
			$data_nascimento = $_POST["data_nascimento"];
			
			

			$insert =
			"INSERT INTO usuario(nome,email,telefone,sexo,data_nascimento,senha)
				 VALUES
			 ('$nome','$email','$telefone','$sexo','$data_nascimento','$senha')";

			mysqli_query($conexao,$insert) or die(mysqli_error($conexao));
			
			
				echo "1";
?>