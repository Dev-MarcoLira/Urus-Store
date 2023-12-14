<?php

require_once(PATH_VIEWS_GLOBAL.'notification.php');
require_once(PATH_VIEWS_GLOBAL.'modal-confirm.php');

    if(SacModel::selectProtocol('*', "WHERE status = '$delimiter'")->rowCount() > 0){
        $chats = SacModel::selectProtocol('*', "WHERE status = '$delimiter'");
    }else{
        $_SESSION['sac_warn'] = "Nenhum atendimento encontrado!";
        Login::redirect(FULL_PATH_PANEL.'sac');
    }
?>


<html>
<head> <title>Urus Store</title>
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>sac.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>password_modal.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS_SITE; ?>notification.css">
</head>
<body>

    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>

        <div id="chats">

            <div class="container">
                <?php
                
                    if(isset($chats)){
                        foreach($chats as $chat){
                
                            $id = $chat['id'];
                            $userId = '';
                            foreach(SacModel::selectProtocol('user_id', "WHERE id = $id") as $uId){
                                $userId = $uId[0];
                            }
                
                            $userName = '';
                            foreach(UserModel::selectUser('name', "WHERE id = $userId") as $name){
                                $userName = $name[0];
                            }
                ?>
                <div class="chat-single">
                
                    <div class="user">
                        <div class="img">
                            <div class="box-img"><img src="<?php echo PATH_ICONS_SITE; ?>user.png" alt="imagem do usuário"></div>
                            <span><?php echo $userName; ?></span>
                        </div>
                        <div>
                            <span> <?php echo $chat['status']; ?> </span>
                        </div>
                    </div>
                    <div>
                        <p><span> <?php echo $chat['title']; ?> </span></p>
                    </div>

                    <div class="links">
                        <a class="view" href="<?php echo FULL_PATH_PANEL."sac/topic?protocolId=$id" ?>">Visualizar atendimento</a>
                        <a class="delete confirm-modal-trigger" href="<?php echo FULL_PATH_PANEL."sac/topic/delete?protocolId=$id" ?>">Deletar</a>
                    </div>
                </div>
                <?php
                        }
                    }else{
                ?>
                <span id="no-chats">Nenhum chat de atendimento detectado!</span>
                <?php } ?>
            </div>

        </div>

    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script src="<?php echo PATH_SCRIPTS.'header.js'; ?>"></script>
    <script src="<?php echo PATH_SCRIPTS_SITE.'modal-confirm.js'; ?>"></script>
    <script src="<?php echo PATH_SCRIPTS_SITE.'notification.js'; ?>"></script>

</body>
</html>