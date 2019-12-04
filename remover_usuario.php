<?php
		
		include("conexao.php");
		$id_usuario = $_POST["id_usuario"];
		

		$delete =
		"DELETE FROM usuario WHERE id_usuario = '$id_usuario' ";

		
		mysqli_query($conexao,$delete) or die("0: " . mysqli_error($conexao));
				echo "1";
?>