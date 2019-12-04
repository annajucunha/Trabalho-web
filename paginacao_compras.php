<?php
       if(!isset($_SESSION["autorizado"])){
           session_start();
       }
        include("conexao.php");

            $sql = "SELECT COUNT(*) as qtd FROM compras
            INNER JOIN usuario
            ON compras.cod_usuario=usuario.id_usuario AND usuario.id_usuario='".$_SESSION["autorizado"]."'            
            LEFT JOIN picole 
            ON compras.cod_picole=picole.id_picole
            LEFT JOIN sorvete
            ON compras.cod_sorvete=sorvete.id_sorvete
            LEFT JOIN milkshake
            ON compras.cod_milkshake=milkshake.id_milkshake
            LEFT JOIN acai
            ON compras.cod_acai=acai.id_acai
            ";

            if(!empty($_POST))
            {
                $nome = $_POST["nome_filtro"];
                $sql .= " WHERE picole.sabor_picole LIKE '%$nome%' OR sorvete.sabor LIKE '%$nome%' OR acai.tipo LIKE '%$nome%' OR milkshake.sabor_m LIKE '%$nome%'";
            }
            $resultado = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

            $linha = mysqli_fetch_assoc($resultado);

            $qtd_tuplas = $linha["qtd"];

            $qtd_botoes = (int) ($qtd_tuplas / 5);

            if($qtd_tuplas%5!=0)
            {
                $qtd_botoes++;
            }

            for($i=1;$i<=$qtd_botoes;$i++)
            {
                echo "<button type = 'button' class ='pg btn btn-primary' value='$i'>$i</button>";
            }
?>