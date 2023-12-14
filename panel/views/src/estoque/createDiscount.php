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
            
                <h2>Criar descontos</h2>

                <form action="<?php echo FULL_PATH_PANEL;?>discount/create" name="formCreateDiscount" method="post">
                
                    <label for="dName">Nome do desconto*</label>
                    <input type="text" name="dName">

                    <label for="dDescription">Descrição</label>
                    <input type="text" name="dDescription">

                    <label for="dType">Tipo de desconto</label>

                    <select name="dType">
                    
                        <option value="preco">Valor (R$)</option>
                        <option value="porcen">Porcentagem (%)</option>
                    
                    </select>

                    <label for="dValue">Valor do desconto*</label>
                    <input type="text" name="dValue">

                    <input type="submit" name="createDiscount">
                </form>
            
            </section>

        </div>
    </main>

    <?php include PATH_VIEWS.'footer.php'; ?>
    <script src="<?php echo PATH_SCRIPTS; ?>header.js"></script>

</body>
</html>