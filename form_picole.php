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
            background:url("amarelo.jpg")  no-repeat center top fixed;
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
                    url:"carrega_picole_alterar.php",
                    type:"post",
                    data:{id: id},
                    success: function(vetor)
                    {
                        $("input[name='sabor_picole']").val(vetor.sabor_picole);
                        $("input[name='quantidade']").val(vetor.quantidade);
                        $("input[name='preco']").val(vetor.preco);
                        if(vetor.categoria=="leite")
                        {
                            $("input[name='categoria'][value='agua']").attr("checked",false);
                            $("input[name='categoria'][value='leite']").attr("checked",true);
                        }
                        else
                        {
                            $("input[name='categoria'][value='leite']").attr("checked",false);
                            $("input[name='categoria'][value='agua']").attr("checked",true);   
                        }
                        $(".btn_cadastra").attr("class","alteracao btn btn-warning"); // muda o nome do botao cadastrar para Alterar
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
                    url:"carrega_picole.php",
                    type:"post",
                    data:{pg:p, nome_filtro: filtro},
                    success:function(matriz)
                    {
                       console.log(matriz);
                        $("#tb").html("");
                        for (i=0;i<matriz.length;i++)
                        {
                            linha = "<tr>";
                            linha += "<td class = 'sabor_picole'>" + matriz[i].sabor_picole + "</td>";
                            linha += "<td class = 'categoria'>" + matriz[i].categoria + "</td>";
							linha += "<td class = 'preco'>" + matriz[i].preco + "</td>";
                            linha += "<td><button type = 'button'  class = 'alterar btn btn-warning'value='"+ matriz[i].id_picole + "'>Alterar</button> <button type = 'button' class = 'btn_remover btn btn-warning' name='btn_remover' value ='" + matriz[i].id_picole + "'>Remover</button> </td>";
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
                console.log($("input[name='categoria']:checked").val());
                linha = $(this).closest("tr");
                $.ajax
					({
						url:"insere_picole.php",
						type:"post",
						data:
						{
							sabor_picole: $("input[name='sabor_picole']").val(),
                            preco:$("input[name='preco']").val(),
                            categoria:$("input[name='categoria']:checked").val(),
						},
						
						success:function(data)
						{
							if(data==1)
							{
								$("#status").html("Picole inserido");
                                $("#status").css("color","pink");
                                paginacao(0);
								
								qtd_linha = $("#tb tr").length;
								qtd_coluna = $("#tb td").length;

								if(qtd_linha == 0 && qtd_coluna == 0)
								{
									linha = "<tr><td colspan = '6'> Não há Picoles cadastrados</td></tr>";
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
						url:"remover_picole.php",
						type:"post",
						data:
						{
							id_picole: a
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
								$("#status").html("Picolé excluido!");
								$("#status").css("color","purple");
								$("#status").css("text-aling","center");
								linha.remove();
								qtd_linha = $("#tb tr").length;
								qtd_coluna = $("#tb td").length;

								if(qtd_linha == 0 && qtd_coluna == 0)
								{
									linha = "<tr><td colspan = '6'> Não há picolés cadastrados</td></tr>"
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
                    url:"alteracao_picole.php",
                    type:"post",
                    data:
                    {
                        id: id,
                        sabor_picole: $("input[name='sabor_picole']").val(),
                        quantidade:$("input[name='quantidade']").val(),
                        preco:$("input[name='preco']").val(),
                        categoria:$("input[name='categoria']:checked").val(),
                    },
                    success:function(data)
                    {
                        if(data==1)
                        {
                            $("#status").html("Picole alterado");
                            $("#status").css("color","blue");
                            paginacao(0);
                            $("input[name='sabor_picole']").val("");
                            $("input[name='quantidade']").val("");
                            $("input[name='preco']").val("");
                            $("input[name='categoria'] [value='agua']").attr("checked",false);
                            $("input[name='categoria'] [value='leite']").attr("checked",false);

                            $(".alteracao").attr("class","btn_cadastra btn btn-warning"); // muda o nome devolta para cadastrar
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
            $(document).on("click",".sabor_picole",function(){    
                
                td= $(this);
                nome= td.html();
                td.html("<input type='text' id='sabor_alterar' name='sabor_picole' value='" + nome +"' />");
                td.attr("class","sabor_alterar");
                $("#sabor_alterar").focus();
                
            });  

            // ALTERAR O NOME AO SAIR DO CAMPO -----------------------------------------------------------------
            $(document).on("blur",".sabor_alterar",function(){    
                td = $(this).closest("td");
                id_linha= $(this).closest("tr").find("button").val();
                $.ajax({
                    url:"alterar_coluna_picole.php",
                    type:"post",
                    data:{
                            coluna:'sabor_picole',
                            valor:$("#sabor_alterar").val(),
                            id:id_linha
                         },
                    success: function()
                    {
                        td.html($("#sabor_alterar").val());
                        td.attr("class","sabor_picole");
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
                    url:"alterar_coluna_picole.php",
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

             // ALTERAR CATEGORIA------------------------------------------------------------------------------  

            $(document).on("click",".categoria",function(){    
                
                td= $(this);
                categoria= td.html();
                categoria_input="<input type='radio' class='alterar_categoria' name='categoria' value='agua' />Água";
                categoria_input +="<input type='radio' class='alterar_categoria' name='categoria' value='leite' />Leite";
                td.html(categoria_input);

                 if(categoria=="agua")
                        {
                            $(".alterar_categoria[value='agua']").prop("checked",true);
                            $(".alterar_categoria[value='leite']").prop("checked",false);                        }
                        else
                        {
                            $(".alterar_categoria[value='agua']").prop("checked",false);
                            $(".alterar_categoria[value='leite']").prop("checked",true); 
                        }
                td.attr("class","categoria_alterar");
                $("#categoria_alterar").focus();
                
            });  

            // ALTERAR CATEGORIA AO SAIR DO CAMPO ------------------------------------------------------------
            $(document).on("blur",".categoria_alterar",function(){    
                td=$(this);
                id_linha= $(this).closest("tr").find("button").val();
                $.ajax({
                    url:"alterar_coluna_picole.php",
                    type:"post",
                    data:{
                            coluna:'categoria',
                            valor:$(".alterar_categoria:checked").val(),
                            id:id_linha
                         },
                    success: function()
                    {
                        categoria = $(".alterar_categoria:checked").val(),
                        td.html(categoria);
                        td.attr("class","categoria");
                    }
                });
               
            }); 


           
            // FILTRAR (PESQUISA) ----------------------------------------------------------------------------
            $("#filtrar").click(function(){
                $.ajax({
                    url:"paginacao_picole.php",
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
                <h1 class="text-warning ">Cadastro Picole</h1>
                <br />
				<div class="form-group">
				
				<input type="text" class="form-control" name="sabor_picole" id="sabor_picole" placeholder="Sabor Picole">
				<small id="sabor_picole" class="form-text text-muted"></small>
			  </div>
						
			  
			  <div class="form-group">
				<input type="number" class="form-control" name="preco" id="preco" placeholder="Preço">
				<small id="preco" class="form-text text-muted"></small>
			  </div>
			  
			  <div class="input-group mb-3">
			  <div class="input-group-prepend">
				<div class="input-group-text">
				  <input type="radio" name = "categoria" value = "agua">
				</div>
			  </div>
			  <input type="" name = "categoria " class="form-control" placeholder = "Picole de agua"> 
			</div>
			
            <div class="input-group mb-3">
			  <div class="input-group-prepend">
				<div class="input-group-text">
				  <input type="radio" name = "categoria" value = "leite">
				</div>
			  </div>
			  <input type="" name = "categoria " class="form-control" placeholder = "Picole de leite"> 
			</div>
			 
			
			  
                <br /><br />
				<input type="button" class="btn btn-warning btn-lg btn-block btn_cadastra " style="color:white;"  name = "btn_cadastra" value="Cadastrar" >

                <br />
                <br />
           </form>
                <div id = "status"></div>

                    

                <table border = "1">
                <form name = "filtro">
                <div class="form-group">
				<input type="text" class="form-control" name="nome_filtro" placeholder="Busca pelo nome...">
				<small id="filtro_btn" class="form-text text-muted"></small>
                <button type="button" class="btn btn-warning" id="filtrar">Filtrar</button>
			  </div>
                   
                </form>
                <br />
				
						<div class = "container">
							<table class="table table-striped table-bordered table-hover table-rounded">
                    <thead>
                        <tr>
                            <th>Sabor</th> <th>Categoria</th> <th>Preco</th><th>Ação</th>
                        </tr>
                    </thead>

                
            
                    <tbody id = "tb">
                
                    </tbody>
                </table>
				<div id="paginacao">
                    <?php
                        include("paginacao_picole.php");
                    ?>
                </div>
                <br />
				</div>
                
				
                
				</fieldset>
       </div>
    </body>
</html>