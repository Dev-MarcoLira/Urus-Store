<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>changePasswordMail.css">

    <title>Apolo Store</title>
</head>
<body>
    
    <header>
        <div class="container">
            <a href="<?php echo FULL_PATH_SITE; ?>">
                <div class="logo"></div>
            </a>
        </div>

        <hr>
    </header>

    <main>

        <form action="<?php echo FULL_PATH_SITE; ?>forgot-my-password/sendMail" method="post">

            <label for="password">E-mail</label>
            <input type="email" id="password" name="email" maxlength="100">

            <input type="submit" name="sendEmail">

        </form>


    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script src="<?php echo PATH_SCRIPTS ?>account-menu.js"></script>
  <script src="<?php echo PATH_SCRIPTS ?>verifyPassword.js"></script>
  <script src="<?php echo PATH_SCRIPTS ?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>

</body>
</html>