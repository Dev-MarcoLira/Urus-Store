<?php 

  require_once(PATH_VIEWS.'notification.php');
  require_once(PATH_VIEWS.'modal-confirm.php');
  $id = $_GET['protocolId'];
  $userId = Login::getId();

  $protocol = SacModel::selectProtocol('*', "WHERE id = $id");
  foreach($protocol as $prtc) $protocol = $prtc;

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

  $chats = SacModel::selectProtocol('id, title', "WHERE user_id = $userId");

?>

<html>
<head> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <title>Urus Store</title>

  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>protocol.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>notification.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>modal-confirm.css">
</head>
<body>
  <?php include(PATH_VIEWS.'header.php'); ?>

  <div class="main">
    <div class="fot2">
      <div id="chat-trigger">
        <img src="<?php echo PATH_ICONS; ?>icon_list.png" alt="chat list">
      </div>
      <div class="left">
        <h1 id="t">Chats</h1>
      </div>
      <div class="right"> 
        <div id="asensio">                                         
          <img src="<?php echo PATH_ICONS; ?>iconac.png">
          <p id="user"> Gerência </p>
        </div>
        <div id="spaco">
          <img src="<?php echo PATH_ICONS; ?>iconshop.png">
          <div id="options">
            <img src="<?php echo PATH_ICONS; ?>iconop.png">
            <div id="burger">
              <ul>
                <li><a class="confirm-modal-trigger" href="topic/finalizar?protocolId=<?php echo $id;?>">Finalizar</a></li>
                <li><a class="confirm-modal-trigger" href="topic/delete?protocolId=<?php echo $id;?>">Excluir</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

      
    <div class="pai">
      <div class="left">

        <div id="chats">

          <div id="novos">
            <div class="label">
              <span>Seus chats (<?php echo $chats->rowCount(); ?>) </span>

              <div class="img"></div>
            </div>

            <div class="chats">

            <?php 
            
              foreach($chats as $novo){ 
                $protocolId = $novo['id'];
                $username = '';
                
                foreach(MySQL::freeSelect("SELECT name FROM users WHERE id IN (SELECT user_id FROM sac_protocols WHERE id = $protocolId)") as $usrname)
                  $username = $usrname[0];
            ?>

              <div class="chat-single">

                <a href="<?php echo FULL_PATH_SITE."sac/topic?protocolId=$protocolId"; ?>">
                  <img src="<?php echo PATH_ICONS; ?>user.png" alt="Usuário">
                  <div class="texts">
                    <p class="username"><?php echo $username; ?></p>
                    <p class="title"> <?php echo $novo['title']; ?> </p>
                  </div>
                </a>

              </div>

            <?php } ?>

            </div>

          </div>

        </div>

        <?php include(PATH_VIEWS.'footer.php'); ?>

      </div>

      <div class="right"> 

        <div class="msgsdaddy">

          <div id="scroller">
            <?php
            
              if($messages = SacModel::selectMessages('*', "WHERE protocol_id = $id")) {
                  foreach($messages as $msg){
                      if($msg['user_id'] == $userId){
                          $class = 'enviando';
                      }else{
                          $class = 'recebendo';
                      }
                      $author = UserModel::selectUser('name', "WHERE id = ".$msg['user_id']);
                      foreach($author as $name) $author = $name[0];
            ?>
            <div class="<?php echo $class; ?>">
              <p><?php echo $msg['message']; ?></p>
            </div>
            <?php }} ?>
          </div>
        </div>        

        <?php if($protocol['status'] != 'finalizado'){ ?>
        <div class="baixo">
          <div id="add"><img src="<?php echo PATH_ICONS; ?>iconadd.png"></div>

          <form autocomplete="off" action="<?php echo FULL_PATH_SITE ?>sac/message/send" method="post">
            <input type="hidden" name="protocolId" value="<?php echo $id; ?>">
            <input type="text" name="message" required>

          </form>
          <p id="enviar"><img src="<?php echo PATH_ICONS; ?>iconsend.png"></p>
        </div>
        <?php }else {?>

        <div class="baixo" id="no-end">

          <p>Parece que a ocorrência já foi resolvida, a conversa foi marcada como</p>
          <p>Como "<span>Finalizada</span>".</p>
          <p>Nem você nem o usuário podem enviar mensagens nesse chat.</p>

        </div>

        <?php } ?>
      </div>
    </div>
  </div>

  <script src="<?php echo PATH_SCRIPTS; ?>account-menu.js"></script>
  <script src="<?php echo PATH_SCRIPTS; ?>globals.js"></script>
  <script src="<?php echo PATH_SCRIPTS; ?>notification.js"></script>
  <script src="<?php echo PATH_SCRIPTS.'modal-confirm.js' ?>"></script>
  <script src="<?php echo PATH_SCRIPTS; ?>protocol.js"></script>

</body>
</html>