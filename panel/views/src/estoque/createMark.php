<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urus Store</title>

    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>create.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>main-menu.css">

</head>
<body>
    
    <?php include PATH_VIEWS.'header.php'; ?>

    <main>
        <div class="container">

        <section>

            <h2>Cadastrar marca</h2>

            <form action="<?php echo FULL_PATH_PANEL; ?>marca/create" method="post">


                <label for="name">Nome da marca</label>
                <input type="text" name="name">

                <input type="submit" name="createMark" value="Enviar">

            </form>


        </section>

        </div>
    </main>

    <?php include PATH_VIEWS.'footer.php'; ?>
    <script src="<?php echo PATH_SCRIPTS; ?>header.js"></script>
</body>
</html>