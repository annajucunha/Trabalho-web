<?php
		session_start();
            include("conexao.php");
            
			$picole = $_POST["picole"];
			$qtd_picole = $_POST["quantidade_picole"];
            $preco_p = $_POST["preco_p"];

            $sorvete = $_POST["sorvete"];
			$qtd_sorvete = $_POST["quantidade_sorvete"];
            $preco_s = $_POST["preco_s"];

            $acai = $_POST["acai"];
			$qtd_acai = $_POST["quantidade_acai"];
            $preco_a = $_POST["preco_a"];

            $milkshake = $_POST["milkshake"];
			$qtd_milkshake = $_POST["quantidade_milkshake"];
			$preco_m = $_POST["preco_m"];

			$total = $_POST["total"];
			
			$usuario = $_SESSION["autorizado"];

			$insert =
			"INSERT INTO compras(cod_usuario,cod_picole,cod_sorvete,cod_acai,cod_milkshake,quantidade_picole,quantidade_sorvete,quantidade_acai,quantidade_milkshake, preco_p, preco_s, preco_a, preco_m, total)
				 VALUES
			 ('$usuario','$picole','$sorvete', '$acai', '$milkshake','$qtd_picole','$qtd_sorvete','$qtd_acai','$qtd_milkshake','$preco_p','$preco_s', '$preco_a', '$preco_m', '$total')";

			mysqli_query($conexao,$insert) or die(mysqli_error($conexao));
			
			
				echo "1";
?>