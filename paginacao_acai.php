<?php
		
            include("conexao.php");

            $sql = "SELECT COUNT(*) as qtd FROM acai";

            if(!empty($_POST))
            {
                $nome = $_POST["nome_filtro"];
                $sql .= " WHERE tipo LIKE '%$nome%'";
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
                echo "<button type = 'button' class ='pg btn btn-danger' value='$i'>$i</button>";
            }
?>