<?php

header("Content-type: application/json");

include("conexao.php");

$id = $_POST["id"];

$sql = "SELECT * FROM sorvete WHERE id_sorvete='$id'";
$resultado = mysqli_query($conexao,$sql);

$linha = mysqli_fetch_assoc($resultado);

echo json_encode($linha);
?>