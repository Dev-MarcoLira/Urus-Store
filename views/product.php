<?php

    if(isset($_SESSION['login'])){
        require_once(PATH_VIEWS.'notification.php');

        if(isset($_SESSION['review_success'])){
            setFlag('active', 'Sucesso', $_SESSION['review_success']);
            $_SESSION['review_success'] = null;
        }

        if(isset($_SESSION['review_error'])){
            setFlag('active', 'Erro', $_SESSION['review_error']);
            $_SESSION['review_error'] = null;
        }

        
        $userId = Login::getId();

        $hasBought = MySQL::freeSelect("SELECT a.id, a.product_id, a.total FROM order_items AS a 
        INNER JOIN payment_details AS b
        ON (a.payment_id = b.id AND a.product_id = $id AND b.user_id = $userId)")->rowCount();
    }
    $id = $product['id'];
    $discountedPrice = productModel::getPromotionPrice($id, $product['price']);
    $path = PATH_UPLOADS."products/$id";
    $dir = array_slice(scandir($path), 2);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apolo Store</title>

    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>product.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>notification.css">
</head>
<body>

    <?php include(PATH_VIEWS.'header.php'); ?>

    <div class="tudo">
        <div class="nome">
            <h2><?php echo $product['name']; ?></h2>
        </div> 
        <div class="product-box">
            <div class="produto">
                <div class="img">
                    <span class="left"></span>
                    <?php foreach($dir as $image){ ?>

                        <img class="fade" src="<?php echo "$path/$image"; ?>" alt="imagem do produto">

                    <?php } ?>

                    <span class="right"></span>
                </div>
                <div class="stuff">
                    <div id="review">
                        <div>

                            <?php 
                            
                            if(isset($_SESSION['login']))    {
                                    if($hasBought > 0){

                                        for($rate = 1; $rate <= 5; $rate++){ 
                                        
                                            $rank = 0;
                                            $reviewId = null;
                                            foreach(ReviewModel::selectReview('id, rank', "WHERE product_id = $id AND user_id = $userId") as $rk){
                                                $rank = $rk['rank'];
                                                $reviewId = $rk['id'];
                                            }
                                            
                                            if($rank > $rate){
                            ?>

                                <a href="<?php echo FULL_PATH_SITE."review/rate?productId=$id&rate=$rate"; ?>"><img class="rank" src="<?php echo PATH_ICONS; ?>star-shine.png" alt="nota <?php echo $rate; ?>"></a>

                            <?php }else if($rank == $rate){ ?>

                                <a href="<?php echo FULL_PATH_SITE."review/disable?id=$reviewId&productId=$id"; ?>"><img class="rank" src="<?php echo PATH_ICONS; ?>star-shine.png" alt="nota <?php echo $rate; ?>"></a>

                            <?php
                                }else{
                            ?>

                                <a href="<?php echo FULL_PATH_SITE."review/rate?productId=$id&rate=$rate"; ?>"><img src="<?php echo PATH_ICONS; ?>star-review.png" alt="nota <?php echo $rate; ?>"></a>

                            <?php
                                        }
                                    
                                    }
                                }else{
                                    for($i = 1; $i <= 5; $i++){
                            ?>

                                <a><img src ="<?php echo PATH_ICONS; ?>star-review.png" alt="nota <?php echo $i; ?>"></a>

                            <?php
                                        }
                                    }
                                }else{
                                    for($i = 1; $i <= 5; $i++){
                                
                            ?>
                                <a><img src ="<?php echo PATH_ICONS; ?>star-review.png" alt="nota <?php echo $i; ?>"></a>
                            <?php
                                    }
                                }
                            ?>
                        </div>

                        <?php 
                        
                            $quantity = ReviewModel::selectReview('id', "WHERE product_id = $id")->rowCount();

                            if($quantity == 1){ 
                            
                        ?>

                            <aside class="avaliacao"><h6><?php echo $quantity; ?> Usuário avaliou!</h6></aside>

                        <?php }else if($quantity > 1){ ?>

                            <aside class="avaliacao"><h6><?php echo $quantity; ?> Usuários avaliaram!</h6></aside>


                        <?php }else{ ?>

                            <aside class="avaliacao"><h6> Sem avaliações! </h6></aside>

                        <?php } ?>
                    </div>
                    <aside class="b"><h6>&nbsp</h6></aside>
                    <aside class="marca"><h6><?php echo $mark['name']; ?></h6></aside>
                    <aside class="b"><h6>&nbsp</h6></aside>
                    <img id="share" src="<?php echo PATH_ICONS; ?>share.png" alt="Compartilhar produto">
                </div>
            </div>
            <div class="detalhes">

                <?php if($discountedPrice != $product['price']){ ?>

                <h1>R$<?php echo $discountedPrice; ?></h1>
                <h3>R$<?php echo $product['price']; ?></h3>
                

                <?php }else{ ?>

                    <h1>R$<?php echo $product['price']; ?></h1>

                <?php } ?>

                <h4>R$<?php echo $discountedPrice; ?> em até 10X de R$<?php echo $discountedPrice/10; ?> sem juros no cartão ou em 1X no cartão com até 5% off</h4>
                <h5>ver mais opções de cartão</h5>
                <b></b>   

                <form action="<?php echo FULL_PATH_CART.'/add' ?>" method="post">
            
                    <input type="hidden" name="cartAmount" value="<?php echo $product['amount']; ?>">
                    <input type="hidden" name="productPrice" value="<?php echo $discountedPrice; ?>">
                    <input type="hidden" name="productId" value="<?php echo $id; ?>">
                    
                    <input type="submit" name="addProduct" value ="COMPRAR">

                </form>
                
            </div>
        </div> 
            <aside class="barra"></aside>
            <div class="desc">
                <h1>Descrição do Produto</h1>
                <a>
                    <?php echo $product['description']; ?>
                </a>
            </div>
        </div>

        <?php include(PATH_VIEWS.'footer.php'); ?>

        <script src="<?php echo PATH_SCRIPTS; ?>product.js"></script>
        <script src="<?php echo PATH_SCRIPTS; ?>account-menu.js"></script>
        <script src="<?php echo PATH_SCRIPTS; ?>notification.js"></script>

    </body>
</html>