<?php
    header("Content-type: application/json");

    include("conexao.php");

    $p= $_POST["pg"];

    $sql = "SELECT * FROM acai";

    if(isset($_POST["nome_filtro"]))
    {
        $nome = $_POST["nome_filtro"];
        $sql .= " WHERE acai.tipo LIKE '%$nome%'";
    }

    $sql .= " ORDER BY tipo LIMIT $p,5";
    $resultado = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
    while($linha=mysqli_fetch_assoc($resultado))
    {
        $matriz[]=$linha;
    }

    echo json_encode($matriz);




?>