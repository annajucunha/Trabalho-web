<?php
		
		include("conexao.php");
		$id_acai = $_POST["id_acai"];
		

		$delete =
		"DELETE FROM acai WHERE id_acai = '$id_acai' ";

		
		mysqli_query($conexao,$delete) or die("0: " . mysqli_error($conexao));
				echo "1";
?>