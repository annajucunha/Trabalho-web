<?php
    header("Content-type: application/json");
    session_start();
    include("conexao.php");

    $p= $_POST["pg"];

    $sql = "SELECT * FROM usuario";

    if(isset($_POST["nome_filtro"]))
    {
        $nome = $_POST["nome_filtro"];
        $sql .= " WHERE id_usuario='".$_SESSION["autorizado"]."' AND usuario.nome LIKE '%$nome%'";
    }

    $sql .= " ORDER BY nome LIMIT $p,5";
    $resultado = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
    while($linha=mysqli_fetch_assoc($resultado))
    {
        $matriz[]=$linha;
    }

    echo json_encode($matriz);




?>