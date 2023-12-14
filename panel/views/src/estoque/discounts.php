<?php

    require_once(PATH_VIEWS_GLOBAL.'notification.php');
    require_once(PATH_VIEWS_GLOBAL.'modal-confirm.php');

    if(isset($_SESSION['discount_success'])){
        setFlag('active', 'Sucesso', $_SESSION['discount_success']);
        $_SESSION['discount_success'] = null;
    }

    if(isset($_SESSION['discount_error'])){
        setFlag('active', 'Erro', $_SESSION['discount_error']);
        $_SESSION['discount_error'] = null;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urus Store</title>

    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>discounts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>notification.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>password_modal.css">
</head>
<body>
    
    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>
        <div class="container">

            <section id="discounts">

                <h2>Descontos</h2>

                <table>
                
                    <thead>
                        
                        <th> Nome </th>
                        <th> Descrição </th>
                        <th> Tipo </th>
                        <th> Valor </th>

                    </thead>

                    <tbody>
                        
                        <?php

                        $discounts = MySQL::select('*', 'discounts', '');

                        foreach($discounts as $discount){

                        ?>

                        <tr>

                            <td><?php echo $discount['name']; ?></td>
                            <td><?php echo $discount['description']; ?></td>
                            <td><?php echo $discount['type']; ?></td>
                            <td><?php echo $discount['discount']; ?></td>

                            <td><a href="<?php echo FULL_PATH_PANEL;?>discount?id=<?php echo $discount['id']; ?>">Editar</a></td>
                            <td><a class="confirm-modal-trigger" href="<?php echo FULL_PATH_PANEL; ?>discount/delete?id=<?php echo $discount['id']; ?>">Deletar</a></td>

                            <?php if($discount['is_active']){ ?>

                                <td><a class="confirm-modal-trigger" href="<?php echo FULL_PATH_PANEL; ?>discount/disable?id=<?php echo $discount['id']; ?>">Desativar</a></td>

                                <?php }else{ ?>

                                <td><a class="confirm-modal-trigger" href="<?php echo FULL_PATH_PANEL; ?>discount/enable?id=<?php echo $discount['id']; ?>">Ativar</a></td>


                            <?php } ?>

                        </tr>

                        <?php } ?>

                    </tbody>
                </table>

            </section>

        </div>
    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script src="<?php echo PATH_SCRIPTS; ?>header.js"></script>
    <script src="<?php echo PATH_SCRIPTS_SITE; ?>notification.js"></script>
    <script src="<?php echo PATH_SCRIPTS_SITE; ?>modal-confirm.js"></script>
</body>
</html>