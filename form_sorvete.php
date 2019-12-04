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
        background:url("azul.jpg")  no-repeat center top fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

    

    
     
<?php
    include("menu.php");
    include("verificado.php");
    include("conexao.php");
    ?> 


<meta charset = "utf-8"/>
    <script src = "jquery-3.4.1.min.js"></script>

    <script>

        var id = null;
        var filtro = null;

        // PAI DE TODOS -----------------------------------------------------------------------------------
        $(function(){
            
            paginacao(0);
            
            //ALTERAR------------------------------------------------------------------------------------
            $(document).on("click",".alterar",function()
            {
                id = $(this).attr("value");
                $.ajax({
                    url:"carrega_sorvete_alterar.php",
                    type:"post",
                    data:{id: id},
                    success: function(vetor)
                    {
                        $("input[name='sabor']").val(vetor.sabor);
                        $("input[name='preco']").val(vetor.preco);
                        if(vetor.recipiente=="potinho")
                        {
                            $("input[name='recipiente'][value='casquinha']").attr("checked",false);
                            $("input[name='recipiente'][value='potinho']").attr("checked",true);
                        }
                        else
                        {
                            $("input[name='recipiente'][value='potinho']").attr("checked",false);
                            $("input[name='recipiente'][value='casquinha']").attr("checked",true);   
                        }
                        $(".btn_cadastra").attr("class","alteracao btn btn-block btn-info"); // muda o nome do botao cadastrar para Alterar
                        $(".alteracao").val("Alterar Cadastro");
                    }
                });
            
            });

            //PAGINACAO-----------------------------------------------------------------------------------
            function paginacao(p)
            {
                //console.log(p);
                $.ajax(
                {
                    url:"carrega_sorvete.php",
                    type:"post",
                    data:{pg:p, nome_filtro: filtro},
                    success:function(matriz)
                    {
                       console.log(matriz);
                        $("#tb").html("");
                        for (i=0;i<matriz.length;i++)
                        {
                            linha = "<tr>";
                            linha += "<td class = 'sabor'>" + matriz[i].sabor + "</td>";                      
                            linha += "<td class = 'recipiente'>" + matriz[i].recipiente + "</td>";
							linha += "<td class = 'preco'>" + matriz[i].preco + "</td>";
                            linha += "<td><button type = 'button'  class = 'alterar btn btn-info'value='"+ matriz[i].id_sorvete + "'>Alterar</button> <button type = 'button' class = 'btn_remover btn btn-info' value ='" + matriz[i].id_sorvete + "'>Remover</button> </td>";
                            linha += "</tr>";
                            $("#tb").append(linha);
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
						url:"insere_sorvete.php",
						type:"post",
						data:
						{
							sabor:$("input[name='sabor']").val(),
                            preco:$("input[name='preco']").val(),
                            recipiente:$("input[name='recipiente']").val()
						},
						
						success:function(data)
						{
							if(data==1)
							{
								$("#status").html("Sorvete inserido");
                                $("#status").css("color","pink");
                                paginacao(0);
								
								qtd_linha = $("#tb tr").length;
								qtd_coluna = $("#tb td").length;

								if(qtd_linha == 0 && qtd_coluna == 0)
								{
									linha = "<tr><td colspan = '6'> Não há Sorvetes cadastrados</td></tr>";
									$("#tb").append(linha);
								}
							}
							else
							{
                                console.log(data);
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

            // REMOVER ----------------------------------------------------------------------------------------------
            $(document).on("click",'.btn_remover',function()
                {

					a = $(this).val();
					
					linha = $(this).closest("tr");
					$.ajax
					({
						url:"remover_sorvete.php",
						type:"post",
						data:
						{
							id_sorvete: a
						},
						beforeSend:function()
						{
							$("#status").html("Excluindo...");
							$("#status").css("color","green");
							$("#status").css("text-aling","center");
						},
						success:function(data)
						{
							
							if(data==1)
							{
								$("#status").html("Sorvete excluido!");
								$("#status").css("color","purple");
								$("#status").css("text-aling","center");
								linha.remove();
								qtd_linha = $("#tb tr").length;
								qtd_coluna = $("#tb td").length;

								if(qtd_linha == 0 && qtd_coluna == 0)
								{
									linha = "<tr><td colspan = '6'> Não há sorvete cadastrados</td></tr>"
									$("#tb_artista").append(linha);
								}
							}
							else
							{
								$("#status").html("ERRO REMOCAO");
								$("#status").css("color","red");
								$("#status").css("text-aling","center");
							}
						},
						error:function(e)
						{
							$("#status").html("ERRO: Sistema de remoção indisponivel!");
							$("#status").css("color","red");
							$("#status").css("text-aling","center");
						}
				});	
			});
        // ALTERACAO -------------------------------------------------------------------------------------
        $(document).on("click",".alteracao",function(){           

                $.ajax(
                {
                    url:"alteracao_sorvete.php",
                    type:"post",
                    data:
                    {
                        id: id,
                        sabor: $("input[name='sabor']").val(),
                        preco:$("input[name='preco']").val(),
                        recipiente:$("input[name='recipiente']:checked").val()
                    },
                    success:function(data)
                    {
                        if(data==1)
                        {
                            $("#status").html("Sorvete alterado");
                            $("#status").css("color","blue");
                            paginacao(0);
                            $("input[name='sabor']").val("");
                            $("input[name='preco']").val("");
                            $("input[name='recipiente'] [value='casquinha']").attr("checked",false);
                            $("input[name='recipiente'] [value='potinho']").attr("checked",false);

                            $(".alteracao").attr("class","btn_cadastra btn btn-block btn-info"); // muda o nome devolta para cadastrar
                            $(".btn_cadastra").val("Cadastrar");  
                        }
                        else
                        {
                            $("#status").html(data);
                            $("#status").css("color","red");
                        }
                    }
                });
            });
            // ALTERAR O NOME ------------------------------------------------------------------------------ 
            $(document).on("click",".sabor",function(){    
                
                td= $(this);
                nome= td.html();
                td.html("<input type='text' id='sabor_alterar' name='sabor' value='" + nome +"' />");
                td.attr("class","sabor_alterar");
                $("#sabor_alterar").focus();
                
            });  

            // ALTERAR O NOME AO SAIR DO CAMPO -----------------------------------------------------------------
            $(document).on("blur",".sabor_alterar",function(){    
                td = $(this).closest("td");
                id_linha= $(this).closest("tr").find("button").val();
                $.ajax({
                    url:"alterar_coluna_sorvete.php",
                    type:"post",
                    data:{
                            coluna:'sabor',
                            valor:$("#sabor_alterar").val(),
                            id:id_linha
                         },
                    success: function()
                    {
                        td.html($("#sabor_alterar").val());
                        td.attr("class","sabor");
                    }
                });
               
            }); 

            // ALTERAR RECIPIENTE------------------------------------------------------------------------------  

            $(document).on("click",".recipiente",function(){    
                
                td= $(this);
                recipiente= td.html();
                recipiente_input="<input type='radio' class='alterar_recipiente' name='recipiente' value='potinho' />Potinho";
                recipiente_input +="<input type='radio' class='alterar_recipiente' name='recipiente' value='casquinha' />Casquinha";
                td.html(recipiente_input);

                 if(recipiente=="potinho")
                        {
                            $(".alterar_recipiente[value='potinho']").prop("checked",true);
                            $(".alterar_recipiente[value='casquinha']").prop("checked",false);                        }
                        else
                        {
                            $(".alterar_recipiente[value='potinho']").prop("checked",false);
                            $(".alterar_recipiente[value='casquinha']").prop("checked",true); 
                        }
                td.attr("class","recipiente_alterar");
                $("#recipiente_alterar").focus();
                
            });  

            // ALTERAR RECIPIENTE AO SAIR DO CAMPO ------------------------------------------------------------
            $(document).on("blur",".recipiente_alterar",function(){    
                td=$(this);
                id_linha= $(this).closest("tr").find("button").val();
                $.ajax({
                    url:"alterar_coluna_sorvete.php",
                    type:"post",
                    data:{
                            coluna:'recipiente',
                            valor:$(".alterar_recipiente:checked").val(),
                            id:id_linha
                         },
                    success: function()
                    {
                        recipiente = $(".alterar_recipiente:checked").val(),
                        td.html(recipiente);
                        td.attr("class","recipiente");
                    }
                });
               
            }); 

            // ALTERAR O PRECO ------------------------------------------------------------------------------ 
            $(document).on("click",".preco",function(){    

            td= $(this);
            preco= td.html();
            td.html("<input type='text' id='preco_alterar' name='preco' value='" + preco +"' />");
            td.attr("class","preco_alterar");
            $("#preco_alterar").focus();

            });  

            // ALTERAR O PRECO AO SAIR DO CAMPO -----------------------------------------------------------------
            $(document).on("blur",".preco_alterar",function(){    
            td = $(this).closest("td");
            id_linha= $(this).closest("tr").find("button").val();
            $.ajax({
                url:"alterar_coluna_sorvete.php",
                type:"post",
                data:{
                        coluna:'preco',
                        valor:$("#preco_alterar").val(),
                        id:id_linha
                    },
                success: function()
                {
                    td.html($("#preco_alterar").val());
                    td.attr("class","preco");
                }
            });

            }); 
           
            // FILTRAR (PESQUISA) ----------------------------------------------------------------------------
            $("#filtrar").click(function(){
                $.ajax({
                    url:"paginacao_sorvete.php",
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
                <h1 class="text-info">Cadastro Sorvete de Massa</h1>
                <br />
				<div class="form-group">
				
				<input type="text" class="form-control" name="sabor" id="sabor" placeholder="Sabor Sorvete">
				<small id="sabor" class="form-text text-muted"></small>
			  </div>
			  
			  <div class="form-group">
				<input type="number" class="form-control" name="preco" id="preco" placeholder="Preço(g)">
				<small id="preco" class="form-text text-muted"></small>
			  </div>
			  
			  <div class="input-group mb-3">
			  <div class="input-group-prepend">
				<div class="input-group-text">
				  <input type="radio" name = "recipiente" value = "potino">
				</div>
			  </div>
			  <input type="" name = "recepiente " class="form-control" placeholder = "Sorvete no potinho"> 
			</div>
			
            <div class="input-group mb-3">
			  <div class="input-group-prepend">
				<div class="input-group-text">
				  <input type="radio" name = "recipiente" value = "casquinha">
				</div>
			  </div>
			  <input type="" name = "recipiente " class="form-control" placeholder = "Sorvete na casquinha"> 
			</div>
			 
			
			  
                <br /><br />
				<input type="button" class="btn btn-info btn-lg btn-block btn_cadastra " style="color:white;"  name = "btn_cadastra" value="Cadastrar" >

                <br />
                <br />
           </form>
                <div id = "status"></div>

                    

                <table border = "1">
                <form name = "filtro">
                <div class="form-group">
				<input type="text" class="form-control" name="nome_filtro" placeholder="Busca pelo nome...">
				<small id="filtro_btn" class="form-text text-muted"></small>
                <button type="button" class="btn btn-info" id="filtrar">Filtrar</button>
			  </div>
                   
                </form>
                <br />
				
						<div class = "container">
							<table class="table table-striped table-bordered table-hover table-rounded">
                    <thead>
                        <tr>
                            <th>Sabor</th> <th>Recipiente</th> <th>Preço(g)</th><th>Ação</th>
                        </tr>
                    </thead>

                
            
                    <tbody id = "tb">
                
                    </tbody>
                </table>
				<div id="paginacao">
                    <?php
                        include("paginacao_sorvete.php");
                    ?>
                </div>
                <br />
				</div>
				
                
				</fieldset>
       </div>
    </body>
</html>