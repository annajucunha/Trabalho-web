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
           background:url("verde.png")  no-repeat center top fixed;
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
                    url:"carrega_milkshake_alterar.php",
                    type:"post",
                    data:{id: id},
                    success: function(vetor)
                    {
                        $("input[name='sabor_m']").val(vetor.sabor_m);
                        $("input[name='preco']").val(vetor.preco);
                        if(vetor.tamanho=="800")
                        {
                            $("input[name='tamanho'][value='300']").attr("checked",false);
                            $("input[name='tamanho'][value='500']").attr("checked",false);
                            $("input[name='tamanho'][value='800']").attr("checked",true);
                        }
                        if(vetor.tamanho=="500")
                        {
                            $("input[name='tamanho'][value='300']").attr("checked",false);
                            $("input[name='tamanho'][value='500']").attr("checked",true);
                            $("input[name='taanho'][value='800']").attr("checked",false);   
                        }
                        if(vetor.tamanho=="300")
                        {
                            $("input[name='tamanho'][value='300']").attr("checked",true);
                            $("input[name='tamanho'][value='500']").attr("checked",false);
                            $("input[name='taanho'][value='800']").attr("checked",false);   
                        }
                        $(".btn_cadastra").attr("class","alteracao btn btn-block btn-success"); // muda o nome do botao cadastrar para Alterar
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
                    url:"carrega_milkshake.php",
                    type:"post",
                    data:{pg:p, nome_filtro: filtro},
                    success:function(matriz)
                    {
                       console.log(matriz);
                        $("#tb").html("");
                        for (i=0;i<matriz.length;i++)
                        {
                            linha = "<tr>";
                            linha += "<td class = 'sabor_m'>" + matriz[i].sabor_m + "</td>";                 
                            linha += "<td class = 'tamanho'>" + matriz[i].tamanho + "</td>";
							linha += "<td class = 'preco'>" + matriz[i].preco + "</td>";
                            linha += "<td><button type = 'button'  class = 'alterar btn btn-success'value='"+ matriz[i].id_milkshake + "'>Alterar</button> <button type = 'button' class = 'btn_remover btn btn-success' value ='" + matriz[i].id_milkshake + "'>Remover</button> </td>";
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
						url:"insere_milkshake.php",
						type:"post",
						data:
						{
							sabor:$("input[name='sabor_m']").val(),
                            tamanho:$("input[name='tamanho']").val(),
                            preco:$("input[name='preco']").val(),
                            
						},
						
						success:function(data)
						{
							if(data==1)
							{
								$("#status").html("Mikshake inserido");
                                $("#status").css("color","pink");
                                paginacao(0);
								
								qtd_linha = $("#tb tr").length;
								qtd_coluna = $("#tb td").length;

								if(qtd_linha == 0 && qtd_coluna == 0)
								{
									linha = "<tr><td colspan = '6'> Não há Milkshakes cadastrados</td></tr>";
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
						url:"remover_milkshake.php",
						type:"post",
						data:
						{
							id_milkshake: a
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
								$("#status").html("Milkshake excluido!");
								$("#status").css("color","purple");
								$("#status").css("text-aling","center");
								linha.remove();
								qtd_linha = $("#tb tr").length;
								qtd_coluna = $("#tb td").length;

								if(qtd_linha == 0 && qtd_coluna == 0)
								{
									linha = "<tr><td colspan = '6'> Não há milkshake cadastrados</td></tr>"
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
                    url:"alteracao_milkshake.php",
                    type:"post",
                    data:
                    {
                        id: id,
                        sabor: $("input[name='sabor_m']").val(),
                        preco:$("input[name='preco']").val(),
                        tamanho:$("input[name='tamanho']:checked").val()
                    },
                    success:function(data)
                    {
                        if(data==1)
                        {
                            $("#status").html("Milkshake alterado");
                            $("#status").css("color","blue");
                            paginacao(0);
                            $("input[name='sabor_m']").val("");
                            $("input[name='preco']").val("");
                            $("input[name='tamanho'] [value='300']").attr("checked",false);
                            $("input[name='tamanho'] [value='500']").attr("checked",false);
                            $("input[name='tamanho'] [value='800']").attr("checked",false);


                            $(".alteracao").attr("class","btn_cadastra btn btn-block btn-success"); // muda o nome devolta para cadastrar
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
            // ALTERAR O SABOR ------------------------------------------------------------------------------ 
            $(document).on("click",".sabor_m",function(){    
                
                td= $(this);
                sabor= td.html();
                td.html("<input type='text' id='sabor_alterar' name='sabor_m' value='" + sabor +"' />");
                td.attr("class","sabor_alterar");
                $("#sabor_alterar").focus();
                
            });  

            // ALTERAR O SABOR AO SAIR DO CAMPO -----------------------------------------------------------------
            $(document).on("blur",".sabor_alterar",function(){    
                td = $(this).closest("td");
                id_linha= $(this).closest("tr").find("button").val();
                $.ajax({
                    url:"alterar_coluna_milkshake.php",
                    type:"post",
                    data:{
                            coluna:'sabor_m',
                            valor:$("#sabor_alterar").val(),
                            id:id_linha
                         },
                    success: function()
                    {
                        td.html($("#sabor_alterar").val());
                        td.attr("class","sabor_m");
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
                url:"alterar_coluna_milkshake.php",
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

            // ALTERAR TAMANHO------------------------------------------------------------------------------  

            $(document).on("click",".tamanho",function(){    

            td= $(this);
            tamanho= td.html();
            tamanho_input="<input type='radio' class='alterar_tamanhoX' name='tamanho' value='300' />300";
            tamanho_input +="<input type='radio' class='alterar_tamanhoX' name='tamanho' value='500' />500";
			tamanho_input +="<input type='radio' class='alterar_tamanhoX' name='tamanho' value='800' />800";
            td.html(tamanho_input);

            if(tamanho=="300")
                    {
                        $(".alterar_tamanhoX[value='300']").prop("checked",true);
                        $(".alterar_tamanhoX[value='300']").focus();
                        $(".alterar_tamanhoX[value='500']").prop("checked",false);       
                        $(".alterar_tamanhoX[value='800']").prop("checked",false); 
					}	
            else if(tamanho=="500")
                    {
                        $(".alterar_tamanhoX[value='500']").prop("checked",true);
						$(".alterar_tamanhoX[value='500']").focus();
                        $(".alterar_tamanhoX[value='300']").prop("checked",false);       
                        $(".alterar_tamanhoX[value='800']").prop("checked",false);                      
					}
            else
                    {
						
                        $(".alterar_tamanhoX[value='300']").prop("checked",false);
                        $(".alterar_tamanhoX[value='500']").prop("checked",false);
                        $(".alterar_tamanhoX[value='800']").prop("checked",true); 
						$(".alterar_tamanhoX[value='800']").focus();
                    }
            td.attr("class","tamanho_alterar");
            
			
            });  

            // ALTERAR TAMANHO AO SAIR DO CAMPO ------------------------------------------------------------
            $(document).on("click",".alterar_tamanhoX",function(){   
			
			console.log($(this).focus());
            td=$(this).closest("td");
            id_linha= $(this).closest("tr").find("button").val();
				$.ajax({
					url:"alterar_coluna_milkshake.php",
					type:"post",
					data:{
							coluna:'tamanho',
							valor:$(".alterar_tamanhoX:checked").val(),
							id:id_linha
						},
					success: function()
					{
						tamanho = $(".alterar_tamanhoX:checked").val(),
						td.html(tamanho);
						td.attr("class","tamanho");
					}
				});
            }); 

           
            // FILTRAR (PESQUISA) ----------------------------------------------------------------------------
            $("#filtrar").click(function(){
                $.ajax({
                    url:"paginacao_milkshake.php",
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
                <h1 class="text-success ">Cadastro de Milkshake</h1>
                <br />
				<div class="form-group">
				
				<input type="text" class="form-control" name="sabor_m" id="sabor" placeholder="Sabor">
				<small id="tipo" class="form-text text-muted"></small>
			  </div>
			  
			  <div class="form-group">
				<input type="number" class="form-control" name="preco" id="preco" placeholder="Preço(unidade)">
				<small id="preco" class="form-text text-muted"></small>
			  </div>
			  <div class="input-group mb-3">
			  <div class="input-group-prepend">
				<div class="input-group-text">
				  <input type="radio" name = "tamanho" value = "300">
				</div>
			  </div>
			  <input type="" name = "tamanho " class="form-control" placeholder = "300 ml"> 
			</div>
			
            <div class="input-group mb-3">
			  <div class="input-group-prepend">
				<div class="input-group-text">
				  <input type="radio" name = "tamanho" value = "500">
				</div>
			  </div>
			  <input type="" name = "tamanho " class="form-control" placeholder = "500 ml"> 
			</div>

            <div class="input-group mb-3">
			  <div class="input-group-prepend">
				<div class="input-group-text">
				  <input type="radio" name = "tamanho" value = "800">
				</div>
			  </div>
			  <input type="" name = "tamanho " class="form-control" placeholder = "800 ml"> 
			</div>
			 
			
			  
                <br /><br />
				<input type="button" class="btn btn-success btn-lg btn-block btn_cadastra "  name = "btn_cadastra" value="Cadastrar" >

                <br />
                <br />
           </form>
                <div id = "status"></div>

                    

                <table border = "1">
                <form name = "filtro">
                <div class="form-group">
				<input type="text" class="form-control" name="nome_filtro" placeholder="Busca pelo nome...">
				<small id="filtro_btn" class="form-text text-muted"></small>
                <button type="button" class="btn btn-success" id="filtrar">Filtrar</button>
			  </div>
                   
                </form>
                <br />
				
						<div class = "container">
							<table class="table table-striped table-bordered table-hover table-rounded">
                    <thead>
                        <tr>
                            <th>Sabor</th> <th>Tamanho(ml)</th> <th>Preço(unidade)</th><th>Ação</th>
                        </tr>
                    </thead>

                
            
                    <tbody id = "tb">
                
                    </tbody>
                </table>
				<div id="paginacao">
                    <?php
                        include("paginacao_milkshake.php");
                    ?>
                </div>
                <br />
				</div>
				
                
				</fieldset>
       </div>
    </body>
</html>