
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
            border-color:white;
            

           
        }
        body
        {
           background:url("cinza.jpg")  no-repeat center top fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

        }
        img
        {
            opacity:0.5;
        }
        
    </style>
    <meta charset = "utf-8"/>
    <script src = "jquery-3.4.1.min.js"></script>

    
     
    <?php
    include("menu.php");
    include("conexao.php");
    ?> 




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
                    url:"carrega_cadastro_alterar.php",
                    type:"post",
                    data:{id: id},
                    success: function(vetor)
                    {
                        $("input[name='nome']").val(vetor.nome);
                        $("input[name='email']").val(vetor.email);
                        $("input[name='data_nascimento']").val(vetor.data_nascimento);
                        $("input[name='telefone']").val(vetor.telefone);
                        $("input[name='senha']").val(vetor.senha);

                        if(vetor.sexo=="f")
                        {
                            $("input[name='sexo'][value='m']").attr("checked",false);
                            $("input[name='sexo'][value='f']").attr("checked",true);
                        }
                        else
                        {
                            $("input[name='sexo'][value='f']").attr("checked",false);
                            $("input[name='sexo'][value='m']").attr("checked",true);   
                        }
                        $(".btn_cadastra").attr("class","alteracao  btn btn-secondary"); // muda o nome do botao cadastrar para Alterar
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
                    url:"carrega_cadastro.php",
                    type:"post",
                    data:{pg:p, nome_filtro: filtro},
                    success:function(matriz)
                    {
                       console.log(matriz);
                        $("#tb").html("");
                        for (i=0;i<matriz.length;i++)
                        {
                            linha = "<tr>";
                            linha += "<td class = 'nome'>" + matriz[i].nome + "</td>";
                            linha += "<td class = 'email'>" + matriz[i].email + "</td>";
                            linha += "<td class = 'sexo'>" + matriz[i].sexo + "</td>";
                            linha += "<td class = 'telefone'>" + matriz[i].telefone + "</td>";
                            linha += "<td class = 'data_nascimento'>" + matriz[i].data_nascimento + "</td>";
                            linha += "<td><button type = 'button'  class = 'alterar  btn btn-secondary'  value='"+ matriz[i].id_usuario + "'>Alterar</button> <button type = 'button' class = 'btn_remover btn btn-secondary' value ='" + matriz[i].id_usuario + "'>Remover</button> </td>";
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
						url:"insere.php",
						type:"post",
						data:
						{
							nome: $("input[name='nome']").val(),
							email:$("input[name='email']").val(),
                            telefone:$("input[name='telefone']").val(),
                            sexo:$("input[name='sexo']:checked").val(),
                            senha:$("input[name='senha']").val(),
                            data_nascimento:$("input[name='data_nascimento']").val()
						},
						
						success:function(data)
						{
							if(data==1)
							{
								$("#status").html("Usuario inserido");
                                $("#status").css("color","pink");
                                paginacao(0);
								
								qtd_linha = $("#tb tr").length;
								qtd_coluna = $("#tb td").length;

								if(qtd_linha == 0 && qtd_coluna == 0)
								{
									linha = "<tr><td colspan = '6'> Não há pessoas cadastradas</td></tr>";
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
						url:"remover_usuario.php",
						type:"post",
						data:
						{
							id_usuario: a
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
								$("#status").html("Usuario excluido!");
								$("#status").css("color","purple");
								$("#status").css("text-aling","center");
								linha.remove();
								qtd_linha = $("#tb tr").length;
								qtd_coluna = $("#tb td").length;

								if(qtd_linha == 0 && qtd_coluna == 0)
								{
									linha = "<tr><td colspan = '6'> Não há usuarios cadastrados</td></tr>"
									$("#tb_artista").append(linha);
								}
							}
							else
							{
								$("#status").html("ERRO");
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
                    url:"alteracao_cadastro.php",
                    type:"post",
                    data:
                    {
                        id: id,
                        nome: $("input[name='nome']").val(),
                        email:$("input[name='email']").val(),
                        telefone:$("input[name='telefone']").val(),
                        sexo:$("input[name='sexo']:checked").val(),
                        senha:$("input[name='senha']").val(),
                        data_nascimento:$("input[name='data_nascimento']").val(),
                    },
                    success:function(data)
                    {
                        if(data==1)
                        {
                            $("#status").html("Usuario alterado");
                            $("#status").css("color","blue");
                            paginacao(0);
                            $("input[name='nome']").val("");
                            $("input[name='email']").val("");
                            $("input[name='telefone']").val("");
                            $("input[name='sexo'] [value='m']").attr("checked",false);
                            $("input[name='sexo'] [value='f']").attr("checked",false);
                            $("input[name='senha']").val("");
                            $("input[name='data_nascimento']").val("");

                            $(".alteracao").attr("class","btn_cadastra  btn btn-block btn-secondary"); // muda o nome devolta para cadastrar
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
            $(document).on("click",".nome",function(){    
                
                td= $(this);
                nome= td.html();
                td.html("<input type='text' id='nome_alterar' name='nome' value='" + nome +"' />");
                td.attr("class","nome_alterar");
                $("#nome_alterar").focus();
                
            });  

            // ALTERAR O NOME AO SAIR DO CAMPO -----------------------------------------------------------------
            $(document).on("blur",".nome_alterar",function(){    
                td = $(this).closest("td");
                id_linha= $(this).closest("tr").find("button").val();
                $.ajax({
                    url:"alterar_coluna.php",
                    type:"post",
                    data:{
                            coluna:'nome',
                            valor:$("#nome_alterar").val(),
                            id:id_linha
                         },
                    success: function()
                    {
                        td.html($("#nome_alterar").val());
                        td.attr("class","nome");
                    }
                });
               
            }); 

            // ALTERAR O EMAIL ------------------------------------------------------------------------------  

            $(document).on("click",".email",function(){    
                
                td= $(this);
                email= td.html();
                td.html("<input type='text' id='email_alterar' name='email' value='" + email +"' />");
                td.attr("class","email_alterar");
                $("#email_alterar").focus();
                
            });  

            // ALTERAR EMAIL AO SAIR DO CAMPO ------------------------------------------------------------
            $(document).on("blur",".email_alterar",function(){    
                td=$(this);
                id_linha2= $(this).closest("tr").find("button").val();
                $.ajax({
                    url:"alterar_coluna.php",
                    type:"post",
                    data:{
                            coluna:'email',
                            valor:$("#email_alterar").val(),
                            id:id_linha2
                         },
                    success: function()
                    {
                        email = $("#email_alterar").val(),
                        td.html(email);
                        td.attr("class","email");
                    }
                });
               
            }); 

            // ALTERAR O TELEFONE------------------------------------------------------------------------------  

            $(document).on("click",".telefone",function(){    
                
                td= $(this);
                telefone= td.html();
                td.html("<input type='text' id='telefone_alterar' name='telefone' value='" + telefone +"' />");
                td.attr("class","telefone_alterar");
                $("#telefone_alterar").focus();
                
            });  

            // ALTERAR TELEFONE AO SAIR DO CAMPO ------------------------------------------------------------
            $(document).on("blur",".telefone_alterar",function(){    
                td=$(this);
                id_linha= $(this).closest("tr").find("button").val();
                $.ajax({
                    url:"alterar_coluna.php",
                    type:"post",
                    data:{
                            coluna:'telefone',
                            valor:$("#telefone_alterar").val(),
                            id:id_linha
                         },
                    success: function()
                    {
                        salario = $("#telefone_alterar").val(),
                        td.html(salario);
                        td.attr("class","telefone");
                    }
                });
               
            }); 

             // ALTERAR O SEXO------------------------------------------------------------------------------  

            $(document).on("click",".sexo",function(){    
                
                td= $(this);
                sexo= td.html();
                sexo_input="<input type='radio' class='alterar_sexo' name='sexo' value='M' />M";
                sexo_input +="<input type='radio' class='alterar_sexo' name='sexo' value='F' />F";
                td.html(sexo_input);

                 if(sexo=="M")
                        {
                            $(".alterar_sexo[value='M']").prop("checked",true);
                            $(".alterar_sexo[value='F']").prop("checked",false);                        }
                        else
                        {
                            $(".alterar_sexo[value='M']").prop("checked",false);
                            $(".alterar_sexo[value='F']").prop("checked",true); 
                        }
                td.attr("class","sexo_alterar");
                $("#sexo_alterar").focus();
                
            });  

            // ALTERAR SEXO AO SAIR DO CAMPO ------------------------------------------------------------
            $(document).on("blur",".sexo_alterar",function(){    
                td=$(this);
                id_linha= $(this).closest("tr").find("button").val();
                $.ajax({
                    url:"alterar_coluna.php",
                    type:"post",
                    data:{
                            coluna:'sexo',
                            valor:$(".alterar_sexo:checked").val(),
                            id:id_linha
                         },
                    success: function()
                    {
                        sexo = $(".alterar_sexo:checked").val(),
                        td.html(sexo);
                        td.attr("class","sexo");
                    }
                });
               
            }); 

            // ALTERAR A DATA ------------------------------------------------------------------------------  

            $(document).on("click",".data_nascimento",function(){    
                
                td= $(this);
                data= td.html();
                td.html("<input type='data' id='data_alterar' name='data_nascimento' value='" + data +"' />");
                td.attr("class","data_alterar");
                $("#data_alterar").focus();
                
            });  

            // ALTERAR DATA AO SAIR DO CAMPO ------------------------------------------------------------
            $(document).on("blur",".data_alterar",function(){    
                td=$(this);
                id_linha= $(this).closest("tr").find("button").val();
                $.ajax({
                    url:"alterar_coluna.php",
                    type:"post",
                    data:{
                            coluna:'data_nascimento',
                            valor:$("#data_alterar").val(),
                            id:id_linha
                         },
                    success: function()
                    {
                        salario = $("#data_alterar").val(),
                        td.html(salario);
                        td.attr("class","data_nascimento");
                    }
                });
               
            }); 

            // FILTRAR (PESQUISA) ----------------------------------------------------------------------------
            $("#filtrar").click(function(){
                $.ajax({
                    url:"paginacao.php",
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
                <h1 class="text-secondary">Cadastrar Usuário</h1>
                <br />
				<div class="form-group">
				
				<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
				<small id="nome" class="form-text text-muted"></small>
			  </div>
			  
			  <div class="form-group">
				<input type="text" class="form-control" name="email" id="email" placeholder="Email">
				<small id="email" class="form-text text-muted"></small>
			  </div>
			  
			  <div class="form-group">
				<input type="date" class="form-control" name="data_nascimento" id="data" placeholder="Data Nascimento">
				<small id="data" class="form-text text-muted"></small>
			  </div>
			  
			  <div class="input-group mb-3">
			  <div class="input-group-prepend">
				<div class="input-group-text">
				  <input type="radio" name = "sexo" value = "m">
				</div>
			  </div>
			  <input type="" name = "s " class="form-control" placeholder = "Masculino"> 
			</div>
			
            <div class="input-group mb-3">
			  <div class="input-group-prepend">
				<div class="input-group-text">
				  <input type="radio" name = "sexo" value = "f">
				</div>
			  </div>
			  <input type="" name = "s " class="form-control" placeholder = "Feminino"> 
			</div>

            <div class="form-group">
				<input type="number" class="form-control" name="telefone" id="telefone" placeholder="Telefone">
				<small id="telefone" class="form-text text-muted"></small>
			  </div>

              <div class="form-group">
				<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
				<small id="senha" class="form-text text-muted"></small>
			  </div>
			 
			
			  
                <br /><br />
				<input type="button" class="btn_cadastra btn btn-secondary btn-lg btn-block "  id ="btn_cadastra" name = "btn_cadastra" value="Cadastrar" >

                <br />
                <br />
            </form>
                <div id = "status"></div>

                    

                 <?php
                     include("verificado_usuario.php");
                ?> 
                <table border = "1">
                <form name = "filtro">
                <div class="form-group">
				<input type="text" class="form-control" name="nome_filtro" placeholder="Busca pelo nome...">
				<small id="filtro_btn" class="form-text text-muted"></small>
                <button type="button" class="btn btn-secondary" id="filtrar">Filtrar</button>
			  </div>
                   
                </form>
                <br />
				
						<div class = "container">
							<table class="table table-striped table-bordered table-hover table-rounded">
                    <thead>
                        <tr>
                            <th>Nome</th> <th>Email</th> <th>Sexo</th> <th>Telefone</th> <th>Data Nascimento</th> <th>Ação</th>
                        </tr>
                    </thead>

                
            
                    <tbody id = "tb">
                
                    </tbody>
                </table>
                <br />
                <div id="paginacao">
                    <?php
                        include("paginacao.php");
                    ?>
                </div>
            </fieldset>
    </body>
</html>