<!DOCTYPE html>
<html lang>
    <head>
    <style>
       .fiel
        {
            width:800px;
            text-align:center;
            margin-left:550px;
			
			border-color:black;
			margin-top:-600px;
           
        }
        table
        {
            
            align-items: center;
            

           
        }
        body
        {
           background:url("azul2.png")  no-repeat center top fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

        }
        
    </style>

    

    
     
<?php
    include("menu.php");
    include("conexao.php");

    $consulta_picole = "SELECT * FROM picole ORDER BY sabor_picole ";
    $resultado_picole = mysqli_query($conexao,$consulta_picole) or die ("Erro");

    $consulta_sorvete = "SELECT * FROM sorvete ORDER BY sabor";
    $resultado_sorvete = mysqli_query($conexao,$consulta_sorvete) or die ("Erro");

    $consulta_acai = "SELECT * FROM acai ORDER BY tipo";
    $resultado_acai = mysqli_query($conexao,$consulta_acai) or die ("Erro");

    $consulta_milkshake = "SELECT * FROM milkshake ORDER BY sabor_m ";
    $resultado_milkshake = mysqli_query($conexao,$consulta_milkshake) or die ("Erro");
    ?> 


<meta charset = "utf-8"/>
    <script src = "jquery-3.4.1.min.js"></script>

    <script>

        var id = null;
        var filtro = null;

        // PAI DE TODOS -----------------------------------------------------------------------------------
        $(function(){
            
            paginacao(0);
            
            //PAGINACAO-----------------------------------------------------------------------------------
            function paginacao(p)
            {
                console.log(p);
                $.ajax(
                {
                    url:"carrega_compras.php",
                    type:"post",
                    data:{pg:p, nome_filtro: filtro},
                    success:function(matriz)
                    {
                       console.log(matriz);
                        $("#tb_picole").html("");
                        for (i=0;i<matriz.length;i++)
                        {
                            linha = "<tr>";
                            linha += "<td class = 'sabor_picole'>Sabor: " + matriz[i].sabor_picole +"<p>Quantidade: " + matriz[i].quantidade_picole +"<p>Categoria: " + matriz[i].categoria +"<p>Preco: R$" + matriz[i].preco_p +"</td>" ;
                            linha += "<td class = 'sabor'>Sabor: " + matriz[i].sabor +"<p>Quantidade: " + matriz[i].quantidade_sorvete +"<p>Recipiente: " + matriz[i].recipiente +"<p>Preco: R$" + matriz[i].preco_s +"</td>" ;
                            linha += "<td class = 'tipo'>Sabor: " + matriz[i].tipo +"<p>Quantidade: " + matriz[i].quantidade_acai +"<p>Recipiente: " + matriz[i].recipiente +"<p>Preco: R$" + matriz[i].preco_a +"</td>" ;
                            linha += "<td class = 'sabor_m' >Sabor: " + matriz[i].sabor_m +"<p>Quantidade: " + matriz[i].quantidade_milkshake +"<p>Tamanho: " + matriz[i].tamanho +"ml <p>Preco: R$" + matriz[i].preco_m +"</td>" ;
                            linha += "<td class = 'total'>R$" + matriz[i].total +"</td>" ;
                            linha += "</tr>";
                            $("#tb_picole").append(linha);
                        }
                    }
                });
            }
                    

            // CLICAR NA PAGINACAO -----------------------------------------------------------------------
            $(document).on("click",".pg",function(){                                                       
                p = $(this).val();
                p = (p-1)*5;
                paginacao(p);   
            });

            // CADASTRAR ---------------------------------------------------------------------------------
            $(document).on("click",".btn_cadastra",function(){
            
                linha = $(this).closest("tr");
                $.ajax
					({
						url:"insere_compra.php",
						type:"post",
						data:
						{
							picole:$("select[name='cod_picole']").val(),
                            quantidade_picole:$("input[name='quantidade_picole']").val(),
                            preco_p:$("input[name='preco_p']").val(),

                            sorvete:$("select[name='cod_sorvete']").val(),
                            quantidade_sorvete:$("input[name='quantidade_sorvete']").val(),
                            preco_s:$("input[name='preco_s']").val(),

                            acai:$("select[name='cod_acai']").val(),
                            quantidade_acai:$("input[name='quantidade_acai']").val(),
                            preco_a:$("input[name='preco_a']").val(),

                            milkshake:$("select[name='cod_milkshake']").val(),
                            quantidade_milkshake:$("input[name='quantidade_milkshake']").val(),
                            preco_m:$("input[name='preco_m']").val(),

                            total:$("input[name='total']").val()
                            
                            
						},
						
						success:function(data)
						{
                            console.log(data);
							if(data==1)
							{
								$("#status").html("Compra inserida");
                                $("#status").css("color","pink");
                                paginacao(0);
								
								qtd_linha = $("#tb tr").length;
								qtd_coluna = $("#tb td").length;

								if(qtd_linha == 0 && qtd_coluna == 0)
								{
									linha = "<tr><td colspan = '6'> Não há Compras cadastrados</td></tr>";
									$("#tb").append(linha);
								}
							}
							else
							{
                                
								$("#status").html("ERRO");
								$("#status").css("color","red");
							}
						},
						error:function(e)
						{
							$("#status").html("ERRO: Sistema indisponivel!");
							$("#status").css("color","red");
						}
					});

            });

      
          // PRECO AUTOMATICO PICOLE ---------------------------------------------------------------------------------------------
           $(document).on("change","#quantidade_picole",function(){   
                       
            $.ajax(
            {
                url:"preco_automatico.php",
                type:"post",
                data:
                {
					
                    id: $("#picole").val(),
                    tabela: "picole",
					quantidade:$("input[name='quantidade_picole']").val()
					
					
                },
                success:function(data)
                {
                    console.log(data);
                    $("#preco_p").val(data);
                    total =  parseInt($("#preco_p").val()) + parseInt($("#preco_s").val()) + parseInt($("#preco_a").val()) + parseInt($("#preco_m").val());
                    $("#total").val(total); 
                    paginacao(0); 
                }
            });
            });
			
			// PRECO AUTOMATICO SORVETE ---------------------------------------------------------------------------------------------
           $(document).on("change","#quantidade_sorvete",function(){   
                       
            $.ajax(
            {
                url:"preco_automatico.php",
                type:"post",
                data:
                {
					
                    id: $("#sorvete").val(),
                    tabela: "sorvete",
					quantidade:$("input[name='quantidade_sorvete']").val()
					
					
                },
                success:function(data)
                {
                    console.log(data);
                    $("#preco_s").val(data); 
                    total =  parseInt($("#preco_p").val()) + parseInt($("#preco_s").val()) + parseInt($("#preco_a").val()) + parseInt($("#preco_m").val());
                    $("#total").val(total); 
                    paginacao(0); 
                }
            });
            });
			
			// PRECO AUTOMATICO ACAI ---------------------------------------------------------------------------------------------
           $(document).on("change","#quantidade_acai",function(){   
                       
            $.ajax(
            {
                url:"preco_automatico.php",
                type:"post",
                data:
                {
					
                    id: $("#acai").val(),
                    tabela: "acai",
					quantidade:$("input[name='quantidade_acai']").val()
					
					
                },
                success:function(data)
                {
                    console.log(data);
                    $("#preco_a").val(data); 
                    total =  parseInt($("#preco_p").val()) + parseInt($("#preco_s").val()) + parseInt($("#preco_a").val()) + parseInt($("#preco_m").val());
                    $("#total").val(total); 
                    paginacao(0); 
                }
            });
            });
			
			// PRECO AUTOMATICO MILKKSHAKE------------------------------------------------------------------------------------------------------ ---------------------------------------------------------------------------------------------
           $(document).on("change","#quantidade_milkshake",function(){   
                       
            $.ajax(
            {
                url:"preco_automatico.php",
                type:"post",
                data:
                {
					
                    id: $("#milkshake").val(),
                    tabela: "milkshake",
					quantidade:$("input[name='quantidade_milkshake']").val()
					
					
                },
                success:function(data)
                {
                    console.log(data);
                    $("#preco_m").val(data); 
                    total =  parseInt($("#preco_p").val()) + parseInt($("#preco_s").val()) + parseInt($("#preco_a").val()) + parseInt($("#preco_m").val());
                    $("#total").val(total); 

                    paginacao(0); 
                }
            });
            });
			
            // FILTRAR (PESQUISA) ----------------------------------------------------------------------------
            $("#filtrar").click(function(){
                $.ajax({
                    url:"paginacao_compras.php",
                    type:"post",
                    data:
                    {
                        nome_filtro: $("input[name='nome_filtro']").val()
                    },
                    success: function(data)
                    {
                        $("#paginacao").html(data);
                        filtro = $("input[name='nome_filtro']").val();
                        paginacao(0);

                    }
                });
            });   
        });
		</script>
    </head>
    <body>

        <form>
            
            <div class = "fiel">
			<fieldset>
                <h1 class="text-primary ">Comprar Online</h1>
                <br />
<!-- PICOLE------------------------------------------------------------------------------------------------------>
				<select class="custom-select w-25" id ="picole" name ="cod_picole" style="margin-right:700px;">
                <option selected>Picolé</option>
                <?php

                while($linha=mysqli_fetch_assoc($resultado_picole)){
                    $fk_picole = $linha["id_picole"];
                    $picole = $linha["sabor_picole"];
                    $categoria = $linha["categoria"];
                    $preco = $linha["preco"];
                    echo "<option value='$fk_picole'>$picole- $categoria (R$ $preco)</option>";
                }
                ?>
                </select>
                <br /><br />
                <input  type ="text" class=" custom-select w-25" id ="quantidade_picole" name ="quantidade_picole" placeholder="Quantidade"  style="margin-right:700px;">
            
				<br /><br />
                <input  type ="text" class=" custom-select w-25" id ="preco_p" name ="preco_p" value ="0" style="margin-right:700px;" placeholder="Preço">
               
                <br /><br />
                <input type ="text" class="form-control" id ="total" name ="total" style="margin-right:700px;" placeholder="Total">

                
<!--SORVETE------------------------------------------------------------------------------------------------------>
              <select class="custom-select w-25" id ="sorvete" name ="cod_sorvete" style="margin-right:170px; margin-top:-440px;">
                <option selected>Sorvete</option>
                <?php

                while($linha=mysqli_fetch_assoc($resultado_sorvete)){
                    $fk_sorvete = $linha["id_sorvete"];
                    $sorvete = $linha["sabor"];
                    $recipiente = $linha["recipiente"];
                    $preco = $linha["preco"];
                    echo "<option value='$fk_sorvete'>$sorvete- $recipiente (R$ $preco)</option>";
                }
                ?>
                </select>
                <br /><br />
                <input  type = "text" class="custom-select w-25" id ="quantidade_sorvete" name ="quantidade_sorvete" placeholder="Quantidade"  style="margin-right:170px; margin-top:-410px;">
				<br /><br />
                 <input  type ="text" class=" custom-select w-25" id ="preco_s" name ="preco_s"  value ="0" placeholder="Preço"style="margin-right:170px; margin-top:-385px;">
                <br /><br />
                
<!--ACAI------------------------------------------------------------------------------------------------------>
              <select class="custom-select w-25" id ="acai" name ="cod_acai" style="margin-left:250px; margin-top:-730px;">
                <option selected>Açai</option>
                <?php

                while($linha=mysqli_fetch_assoc($resultado_acai)){
                    $fk_acai = $linha["id_acai"];
                    $acai = $linha["tipo"];
                    $recipiente = $linha["recipiente"];
                    $preco = $linha["preco"];
                    echo "<option value='$fk_acai'>$acai- $recipiente (R$ $preco)</option>";
                }
                ?>
                </select>
                <br /><br />
                <input type = "text" class="custom-select w-25" id ="quantidade_acai" name ="quantidade_acai" placeholder="Quantidade"  style="margin-left:250px; margin-top:-700px;">
               
				<br /><br />
                <input  type ="text" class=" custom-select w-25" id ="preco_a" name ="preco_a" placeholder="Preço" value ="0"  style="margin-left:250px; margin-top:-675px;">
                
                <br /><br />
                
<!--MILKKSHAKE------------------------------------------------------------------------------------------------------>
              <select class="custom-select w-25" id ="milkshake" name ="cod_milkshake" style="margin-left:635px; margin-top:-1020px;">
                <option selected>Milkshake</option>
                <?php

                while($linha=mysqli_fetch_assoc($resultado_milkshake)){
                    $fk_milkshake= $linha["id_milkshake"];
                    $milkshake = $linha["sabor_m"];
                    $tamanho = $linha["tamanho"];
                    $preco = $linha["preco"];
                    echo "<option value='$fk_milkshake'>$milkshake- $tamanho (R$ $preco)</option>";
                }
                ?>
                </select>
                <br /><br />
                <input type = "text" class="custom-select w-25" id ="quantidade_milkshake" name ="quantidade_milkshake" placeholder="Quantidade"  style="margin-left:635px; margin-top:-990px;">
              
                <br /><br />
                <input  type ="text" class=" custom-select w-25" id ="preco_m" name ="preco_m" value ="0"  placeholder="Preço" style="margin-left:635px; margin-top:-965px;">
               
                <br /><br />
                
				<input type="button" class="btn btn-primary btn-lg btn-block btn_cadastra "  name = "btn_cadastra" value="Cadastrar" style="margin-top:-405px;" >

                <br />
                <br />
           </form>
                <div id = "status"></div>

                    

                <table border = "1">
                <form name = "filtro">
                <div class="form-group">
				<input type="text" class="form-control" name="nome_filtro" placeholder="Busca pelo nome...">
				<small id="filtro_btn" class="form-text text-muted"></small>
                <button type="button" class="btn btn-primary" id="filtrar">Filtrar</button>
			  </div>
                   
                </form>
                <br />
				
						
                <div class = "container">
							<table class="table table-striped table-bordered table-hover table-rounded">
                    <thead>
                    <tr>
                            <th colspan="5" >Compras Realizadas</th>
                        </tr>
                       
                        <tr>
                            <th>Picolé</th><th>Sorvete</th><th>Açai</th><th>Milkshake</th><th>Total</th>
                        </tr>
                        


                    </thead>
                    <tbody id = "tb_picole">
                                    
                    </tbody>
                    </table>

                  
				<div id="paginacao">
                    <?php
                        include("paginacao_compras.php");
                    ?>
                </div>
                <br />
				</div>
				
                
				</fieldset>
       </div>
    </body>
</html>