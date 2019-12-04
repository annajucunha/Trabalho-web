<?php
		
		include("conexao.php");
		$id_picole = $_POST["id_picole"];
		

		$delete =
		"DELETE FROM picole WHERE id_picole = '$id_picole' ";

		
		mysqli_query($conexao,$delete) or die("0: " . mysqli_error($conexao));
				echo "1";
?>