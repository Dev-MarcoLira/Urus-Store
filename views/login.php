<?php

  require_once(PATH_VIEWS.'notification.php');

  if(isset($_SESSION['login_error'])){

    $errorMsg = $_SESSION['login_error'];
    setFlag('active', 'Erro', $errorMsg);

    $_SESSION['login_error'] = null;
  }

  if(isset($_SESSION['forgotPassword_error'])){
    $errorMsg = $_SESSION['forgotPassword_error'];
    setFlag('active', 'Erro', $errorMsg);

    $_SESSION['forgotPassword_error'] = null;
  }

  if(isset($_SESSION['forgotPassword_success'])){
    $errorMsg = $_SESSION['forgotPassword_success'];
    setFlag('active', 'Sucesso', $errorMsg);
    $_SESSION['forgotPassword_success'] = null;
  }

  if(isset($_SESSION['confirmMail_error'])){
    $errorMsg = $_SESSION['forgotPassword_error'];
    setFlag('active', 'Erro', $errorMsg);
    $_SESSION['forgotPassword_error'] = null;
  }

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>login.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>notification.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>fonts.css">

  <Title>Apolo Store</Title>
</head>

<body>
  <div class="main-login">

    <div class="left-login">
      <img src="<?php echo PATH_IMAGES ?>form.png" class="mg">
    </div>

    <div class="right-login">
      <div id="overlay">
        <form name="f1" autocomplete="off" method="post">

            <p class="p1"> LOGIN </p>

            <div class="text">
              <label for="email"> E-mail </label> <br>
            </div>

            <input type="email" maxlength="100" name="email" required placeholder="DIGITE SEU E-MAIL">

            <div class="text">
              <label for="senha"> Senha </label> <br>
            </div>

            <input type="password" maxlength="12" name="senha" required placeholder="DIGITE SUA SENHA" maxlength="15">

            <div class="rs">
              <a id="forgot" href="<?php echo FULL_PATH_SITE; ?>forgot-my-password/sendMail"> Esqueceu sua senha? </a>
            </div>

            <input type="submit" name="loginAction" value="ENTRAR">

            <h2> Ou </h2>

            <a href="<?php echo FULL_PATH_SITE ?>register">
              <h1> Cadastre-se</h1>
            </a>

          </form>
        
        <h3> &copy; Urus Store </h3>
      </div>
    </div>

  <script src="<?php echo PATH_SCRIPTS.'globals.js'; ?>"></script>
  <script src="<?php echo PATH_SCRIPTS.'notification.js'; ?>"></script>

</body>

</html>