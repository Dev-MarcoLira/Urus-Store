<?php

  require_once(PATH_VIEWS.'notification.php');

  if(isset($_SESSION['checkMail_error'])){

    $errorMsg = $_SESSION['checkMail_error'];
    setFlag('active', 'Erro', $errorMsg);
    $_SESSION['checkMail_error'] = null;
  }

  if(isset($_SESSION['product_error'])){

    $errorMsg = $_SESSION['product_error'];
    setFlag('active', 'Erro', $errorMsg);
    $_SESSION['product_error'] = null;
  }

  if(isset($_SESSION['product_success'])){

    $errorMsg = $_SESSION['product_success'];
    setFlag('active', 'Sucesso', $errorMsg);

    $_SESSION['product_success'] = null;
  }

  if(isset($_SESSION['settings_error'])){

    $errorMsg = $_SESSION['settings_error'];
    setFlag('active', 'Erro', $errorMsg);
    $_SESSION['settings_error'] = null;
  }

  $products = ProductModel::selectProduct('*', "WHERE is_init_page = 1 AND is_active = 1 LIMIT 10");
  $recent = ProductModel::selectProduct('*', "WHERE is_init_page = 1 AND is_active = 1 ORDER BY created_at DESC LIMIT 10");

?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>main.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>notification.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apolo Store</title>
</head>

<body>

  <?php include(PATH_VIEWS.'header.php'); ?>

  <main>

    <div class="banner">
      <div id="images">
        <img class="active w3-animate-right" src="<?php echo PATH_IMAGES; ?>banner1.png">
        <img class="w3-animate-right" src="<?php echo PATH_IMAGES; ?>banner2.png">
        <img class="w3-animate-right" src="<?php echo PATH_IMAGES; ?>banner3.png">
      </div>
    </div>


    <section class="catalog" id="catalog1">
      <div class="content">
        <div class="title-wrapper">
          <h3>RECOMENDADOS PARA VOCÊ</h3>
        </div>

        <div class="products">
          <div class="left-arrow"></div>
          <div class="card-wrapper">

            <?php foreach($products as $product){ 
              $id = $product['id'];
              $path = PATH_UPLOADS."products/$id";
              $logo = '';

              foreach(scandir($path) as $item){
                if(preg_match("/image1/", $item))
                  $logo = $item;
              }

            	$discountedPrice = productModel::getPromotionPrice($id, $product['price']);
            ?>
            
            <div class="card-item">

              <form action="<?php echo FULL_PATH_SITE; ?>cart/add" method="post">
                <div class="img-container">
                  <a href="product?productId=<?php echo $product['id']; ?>" ><img src="<?php echo "$path/$logo";?>" alt="product" /></a>
                </div>
                <div class="card-content">
                  <p class="name">
                    <?php echo $product['name']; ?>
                  </p>

                  <?php if($discountedPrice != $product['price']){ ?>

                  <h3 class="no-discount">R$<?php echo $product['price'];?></h3>
                  <h3 class="discount">R$<?php echo $discountedPrice?></h3>

                  <?php }else{ ?>

                    <h3>R$<?php echo $product['price'];?></h3>

                  <?php } ?>

                  <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                  <input type="hidden" name="cartAmount" value="1">
                  <input type="hidden" name="productPrice" value="<?php echo $product['price']; ?>">
                  <input type="submit" name="addProduct" value="Comprar">
                </div>
              </form>
            </div>
            <?php } ?>
          </div>
          <div class="right-arrow"></div>
        </div>
        </div>

          
        </div>
      </div>
    </section>
    <section class="catalog" id="catalog2">
      <div class="content">
        <div class="title-wrapper">
          <h3>VISTOS RECENTEMENTE</h3>
        </div>

        <div class="products">
          <div class="left-arrow"></div>

          <div class="card-wrapper">

          <?php foreach($recent as $product){ 
              $id = $product['id'];
              $path = PATH_UPLOADS."products/$id";
              $logo = scandir($path)[2];
            	$discountedPrice = productModel::getPromotionPrice($id, $product['price']);

            ?>
            
            <div class="card-item">

              <form action="<?php echo FULL_PATH_SITE; ?>cart/add" method="post">
                <div class="img-container">
                  <a href="product?productId=<?php echo $product['id']; ?>" ><img src="<?php echo "$path/$logo";?>" alt="product" /></a>
                </div>
                <div class="card-content">
                  <p class="name">
                    <?php echo $product['name']; ?>
                  </p>

                  <?php if($discountedPrice != $product['price']){ ?>

                  <h3 class="no-discount">R$<?php echo $product['price'];?></h3>
                  <h3 class="discount">R$<?php echo $discountedPrice?></h3>

                  <?php }else{ ?>

                    <h3>R$<?php echo $product['price'];?></h3>

                  <?php } ?>

                  <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                  <input type="hidden" name="cartAmount" value="1">
                  <input type="hidden" name="productPrice" value="<?php echo $product['price']; ?>">
                  <input type="submit" name="addProduct" value="Comprar">
                </div>
              </form>
            </div>
            <?php } ?>

          </div>

          <div class="right-arrow"></div>
        </div>
      </div>
    </section>

    <section id="categories">
      
      <div class="container">
        
        <div class="title-wrapper">
          <h3>CATEGORIAS</h3>
        </div>

        <div id="content">
          
          <div>
            
            <a href="<?php echo PATH_DEPARTAMENTOS; ?>processadores">
              <p>Processadores</p>

              <div class="img-box">
                
                <img src="<?php echo PATH_IMAGES; ?>processadores.png">

              </div>

            </a>

          </div>

          <div>
            
            <a href="<?php echo PATH_DEPARTAMENTOS; ?>placasDeVideo">
              <p>Placas de vídeo</p>

              <div class="img-box">
                
                <img src="<?php echo PATH_IMAGES; ?>placas-de-video.png">

              </div>

            </a>

          </div>

          <div>
            
            <a href="<?php echo PATH_DEPARTAMENTOS; ?>monitores">
              <p>Monitores</p>

              <div class="img-box">
                
                <img src="<?php echo PATH_IMAGES; ?>monitores.png">

              </div>

            </a>

          </div>

          <div>

            <a href="<?php echo PATH_DEPARTAMENTOS; ?>mouses">            
              <p>Mouses</p>

              <div class="img-box">
                
                <img src="<?php echo PATH_IMAGES; ?>mouses.png">

              </div>

            </a>

          </div>

          <div>
            
            <a href="<?php echo PATH_DEPARTAMENTOS; ?>teclados">
              <p>Teclados</p>

              <div class="img-box">
                
                <img src="<?php echo PATH_IMAGES; ?>teclados.png">

              </div>

            </a>

          </div>

          <div>
            
            <a href="<?php echo PATH_DEPARTAMENTOS; ?>tabletsIpads">
              <p>Tablets e IPads</p>

              <div class="img-box">
                
                <img src="<?php echo PATH_IMAGES; ?>tablets-ipads.png">

              </div>

            </a>
          </div>

          <div>

            <a href="<?php echo PATH_DEPARTAMENTOS; ?>coolers">
              
              <p>Coolers</p>

              <div class="img-box">
                
                <img src="<?php echo PATH_IMAGES; ?>coolers.png">

              </div>

            </a>            
            

          </div>

        </div>

      </div>


    </section>


  </main>

  <?php include(PATH_VIEWS.'footer.php'); ?>

  <script src="<?php echo PATH_SCRIPTS; ?>main.js"></script>
  <script src="<?php echo PATH_SCRIPTS; ?>account-menu.js"></script>
  <script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>globals.js"></script>
  <script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>notification.js"></script>
</body>

</html>