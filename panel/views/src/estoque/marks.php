<?php

    require_once(PATH_VIEWS_GLOBAL.'notification.php');
    require_once(PATH_VIEWS_GLOBAL.'modal-confirm.php');

    if(isset($_SESSION['mark_success'])){
        setFlag('active', 'Sucesso', $_SESSION['mark_success']);
        $_SESSION['mark_success'] = null;
    }

    if(isset($_SESSION['mark_error'])){
        setFlag('active', 'Erro', $_SESSION['mark_error']);
        $_SESSION['mark_error'] = null;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urus Store</title>

    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>marks.css">
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
            <section id="marcas">

                <h2>Marcas cadastradas</h2>

                <table>

                    <thead>
                    
                        <tr>
                        <th> Nome </th>
                        </tr>

                    </thead>

                    <tbody>
                    
                        <?php 
                        
                        $marks = MarkModel::selectMark('*', '');
                        foreach($marks as $mark){ ?>

                        <tr>
                            <td><?php echo $mark['name']; ?></td>
                            <td><a href="<?php echo FULL_PATH_PANEL; ?>marca?id=<?php echo $mark['id']; ?>">Editar</a></td>
                            <td><a class="confirm-modal-trigger" href="<?php echo FULL_PATH_PANEL; ?>marca/delete?id=<?php echo $mark['id']; ?>">Deletar</a></td>

                            <?php if($mark['is_active']){ ?>

                                <td><a class="confirm-modal-trigger" href="<?php echo FULL_PATH_PANEL; ?>marca/disable?id=<?php echo $mark['id']; ?>">Desativar</a></td>

                                <?php }else{ ?>

                                <td><a class="confirm-modal-trigger" href="<?php echo FULL_PATH_PANEL; ?>marca/enable?id=<?php echo $mark['id']; ?>">Ativar</a></td>


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