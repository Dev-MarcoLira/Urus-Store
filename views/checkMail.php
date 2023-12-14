<?php

    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
    }else{
        $email = $_SESSION['login'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>fonts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>checkMail.css">

    <title>Apolo Store</title>
</head>
<body>
    
    <main>

        <div id="title">
            <h1>Confirme seu E-mail</h1>
        </div>

        <div id="center">

            <div class="wrapper">

                <div>
                    <span>Dentro de alguns minutos um e-mail será enviado para</span>
                    <span>"<?php echo $email; ?>" com um link para confirmar seu e-mail.</span>
                </div>

            </div>

            <div class="wrapper">

                <div>
                    <span>Atenção: em alguns casos, o e-mail pode ir para a aba "spam" ou</span>
                    <span>"Lixo eletrônico"</span>
                </div>

            </div>

        </div>

    </main>



    <?php include(PATH_VIEWS.'footer.php'); ?>

</body>
</html>