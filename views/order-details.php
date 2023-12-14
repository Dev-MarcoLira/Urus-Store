<?php

    $id = $_GET['paymentId'];
    
    $products = PaymentModel::selectOrderItems('product_id, total, quantity', "WHERE payment_id = $id");
    
    $amount = '';
    $userId = '';
    $date = '';

    foreach(PaymentModel::selectPayments('user_id, amount, created_at', "WHERE id = $id") as $payments){
        $userId = $payments['user_id'];
        $amount = $payments['amount'];
        $date = $payments['created_at'];
    }
    

    $user = '';
    foreach(UserModel::selectUser('name', "WHERE id = $userId") as $users)
        $user = $users;

    $address = '';
    $number = '';
    $city = '';
    $state = '';
    $phone = '';

    foreach(MySQL::freeSelect("SELECT a.* FROM addresses AS a INNER JOIN users_addresses AS b ON a.id = b.address_id WHERE b.user_id = $userId") as $addresses){
        $address = $addresses['endereco'];
        $number = $addresses['numero'];
        $city = $addresses['cidade'];
        $state = $addresses['estado'];
        $phone = $addresses['phone'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apolo Store</title>

    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>order-details.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">

</head>
<body>
    
    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>
        <div class="container">

            <section class="header">

                <h2>Detalhes do pedido</h2>

                <div class="txt-box">
                    
                    <span id="date">Data de entrega estimada</span>

                    <span>
                        Chegada entre <span id="initial-date"><?php echo $date; ?></span> e <span id="final-date"></span>
                    </span>

                </div>

            </section>

            <section class="main">

                <?php     
                    foreach($products as $product){ 
                    
                        $productId = $product['product_id'];
                        $path = PATH_UPLOADS."products/$productId";
                        $logo = scandir($path)[2];

                        $name = '';
                        foreach(ProductModel::selectProduct('name', "WHERE id = $productId") as $names)
                            $name = $names[0];
                ?>

                <div class="product-single">

                    <div class="left">
                        <div class="img-box">
                            <img src="<?php echo FULL_PATH_SITE."$path/$logo"; ?>" alt="Logo do produto">
                        </div>
                        <span class="name">
                            <?php echo $name; ?>
                        </span>
                    </div>
                    
                    <div class="right">
                        <span class="price">
                            R$<?php echo $product['total']; ?>
                        </span>
                        <span class="quantity">
                            <?php echo $product['quantity']; ?>X
                        </span>
                    </div>

                </div>

                <?php } ?>

                <div id="address">

                    <div id="user">
                        
                        <div class="user">
                            <div class="img-box">
                                <img src="<?php echo PATH_ICONS; ?>user-order.png" alt="Usuário">
                            </div>
                            <span><?php echo $user['name']; ?></span>
                        </div>

                        <div id="phone">
                            <span>
                                <?php echo $phone; ?>
                            </span>
                        </div>
                        
                    </div>

                    <div id="full-address">
                        <div class="img-box">
                            <img src="<?php echo PATH_ICONS; ?>location.png" alt="Localização">
                        </div>

                        <div>
                            <span><?php echo "$address $number"; ?></span>
                            <span><?php echo "$city, $state"; ?> Brasil</span>
                        </div>
                    </div>

                </div>

            </section>

            <section id="last-dance">

                <div class="title-wrapper">
                    <h3>Informações do pedido</h3>
                </div>
                <div class="sedex">
                    <div>
                        <span class="bold">Número o pedido</span>
                        <span>#<?php echo $id; ?></span>
                    </div>

                    <div>
                        <span class="bold">Horário do pedido</span>
                        <span><?php echo $date; ?></span>
                    </div>

                    <div>
                        <span class="bold">Método de envio</span>
                        <span>SEDEX</span>
                    </div>
                </div>

                <div class="sedex" id="total">
                    <span>total pago:</span><span class="price">R$<?php echo $amount; ?> </span>
                </div>

                <div class="sedex" id="button">
                    <button><span class="bigger">R</span>ecebido</button>
                </div>
                

            </section>

        </div>
    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>order-details.js"></script>

</body>
</html>