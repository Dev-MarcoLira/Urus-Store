<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>changePassword.css">

    <title>Apolo Store</title>
</head>
<body>
    
    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>

        <form action="<?php echo FULL_PATH_SITE; ?>forgot-my-password" method="post">

        <label for="password">Nova senha</label>
            <input type="password" id="password" name="password" minlength="6" maxlength="12" onKeyUp="verificaForcaSenha()">

            <span id="password-status" class="password"></span>

            <label for-id="password2">Repita a senha</label>
            <input type="password" id="password2" minlength="6" maxlength="12">

            <span id="confirm-passwd-status" class="password"></span>

            <input type="submit" name="changePassword" onclick="verificaForcaSenha()">

        </form>


    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script src="<?php echo PATH_SCRIPTS ?>account-menu.js"></script>
  <script src="<?php echo PATH_SCRIPTS ?>verifyPassword.js"></script>
  <script src="<?php echo PATH_SCRIPTS ?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>

</body>
</html>