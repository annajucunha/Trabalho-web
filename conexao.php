<?php

    //local no qual o banco de dados está instalado
    $local = "localhost";
    $usuario = "root";
    $senha = "usbw";
    $bd = "sorvete";

    $conexao = mysqli_connect($local,$usuario,$senha,$bd) 
                    or die("ERRO");

?>