<?php

    require_once(PATH_VIEWS.'notification.php');
    require_once(PATH_VIEWS.'modal-confirm.php');

    $email = $_SESSION['login'];
    $user = UserModel::selectUser('*', "WHERE email = '$email'");
    
    foreach($user as $abc) $user = $abc;

    $id = $user['id'];

    if(isset($_SESSION['sac_error'])){
        $errorMsg = $_SESSION['sac_error'];
        setFlag('active', 'Erro', $errorMsg);
        $_SESSION['sac_error'] = null;
    }else{
        if(isset($_SESSION['sac_success'])){
            $msg = $_SESSION['sac_success'];
            setFlag('active', 'Sucesso', $msg);
            $_SESSION['sac_success'] = null;
        }
    }

    $novos = SacModel::selectProtocol('*', "WHERE user_id = $id AND status = 'novo'");
    $abertos = SacModel::selectProtocol('*', "WHERE user_id = $id AND status = 'aberto'");
    $finalizados = SacModel::selectProtocol('*', "WHERE user_id = $id AND status = 'finalizado'");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apolo Store</title>

    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>sac.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>notification.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS_PANEL; ?>password_modal.css">

</head>
<body>
    
    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>

        <div class="container">

            <section id="messages-container">

                <div id="messages">

                    <?php 
                        
                        if($novos->rowCount() > 0){
                            
                            
                    ?>

                    <section>

                        <h2>Novos</h2>

                        <?php foreach($novos as $message){ ?>

                        <div class="message-single">

                            <div class="center">
                                <a href="<?php echo FULL_PATH_SITE; ?>sac/topic?protocolId=<?php echo $message['id']; ?>">
                                    <p><?php echo $message['title']; ?></p>
                                    <a class="delete confirm-modal-trigger" href="<?php echo FULL_PATH_SITE; ?>sac/topic/delete?protocolId=<?php echo $message['id']; ?>">Deletar</a>
                                </a>
                            </div>

                        </div>

                        <?php } ?>

                    </section>

                    <?php } ?>

                    <?php 
                        
                        if($abertos->rowCount() > 0){
                            
                            
                    ?>

                    <section>
                        <h2>Em aberto</h2>
                        
                        <?php foreach($abertos as $message){ ?>

                        <div class="message-single">
                            <div class="center">
                                <a href="<?php echo FULL_PATH_SITE; ?>sac/topic?protocolId=<?php echo $message['id']; ?>">
                                    <p><?php echo $message['title']; ?></p>
                                    <a class="delete confirm-modal-trigger" href="<?php echo FULL_PATH_SITE; ?>sac/topic/delete?protocolId=<?php echo $message['id']; ?>">Deletar</a>
                                </a>
                            </div>
                        </div>

                        <?php } ?>
                    </section>

                    <?php } ?>

                    <?php 
                        
                        if($finalizados->rowCount() > 0){
                            
                            
                    ?>

                    <section>
                        <h2>Finalizados</h2>
                        <?php foreach($finalizados as $message){ ?>

                        <div class="message-single">

                            <div class="center">
                                <a href="<?php echo FULL_PATH_SITE; ?>sac/topic?protocolId=<?php echo $message['id']; ?>">
                                    <p><?php echo $message['title']; ?></p>
                                    <a class="delete confirm-modal-trigger" href="<?php echo FULL_PATH_SITE; ?>sac/topic/delete?protocolId=<?php echo $message['id']; ?>">Deletar</a>
                                </a>
                            </div>

                        </div>

                        <?php } ?>
                    </section>

                    <?php } ?>

                </div>

                <div id="form">

                    <form action="<?php echo FULL_PATH_SITE."sac/topic/create"; ?>" method="post">
                        <input type="hidden" name="userId" value="<?php echo $id; ?>">
                        <textarea resize="false" name="message" cols="25" rows="10"></textarea>
                        <input type="submit" id="sendMessage" name="sendMessage" value="Iniciar Atendimento">
                    </form>

                </div>

            </section>

        </div>

    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>notification.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>modal-confirm.js"></script>

</body>
</html>