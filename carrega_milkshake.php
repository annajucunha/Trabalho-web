<?php
    header("Content-type: application/json");

    include("conexao.php");

    $p= $_POST["pg"];

    $sql = "SELECT * FROM milkshake";

    if(isset($_POST["nome_filtro"]))
    {
        $nome = $_POST["nome_filtro"];
        $sql .= " WHERE milkshake.sabor_m LIKE '%$nome%'";
    }

    $sql .= " ORDER BY sabor_m LIMIT $p,5";
    $resultado = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
    while($linha=mysqli_fetch_assoc($resultado))
    {
        $matriz[]=$linha;
    }

    echo json_encode($matriz);




?>