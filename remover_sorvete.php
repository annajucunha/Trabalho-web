<?php
		
		include("conexao.php");
		$id_sorvete = $_POST["id_sorvete"];
		

		$delete =
		"DELETE FROM sorvete WHERE id_sorvete = '$id_sorvete' ";

		
		mysqli_query($conexao,$delete) or die("0: " . mysqli_error($conexao));
				echo "1";
?>