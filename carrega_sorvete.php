<?php
    header("Content-type: application/json");

    include("conexao.php");

    $p= $_POST["pg"];

    $sql = "SELECT * FROM sorvete";

    if(isset($_POST["nome_filtro"]))
    {
        $nome = $_POST["nome_filtro"];
        $sql .= " WHERE sorvete.sabor LIKE '%$nome%'";
    }

    $sql .= " ORDER BY sabor LIMIT $p,5";
    $resultado = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
    while($linha=mysqli_fetch_assoc($resultado))
    {
        $matriz[]=$linha;
    }

    echo json_encode($matriz);




?>