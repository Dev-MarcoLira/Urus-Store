<?php

  require_once(PATH_VIEWS_GLOBAL.'notification.php');

  if(isset($_SESSION['sac_error'])){

    $msg = $_SESSION['sac_error'];
    setFlag('active', 'Erro', $msg);
    $_SESSION['sac_error'] = null;
  }

  if(isset($_SESSION['sac_success'])){

    $msg = $_SESSION['sac_success'];
    setFlag('active', 'Sucesso', $msg);
    $_SESSION['sac_success'] = null;
  }

  if(isset($_SESSION['sac_warn'])){
    setFlag('active', "Aviso", $_SESSION['sac_warn']);
    $_SESSION['sac_warn'] = null;
  }

  $novos = SacModel::selectProtocol('*', "WHERE status = 'novo'")->rowCount();
  $abertos = SacModel::selectProtocol('*', "WHERE status = 'aberto'")->rowCount();
  $finalizados = SacModel::selectProtocol('*', "WHERE status = 'finalizado'")->rowCount();

  $recentReview = ''; 
  $user = '';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Urus Store</title>

  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>clients.css">
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

        <h1 id="chats">chats </h1>
      
        <div class="atalhos">
          <a href="<?php echo FULL_PATH_PANEL; ?>sac/novos">
            <aside class="botao"> 
              <p id="notif">(<?php echo $novos; ?>)</p> 
              <img src="<?php echo PATH_ICONS_SITE; ?>message.png"> 
              <p>novos</p>
            </aside>
          </a>
          <a href="<?php echo FULL_PATH_PANEL; ?>sac/em-aberto"> 
            <aside class="botao">
              <p id="notif">(<?php echo $abertos; ?>)</p>  
              <img src="<?php echo PATH_ICONS_SITE; ?>messages2.png">  
              <p>em aberto</p>
            </aside>
          </a>
          <a href="<?php echo FULL_PATH_PANEL; ?>sac/finalizados">
            <aside class="botao">
              <p id="notif">(<?php echo $finalizados; ?>)</p>  
              <img src="<?php echo PATH_ICONS_SITE; ?>tick_circle.png">  
              <p>finalizados</p>
            </aside>
          </a>
        </div>
          <h3> avaliações recentes </h3>

          <?php 
            foreach(ReviewModel::selectReview('*', "ORDER BY created_at LIMIT 0, 2") as $review){
              $recentReview = $review;
              $userId = $review['user_id'];
              $productId = $review['product_id'];
              $user = '';
              $product = '';
              $rank = $review['rank'];

              $path = PATH_UPLOAD."products/$productId";
              $image = scandir($path)[2];

              foreach(UserModel::selectUser('id, name', "WHERE id = $userId") as $users)
                $user = $users;

              foreach(ProductModel::selectProduct('id, name', "WHERE id = $productId") as $pdct)
                $product = $pdct;
                   
          ?>

          <div class="rating">
            <div class="user"> 
              <div class="content">
                <img src="<?php echo PATH_ICONS_SITE; ?>user.png">
                <p><?php echo $user['name']; ?></p>
              </div>

              <div class="stars">
                <?php 
                  for($counter = 1; $counter <= 5; $counter++){ 
                    if($counter <= $rank){
                ?>

                  <img src="<?php echo PATH_ICONS_SITE; ?>star-shine.png">

                <?php }else{ ?>

                  <img class="empty" src="<?php echo PATH_ICONS_SITE; ?>star-review.png">

                <?php 
                    }
                  } 
                ?>
              </div>

            </div>
            
            <div class="product"> 
              <img src="<?php echo "$path/$image"; ?>" alt="produto avaliado">
              <p><?php echo $product['name']; ?></p>
            </div>

            <a href="<?php echo FULL_PATH_PANEL; ?>reviews">
              <aside class="seemore"> <a href="<?php echo FULL_PATH_PANEL.'estoque/products'; ?>">ver mais</a> </aside>
            </a>
          </div>

          <?php } ?>

      </section>
    </div>
  </main>


  <script src="<?php echo PATH_SCRIPTS.'header.js' ?>"></script>
  <script src="<?php echo PATH_SCRIPTS_SITE.'notification.js' ?>"></script>
  <script src="<?php echo PATH_SCRIPTS.'main-menu.js' ?>"></script>
  
</body>
</html>