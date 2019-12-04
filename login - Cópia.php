<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
</head>

<body>
<form method ="POST" action="validacao.php">
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Login</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="email" id="email" class="form-control" name = "email" placeholder="Email" required autofocus>
                <label for="inputEmail">Endereço de email</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="senha" class="form-control" name="senha" placeholder="Senha" required>
                <label for="inputPassword">Senha</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="lembrar">
                <label class="custom-control-label" for="customCheck1">Lembrar senha</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
              <hr class="my-4">
              <label for="cadastras">Ainda não é cadastrado? Cadastre-se já!</label>
              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit" onclick = "location.href='form_cadastro.php'"><i class="fab fa-google mr-2"></i> Cadastrar-se</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit" onclick = "location.href='index.php'"><i class="fab fa-facebook-f mr-2"></i> Entrar como convidado</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>