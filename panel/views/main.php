<?php

  require_once(PATH_VIEWS_GLOBAL.'notification.php');

  $sails = PaymentModel::selectPayments('id', "WHERE DATE(created_at) = CURDATE()")->rowCount();
  $sql = "ORDER BY created_at DESC LIMIT 0, 1";
  $usersAmount = PaymentModel::selectPayments('user_id', $sql);
  $users = '';
  $usersToday = UserModel::selectUser('name', "WHERE DATE(created_at) = CURDATE()")->rowCount();
  
  foreach($usersAmount as $usr)
    $users = $usr[0];

  if(isset($_SESSION['settings_error'])){
    setFlag('active', 'aviso', $_SESSION['settings_error']);
    $_SESSION['settings_error'] = null;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Urus Store</title>

  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>main.css">
  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>main-menu.css">
  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
  <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
  <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>notification.css">

</head>
<body>
  
  <div id="menu-trigger">
    <img src="<?php echo PATH_ICONS_SITE; ?>icon_list.png" alt="menu">
  </div>

  <?php include(PATH_VIEWS.'header.php'); ?>

  <main>

    <div class="container">
      
      <?php include(PATH_VIEWS.'main-menu.php'); ?>

      <section id="right">

        <h1 id="main">PAINEL DE CONTROLE</h1>
        <h3 id="welcome"> BEM VINDO ADM, COMECE A CONFIGURAR AGORA</h3>

        <div class="atalhos">
          <a href="<?php echo FULL_PATH_PANEL; ?>estoque">
            <aside class="botao"> 
              <img src="<?php echo PATH_ICONS_SITE; ?>etiqueta.png"> 
              <p>Cadastro de produtos</p>
            </aside>
          </a>
          <aside class="botao"> 
            <img src="<?php echo PATH_ICONS_SITE; ?>delivery_truck.png">  
            <p>Entregas</p>
          </aside>
          <aside class="botao"> 
            <img src="<?php echo PATH_ICONS_SITE; ?>credit_card.png">  
            <p>Formas de pagamento </p>
          </aside>
        </div>

        <div class="stats">
          <aside class="users"> Novos usuários hoje: </aside>
          <aside class="sold"> Compras feitas hoje: </aside>
          <aside class="nusers"> <?php echo $usersToday; ?> </aside>
          <aside class="nsold"> <?php echo $sails; ?> </aside>

          <?php if($usersAmount->rowCount() > 0){ 
            
            $id = $users;
            $userName = UserModel::getName("WHERE id = $id");
            
          ?>
          
            <aside class="jbuy"> O usuário "<span><?php echo $userName; ?></span>" realizou uma compra recentemente </aside>

          <?php } ?>
        </div>

      </section>

    </div>

  </main>

  <?php include(PATH_VIEWS.'footer.php'); ?>
  <script src="<?php echo PATH_SCRIPTS.'header.js'; ?>"></script>
  <script src="<?php echo PATH_SCRIPTS_SITE.'notification.js'; ?>"></script>
  <script src="<?php echo PATH_SCRIPTS.'main-menu.js'; ?>"></script>

</body>
</html>