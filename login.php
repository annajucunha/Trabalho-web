<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>

        body
        {
           background:url("rosa.png")  no-repeat center top fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

        }
        .welcome
        {
          text-align:center;
          color:white;
        }
        
    </style>
</head>

<?php

    include("menu.php");
    include("conexao.php");
    ?>
<body>

<form method ="POST" action="validacao.php">
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto" style="margin-top:-600px;">
      <div class = "welcome"><h1>Bem Vindo á Sorveteria Online</h1></div>
        <div class="card card-signin my-5" style="border-color:lightpink;">
          <div class="card-body">
            <h5 class="card-title text-center"style="color:lightpink;">Login</h5>
            <form class="form-signin">
              <div class="form-label-group" style="color:lightpink;">
                <input type="email" id="email" class="form-control text-danger" name = "email" placeholder="Email" required autofocus>
                <label for="inputEmail">Endereço de email</label>
              </div>

              <div class="form-label-group" style="color:lightpink;">
                <input type="password" id="senha" class="form-control text-danger" name="senha" placeholder="Senha" required>
                <label for="inputPassword">Senha</label>
              </div>

              
              <button class="btn btn-lg btn-primary btn-block text-uppercase" style="border-color:lightpink;background-color:lightpink;" type="submit">Entrar</button>
              <hr class="my-4">
              <div class= "" style="color:lightpink;"<label for="cadastras ">Ainda não é cadastrado? Cadastre-se já!</label></div>
              <button class="btn btn-lg btn-google btn-block text-uppercase" style="border-color:lightpink;background-color:lightpink;color:white;" type="submit" onclick = "location.href='form_cadastro.php'"><i class="fab fa-google mr-2"></i> Cadastrar-se</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" style="border-color:lightpink;background-color:lightpink;color:white;" type="submit" onclick = "location.href='index.php'"><i class="fab fa-facebook-f mr-2"></i> Entrar como convidado</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>