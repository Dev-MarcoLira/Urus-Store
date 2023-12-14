<?php

  require_once(PATH_VIEWS_GLOBAL.'notification.php');

  if(isset($_SESSION['login_error'])){
    $error = $_SESSION['login_error'];
    setFlag('active', 'Erro', $error);
    $_SESSION['login_error'] = null;
  }

  if(isset($_SESSION['login_success'])){
    $error = $_SESSION['login_success'];
    setFlag('active', 'Sucesso', $error);
    $_SESSION['login_success'] = null;
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>login.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS_SITE; ?>notification.css">

  <Title>Urus Store</Title>
</head>

<body>
  <div class="main-login">

    <div class="left-login">
      <img src="<?php echo PATH_IMAGES ?>form.png" class="mg">
    </div>

    <div class="right-login">
      <div id="overlay">
        <form name="f1" method="get" autocomplete="off" action="<?php echo FULL_PATH_PANEL.'login/account'; ?>">

            <p class="p1"> LOGIN </p>

            <div class="text">
              <label for="email"> E-mail </label> <br>
            </div>

            <input type="email" name="email" maxlength="100" required placeholder="DIGITE SEU E-MAIL">

            <div class="text">
              <label for="senha"> Senha </label> <br>
            </div>

            <input type="password" maxlength="12" name="senha" required placeholder="DIGITE SUA SENHA" maxlength="15">

            <input type="submit" name="loginAction" value="ENTRAR">

          </form>
        
        <h3> &copy; Urus Store </h3>
      </div>
    </div>

    <script src="<?php echo PATH_SCRIPTS_SITE; ?>notification.js"></script>

</body>

</html>