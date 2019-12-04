<?php
		
		include("conexao.php");
		$id_milkshake = $_POST["id_milkshake"];
		

		$delete =
		"DELETE FROM milkshake WHERE id_milkshake= '$id_milkshake' ";

		
		mysqli_query($conexao,$delete) or die("0: " . mysqli_error($conexao));
				echo "1";
?>