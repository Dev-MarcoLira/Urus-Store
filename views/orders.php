<?php

    $userId = Login::getId();
    $payments = PaymentModel::selectPaymentByUser("*", "WHERE user_id = $userId");

    $sqlPending = "SELECT a.* FROM order_items AS a INNER JOIN payment_details AS b ON a.payment_id = b.id WHERE b.status = 'pending' AND b.user_id = $userId";
    $sqlReviews = "SELECT a.*, c.rank FROM order_items AS a INNER JOIN payment_details AS b ON a.payment_id = b.id "
        . "INNER JOIN product_reviews AS c ON c.product_id = a.product_id WHERE b.status = 'pending' AND b.user_id = $userId";

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apolo Store</title>

    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>orders.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
</head>
<body>
    
    <?php include(PATH_VIEWS).'header.php'; ?>

    <main>


        <div class="container">
        
            <?php if($payments->rowCount() > 0){ ?>


                <div class="title-wrapper" id="main">
                    <h2> <span class="bigger">M</span>eus pedidos</h2>
                </div>

                <section id="non-payed">

                    <div class="title-wrapper">
                        <h3> <span class="bigger">N</span>ão <span class="bigger">P</span>agos</h3>
                    </div>

                    <?php 
                    
                    
                        foreach(Mysql::freeSelect($sqlPending) as $product){ 
                            
                            $id = $product['product_id'];
                            $order = '';
                            $paymentId = $product['payment_id'];

                            foreach(ProductModel::selectProduct('name', "WHERE id = $id") as $prdc)
                                $order = $prdc;
                            
                            
                            $path = PATH_UPLOADS."products/$id";
                            $image = scandir($path)[2];
                    ?>


                    <div class="product-single">

                        <div class="content">
                            <div class="logo">
                                <img src="<?php echo "$path/$image"; ?>" alt="logo do produto">
                            </div>
                            <div class="txt-box">
                            
                                <span><?php echo $order['name']; ?></span>
                            </div>
                        </div>

                        <div class="actions">
                            
                            <div class="status">
                                <span class="text">status</span>
                                <span class="info">Aguardando Pagamento</span>
                            </div>
                            <div class="button">
                                <button><a href="<?php echo FULL_PATH_SITE."order/details?paymentId=$paymentId"; ?>">Ver mais</a></button>
                            </div>
                        </div>

                    </div>

                    <?php } ?>

                </section>

                <section id="processing">

                    <div class="title-wrapper">
                        <h3> <span class="bigger">E</span>m <span class="bigger">A</span>ndamento</h3>
                    </div>

                </section>

                <section id="ended">

                    <div class="title-wrapper">
                        <h3> <span class="bigger">F</span>inalizados</h3>
                    </div>

                </section>
       
                <section id="rated">

                    <div class="title-wrapper">
                        <h3><span class="bigger">A</span>valiados</h3>
                    </div>

                    <?php 
                    
                        foreach(Mysql::freeSelect($sqlReviews) as $product){ 
                            
                            $id = $product['product_id'];
                            $order = '';
                            $paymentId = $product['payment_id'];
                            $rank = $product['rank'];

                            foreach(ProductModel::selectProduct('name', "WHERE id = $id") as $prdc)
                                $order = $prdc;
                            
                            
                            $path = PATH_UPLOADS."products/$id";
                            $image = scandir($path)[2];
                    ?>


                    <div class="product-single">

                        <div class="content">
                            <div>
                                <div class="logo">
                                    <img src="<?php echo "$path/$image"; ?>" alt="logo do produto">
                                </div>
                                <div class="txt-box">
                                
                                    <span><?php echo $order['name']; ?></span>
                                </div>
                            </div>

                            <div class="rating">

                                <div class="img-box">

                                    <?php 
                                    
                                        for($i = 1; $i <= 5; $i++){
                                    
                                            if($i <= $rank){
                                    ?>

                                        <img src="<?php echo PATH_ICONS; ?>star-shine.png" alt="estrela avaliada">

                                    <?php }else{ ?>

                                        <img src="<?php echo PATH_ICONS; ?>star-review.png" alt="nota a ser avaliada">

                                    <?php 
                                            }
                                        } 
                                    ?>

                                </div>

                                <a href="<?php echo FULL_PATH_SITE."product?productId=$id"; ?>">Ver minha avaliação</a>

                            </div>

                        </div>

                        <div class="actions">
                            
                            <div class="status">
                                <span class="text">status</span>
                                <span class="info">Aguardando Pagamento</span>
                            </div>
                            <div class="button">
                                <button><a href="<?php echo FULL_PATH_SITE."order/details?paymentId=$paymentId"; ?>">Ver mais</a></button>
                            </div>
                        </div>

                    </div>

                    <?php } ?>

                </section>
                       
            <?php }else {?>
                <div id="visit-catalog">
                    <h3 id="no-orders">Parece que você ainda não comprou nada!</h3>
                    <div id="shop">
                        <span><a href="<?php echo FULL_PATH_SITE; ?>catalogo">Visitar <span id="catalog">catálogo</span></a></span>
                        <div class="img-box">
                            <img src="<?php echo PATH_ICONS ?>iconshop.png" alt="ícone do catálogo">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>

</body>
</html>