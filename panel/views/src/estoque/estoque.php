<?php

  require_once(PATH_VIEWS_GLOBAL.'notification.php');

  if(isset($_SESSION['product_error'])){
    $error = $_SESSION['product_error'];
    setFlag('active', 'Erro', $error);
    $_SESSION['product_error'] = null;
  }

  if(isset($_SESSION['product_success'])){
    $msg = $_SESSION['product_success'];
    setFlag('active', 'Sucesso', $msg);
    $_SESSION['product_success'] = null;
  }

  if(isset($_SESSION['category_error'])){
    $error = $_SESSION['category_error'];
    setFlag('active', 'Erro', $error);
    $_SESSION['category_error'] = null;
  }

  if(isset($_SESSION['category_success'])){
    $msg = $_SESSION['category_success'];
    setFlag('active', 'Sucesso', $msg);
    $_SESSION['category_success'] = null;
  }

  if(isset($_SESSION['mark_error'])){
    $error = $_SESSION['mark_error'];
    setFlag('active', 'Erro', $error);
    $_SESSION['mark_error'] = null;
  }

  if(isset($_SESSION['mark_success'])){
    $msg = $_SESSION['mark_success'];
    setFlag('active', 'Sucesso', $msg);
    $_SESSION['mark_success'] = null;
  }

  if(isset($_SESSION['discount_error'])){
    $error = $_SESSION['discount_error'];
    setFlag('active', 'Erro', $error);
    $_SESSION['discount_error'] = null;
  }

  if(isset($_SESSION['discount_success'])){
    $msg = $_SESSION['discount_success'];
    setFlag('active', 'Sucesso', $msg);
    $_SESSION['discount_success'] = null;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Urus Store</title>

  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>estoque.css">
  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
  <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>main-menu.css">
  <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>notification.css">

</head>

<body>

  <div id="menu-trigger">
    <img src="<?php echo PATH_ICONS_SITE; ?>icon_list.png" alt="menu">
  </div>

 <?php include PATH_VIEWS.'header.php'; ?>

  <main>
    
    <div class="container">
      
      <?php include(PATH_VIEWS.'main-menu.php'); ?>

      <section id="right">

        <div>
          <section class="topic" id="products">
            <h2>Produtos</h2>
            <div class="content">
              <div class="box list">
                <a href="<?php echo FULL_PATH_ESTOQUE; ?>products">
                  <div class="amount"><span>(<?php echo $products ? $products : '0'; ?>)</span></div>
                  <div class="bag"><img src="<?php echo PATH_ICONS_SITE.'iconshop.png' ?>" alt="lista de produtos"></div>
                  <div class="link"><span>Lista de Produtos</span></div>
                </a>
              </div>
              <div class="box" id="add">
                <a href="<?php echo FULL_PATH_PANEL; ?>product/create">
                  <div class="img-box"><img src="<?php echo PATH_ICONS_SITE ?>outlined_add.png" alt="adicionar novo"></div>
                  <div class="link"><span>Adicionar novo</span></div>
                </a>
              </div>
            </div>
          </section>

          <section class="topic" id="categories">
            <h2>Categorias</h2>
            <div class="content">
              <div class="box list">
                <a href="<?php echo FULL_PATH_ESTOQUE; ?>categories">
                  <div class="amount"><span>(<?php echo $categories ? $categories : '0'; ?>)</span></div>
                  <div class="bag"><img src="<?php echo PATH_ICONS_SITE.'iconshop.png' ?>" alt="lista de categorias"></div>
                  <div class="link"><span>Lista de Categorias</span></div>
                </a>
              </div>
              <div class="box" id="add">
                <a href="<?php echo FULL_PATH_PANEL; ?>category/create">
                  <div class="img-box"><img src="<?php echo PATH_ICONS_SITE ?>outlined_add.png" alt="adicionar nova"></div>
                  <div class="link"><span>Adicionar nova</span></div>
                </a>
              </div>
            </div>
          </section>

          <section class="topic" id="marks">
            <h2>Marcas</h2>
            <div class="content">
              <div class="box list">
                <a href="<?php echo FULL_PATH_ESTOQUE; ?>marks">
                  <div class="amount"><span>(<?php echo $marks ? $marks : '0'; ?>)</span></div>
                  <div class="bag"><img src="<?php echo PATH_ICONS_SITE.'iconshop.png' ?>" alt="lista de marcas"></div>
                  <div class="link"><span>Lista de Marcas</span></div>
                </a>
              </div>
              <div class="box" id="add">
                <a href="<?php echo FULL_PATH_PANEL; ?>marca/create">
                  <div class="img-box"><img src="<?php echo PATH_ICONS_SITE ?>outlined_add.png" alt="adicionar novo"></div>
                  <div class="link"><span>Adicionar nova</span></div>
                </a>
              </div>
            </div>
          </section>

          <section class="topic" id="discounts">
            <h2>Descontos</h2>
            <div class="content">
              <div class="box list">
                <a href="<?php echo FULL_PATH_ESTOQUE; ?>discounts">
                  <div class="amount"><span>(<?php echo $discounts ? $discounts : '0'; ?>)</span></div>
                  <div class="bag"><img src="<?php echo PATH_ICONS_SITE.'iconshop.png' ?>" alt="lista de descontos"></div>
                  <div class="link"><span>Lista de Descontos</span></div>
                </a>
              </div>
              <div class="box" id="add">
                <a href="<?php echo FULL_PATH_PANEL; ?>discount/create">
                  <div class="img-box"><img src="<?php echo PATH_ICONS_SITE ?>outlined_add.png" alt="adicionar novo"></div>
                  <div class="link"><span>Adicionar novo</span></div>
                </a>
              </div>
            </div>
          </section>

        </div>

      </section>
    </div>
  </main>

  <?php include(PATH_VIEWS.'footer.php'); ?>

  <script src="<?php echo PATH_SCRIPTS; ?>header.js"></script>
  <script src="<?php echo PATH_SCRIPTS_SITE; ?>notification.js"></script>
  <script src="<?php echo PATH_SCRIPTS; ?>main-menu.js"></script>

</body>
</html>