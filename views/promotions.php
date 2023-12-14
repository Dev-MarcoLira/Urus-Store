<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apolo Store</title>

    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>promotions.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">

</head>
<body>
    
    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>

		<div class="container">
				
            <section id="products">

                <?php 
                
                    if($products->rowCount() > 0){
                        
                        foreach($products as $product){ 

                            $discountedPrice = productModel::getPromotionPrice($product['id'], $product['price']);

                            $id = $product['id'];
                            $path = PATH_UPLOADS."products/$id";
                            $logo = '';

                            foreach(scandir($path) as $item){
                                if(preg_match("/image1/", $item))
                                  $logo = $item;
                            }
                ?>

                <div class="product-wrapper">

                    <form action="<?php echo FULL_PATH_SITE; ?>cart/add" method="post">

                        <div class="img-box">
                            <a href="<?php echo FULL_PATH_SITE; ?>product?productId=<?php echo $id; ?>">
                                <img src="<?php echo "$path/$logo";?>" alt="imagem do produto">
                            </a>
                        </div>
                        <div class="info">
                            <p><?php echo $product['name']; ?></p>
                            <h3 class="price">R$<?php echo $product['price']; ?></h3>
                            <h3 class="discounted">R$<?php echo $discountedPrice; ?></h3>
                            <input type="hidden" name="productId" value="<?php echo $id; ?>">
                            <input type="hidden" name="cartAmount" value="1">
                            <input type="hidden" name="productPrice" value="<?php echo $product['price']; ?>">
                        </div>

                        <input type="submit" name="addProduct" value="Comprar">
                    </form>

                </div>

                <?php 
                
                        }
                    }else{ 
                
                ?>

                <div id="no-product">
                    <a href="<?php echo FULL_PATH_CATALOGO; ?>">Parece que a seção está vazia! <span>Confira o nosso catálogo!</span></a>
                </div>

                <?php } ?>

            </section>
			
            <div id="pages">
                <?php 

                    if($totalPages){
                        for($i = 1; $i <= $totalPages; $i++){

                            if(isset($_GET['search'])){

                                $search = $_GET['search'];

                                echo "<h3><a href='?page=$i&search=$search'>$i</a></h3>";


                            }else{
                                echo "<h3><a href='?page=$i'>$i</a></h3>";
                            }
                        }
                    }

                ?>
            </div>

		</div>

	</main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>

</body>
</html>