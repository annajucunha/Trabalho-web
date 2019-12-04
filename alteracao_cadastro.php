<?php

    include("conexao.php");

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $sexo = $_POST["sexo"];
    $senha = $_POST["senha"];
    $data_nascimento = $_POST["data_nascimento"];
    

    $update = "UPDATE usuario SET nome = '$nome', 
                                   email = '$email', 
                                   telefone = '$telefone', 
                                   sexo = '$sexo',
                                   senha = '$senha',
                                   data_nascimento = '$data_nascimento'
                WHERE id_usuario='$id'";

    mysqli_query($conexao,$update) or die(mysqli_error($conexao));
			
			
		echo "1";
?>