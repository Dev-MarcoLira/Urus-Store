<?php

    require_once(PATH_VIEWS_GLOBAL.'notification.php');
    require_once(PATH_VIEWS_GLOBAL.'modal-confirm.php');

    if(isset($_SESSION['product_success'])){
        setFlag('active', 'Sucesso', $_SESSION['product_success']);
        $_SESSION['product_success'] = null;
    }

    $trending = ProductModel::selectProduct('*', "WHERE is_highlighted = 1");
    $products = ProductModel::selectProduct('*', '');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urus Store</title>

    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>products.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>notification.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>password_modal.css">

</head>
<body>
    
    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>

        <div class="container">

            <section id="trending">

                <?php if($trending->rowCount() > 0){ ?>

                <h1 class="bigger">E</h1><h1>m Destaque (<?php echo $trending->rowCount(); ?>)</h1>

                <div class="slider">
                    <div class="left-arrow">
                        <img src="<?php echo PATH_ICONS_SITE; ?>left-arrow.png" alt="Scroll para a esquerda">
                    </div>
                    <div class="products">
                    
                        <?php
                    
                            foreach($trending as $product){
                                $isActive = $product['is_active'];
                                    $id = $product['id'];
                                    $path = "uploads/products/$id";
                                    $logo = '';
                    
                                    $price = ProductModel::getPromotionPrice($id, $product['price']);
                                    if(is_dir($path)){
                                        foreach(scandir($path) as $item){
                                            if(preg_match("/image1/", $item))
                                            $logo = $item;
                                        }
                                    }else{
                                        $logo = null;
                                    }
                        ?>
                            <div class="box">
                                <div class="img-box">
                                    <?php if(isset($logo)){ ?>
                                    <a href="<?php echo FULL_PATH_PANEL."product?id=$id"; ?>">
                                        <img src="<?php echo "../$path/$logo"; ?>" alt="logo do produto">
                                    </a>
                                    <?php }else{ ?>
                                    <?php } ?>
                                </div>
                                <div class="content">
                                    <span><?php echo $product['name']; ?></span>
                    
                                    <div class="wrapper">
                                        <div class="prices">
                                            <?php if($price != $product['price']){ ?>
                                                <span class="discount">
                                                    R$<?php echo $product['price']; ?>
                                                </span>
                                            <?php } ?>
                                            <span class="price">
                                                R$<?php echo $price; ?>
                                            </span>
                                        </div>
                                        <div class="info">
                                        
                                            <div id="views">
                                                <img src="<?php echo PATH_ICONS_SITE; ?>views.png" alt="quantidade de visualizações">
                                                <span>
                                                    <?php echo ReviewModel::selectReview("id", "WHERE id = $id")->rowCount(); ?>
                                                </span>
                                            </div>
                                            <div id="cart">
                                                <img src="<?php echo PATH_ICONS_SITE; ?>cart-amount.png" alt="quantidade no carrinho">
                                                <span>
                                                    <?php echo CartModel::selectCartItem("id", "WHERE product_id = $id")->rowCount(); ?>
                                                </span>
                                            </div>
                                            <?php
                                        
                                                if(DiscountModel::selectDiscountProduct('id', "WHERE product_id = $id")->rowCount() > 0){
                                                    $expiryDate = '';
                                                    foreach(DiscountModel::selectDiscountProduct('expiry_date', "WHERE product_id = $id") as $date){
                                                        $expiryDate = $date[0];
                                                    }
                                            ?>
                                            <div id="time">
                                                <img src="<?php echo PATH_ICONS_SITE; ?>time.png" alt="tempo">
                                                <span>
                                                    <?php echo $expiryDate; ?>
                                                </span>
                                            </div>
                                            <?php } ?>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="right-arrow">
                        <img src="<?php echo PATH_ICONS_SITE; ?>right-arrow.png" alt="Scroll para a direita">
                    </div>    
                </div>
                
                <?php } ?>

            </section>
                    
            <section id="everything">

                <h1 class="bigger">T</h1><h1>odos (<?php echo $products->rowCount() ?>)</h1>

                <div class="products">

                    <?php 
                    
                        foreach($products as $product){
                            $isActive = $product['is_active'];
                            $id = $product['id'];
                            $path = "uploads/products/$id";
                            $logo = null;
                            $reviewSum = null;
                            
                            $reviewAmount = ReviewModel::selectReview('id', "WHERE product_id = $id")->rowCount();

                            foreach(ReviewModel::selectReview("SUM(rank)", "WHERE product_id = $id") as $rows)
                                $reviewSum = $rows[0];

                            $price = ProductModel::getPromotionPrice($id, $product['price']);

                            if(is_dir($path)){
                                foreach(scandir($path) as $item){
                                    if(preg_match("/image1/", $item))
                                    $logo = $item;
                                }
                            }else{
                                $logo = null;
                            }
                    ?>

                        <div class="box">

                            <div class="img-box">
                                <?php if(isset($logo)){ ?>

                                <a href="<?php echo FULL_PATH_PANEL."product?id=$id"; ?>">
                                    <img src="<?php echo "../$path/$logo"; ?>" alt="logo do produto">
                                </a>

                                <?php }else{ ?>

                                <?php } ?>
                            </div>                        

                            <div class="content">

                                <span><?php echo $product['name']; ?></span>
                                
                                <div class="prices">
                                    <span class="price">
                                        R$<?php echo $price; ?>
                                    </span>
                                    <?php if($price != $product['price']){ ?>
                                        <span class="discount">
                                            R$<?php echo $product['price']; ?>
                                        </span>
                                    <?php } ?>
                                </div>

                                <div class="stars">
                                    
                                    <?php 

                                        $averageReviews = null;

                                        if($reviewAmount){
                                            $averageReviews = ceil($reviewSum / $reviewAmount);
                                        }else{
                                            $averageReviews = 0;
                                        }    

                                        for($i = 1; $i <= 5; $i++){ 
                                            if($i <= $averageReviews){        
                                    ?>

                                        <img src="<?php echo PATH_ICONS_SITE; ?>star-shine.png" alt="Estrela avaliada">

                                    <?php }else{ ?>

                                        <img src="<?php echo PATH_ICONS_SITE; ?>star-review.png" alt="Estrela de avaliação">

                                    <?php 
                                        }
                                    } 
                                    
                                    ?>

                                </div>

                            </div>

                        </div>

                    <?php } ?>

                </div>

            </section>
        </div>

    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script src="<?php echo PATH_SCRIPTS_SITE; ?>notification.js"></script>
    <script src="<?php echo PATH_SCRIPTS_SITE; ?>modal-confirm.js"></script>
    <script src="<?php echo PATH_SCRIPTS_SITE; ?>jquery.js"></script>
    <script src="<?php echo PATH_SCRIPTS; ?>products.js"></script>
    <script src="<?php echo PATH_SCRIPTS; ?>header.js"></script>

</body>
</html>