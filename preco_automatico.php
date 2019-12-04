<?php

    include("conexao.php");

    $id = $_POST["id"];

    $tabela = $_POST["tabela"];
	
	$qtd = $_POST["quantidade"];
    
    $sql= "SELECT preco FROM $tabela WHERE id_$tabela=$id ";

    $r = mysqli_query($conexao,$sql);
    $linha = mysqli_fetch_assoc($r);
    
    $preco= $linha["preco"];
	
	$total= $qtd * $preco;
    
    echo $total;
    
?>