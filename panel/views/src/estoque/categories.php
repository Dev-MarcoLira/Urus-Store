<?php

    require_once(PATH_VIEWS_GLOBAL.'notification.php');
    require_once(PATH_VIEWS_GLOBAL.'modal-confirm.php');

    if(isset($_SESSION['category_success'])){
        setFlag('active', 'Sucesso', $_SESSION['category_success']);
        $_SESSION['category_success'] = null;
    }

    if(isset($_SESSION['category_error'])){
        setFlag('active', 'Erro', $_SESSION['category_error']);
        $_SESSION['category_error'] = null;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urus Store</title>

    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>categories.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>notification.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS ?>password_modal.css">
</head>
<body>
    
    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>
        <div class="container">
            <section id="categories">

                <h2>Categorias</h2>

                <table> 
                    <thead>
                        
                        <th> Nome </th>
                        <th> Descrição </th>

                    </thead>

                    <tbody>
                        
                        <?php
                        $categories = MySQL::select('*', 'categories', '');            
                        foreach($categories as $category){

                        ?>

                        <tr>
                        
                            <td><?php echo $category['name']; ?></td>
                            <td><?php echo $category['description']; ?></td>

                            <td><a href="<?php echo FULL_PATH_PANEL; ?>category?id=<?php echo $category['id']; ?>">Editar</a></td>
                            <td><a class="confirm-modal-trigger" href="<?php echo FULL_PATH_PANEL; ?>category/delete?id=<?php echo $category['id']; ?>">Deletar</a></td>

                            <?php if($category['is_active']){ ?>

                                <td><a class="confirm-modal-trigger" href="<?php echo FULL_PATH_PANEL; ?>category/disable?id=<?php echo $category['id']; ?>">Desativar</a></td>

                            <?php }else{ ?>

                                <td><a class="confirm-modal-trigger" href="<?php echo FULL_PATH_PANEL; ?>category/enable?id=<?php echo $category['id']; ?>">Ativar</a></td>


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