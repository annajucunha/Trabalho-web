<?php

	include("conexao.php");

	$usuario = $_POST["email"];
	$senha = $_POST["senha"];
	$consulta = "SELECT * FROM usuario WHERE email='$usuario' AND senha='$senha'";
	
	$resultado = mysqli_query($conexao,$consulta) or die ("Email ou senha incorretos!");
	
	if(mysqli_num_rows($resultado)==1){
		session_start();
		$linha = mysqli_fetch_assoc($resultado);
		$_SESSION["autorizado"]=$linha["id_usuario"];
		header("location: index.php");
	}else{
		die("Email ou senha incorretos!");
		header("location: login.php?erro=1");
	}
?>