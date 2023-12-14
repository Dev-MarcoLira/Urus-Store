<?php

    require_once(PATH_VIEWS.'password_modal.php');
      require_once(PATH_VIEWS_GLOBAL.'notification.php');


    if(isset($_SESSION['settings_error'])){

        $errorMsg = $_SESSION['settings_error'];
        setFlag('active', 'Erro', $errorMsg);
        $_SESSION['settings_error'] = null;
    }

    if(isset($_SESSION['settings_success'])){

        $errorMsg = $_SESSION['settings_success'];
        setFlag('active', 'Sucesso', $errorMsg);
        $_SESSION['settings_success'] = null;
    }

    $funcSql = "WHERE role = 'func'";
    $admSql = "WHERE role = 'adm'";

    $adms = UserModel::selectUser('id, name, email', $admSql);
    $funcs = UserModel::selectUser('id, name, email', $funcSql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>main-menu.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>settings.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>password_modal.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>notification.css">

    <title>Urus Store</title>
</head>
<body>
    
    <div id="menu-trigger">
        <img src="<?php echo PATH_ICONS_SITE; ?>icon_list.png" alt="menu">
    </div>

    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>
        <div class="container">

            <?php include(PATH_VIEWS.'main-menu.php'); ?>

            <div id="right">
                <div id="register">
                    <h2>Cadastro de funcionários/ADMs</h2>
                    <form action="<?php echo FULL_PATH_PANEL; ?>settings/user/register" method="post">
                
                        <div id="fieldset">
                            <div>
                                <label for="email">E-mail</label>
                                <input type="email" name="email" required>
                            </div>
                            <div>
                                <label>Cargo</label>
                                <select name="role" required>
                                    <option value="func">Funcionário</option>
                                    <option value="adm">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" name="form" value="Cadastrar">
                    </form>
                </div>
                <div id="users">
                
                    <h2>Administradores (<?php echo $adms->rowCount(); ?>)</h2>
                    <div class="user-info">
                        <?php foreach($adms as $adm){ ?>
                        <div class="user-box">
                            
                            <div class="name">
                                <span><?php echo $adm['name']; ?></span>
                            </div>
                    
                            <div class="email">
                                <span><?php echo $adm['email']; ?></span>
                            </div>
                    
                        
                            <span class="link"><a href="<?php echo FULL_PATH_PANEL; ?>settings/user/disable?id=<?php echo $adm['id']; ?>">Descadastrar</a></span>
                        
                        </div>
                        <?php } ?>
                    </div>
                    <h2>Funcionários (<?php echo $funcs->rowCount(); ?>)</h2>
                    <div class="user-info">

                    <?php foreach($funcs as $func){ ?>
                        <div class="user-box">
                        
                            <div class="name">
                                <span><?php echo $func['name']; ?></span>
                            </div>

                            <div class="email">
                                <span><?php echo $func['email']; ?></span>
                            </div>

                            <span class="link"><a href="<?php echo FULL_PATH_PANEL; ?>settings/user/disable?id=<?php echo $func['id']; ?>">Descadastrar</a></span>

                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script src="<?php echo PATH_SCRIPTS; ?>header.js"></script>
    <script src="<?php echo PATH_SCRIPTS_SITE; ?>globals.js"></script>
    <script src="<?php echo PATH_SCRIPTS; ?>password_modal.js"></script>
    <script src="<?php echo PATH_SCRIPTS_SITE; ?>notification.js"></script>
    <script src="<?php echo PATH_SCRIPTS; ?>main-menu.js"></script>
    
</body>
</html>