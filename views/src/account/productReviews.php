<?php

    $id = Login::getId();

    $products = ProductModel::selectProduct('*', "WHERE id IN (SELECT product_id FROM product_reviews WHERE user_id = $id)");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apolo Store</title>

    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>product-reviews.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">

</head>
<body>
    
    <?php include(PATH_VIEWS.'header.php'); ?>

    
    <main>
        <div class="container">

            <div class="table">
                <div class="head">
                    <h3>Produto</h3>
                    <h3>Nota</h3>
                </div>
            
                <div class="body">

                    <?php foreach($products as $product){ 
            
                        $reviews = ReviewModel::getProductReview($product['id']);
                    ?>
                    <div class="line">
                        
                        <div class="product">
                            <a href="<?php echo FULL_PATH_SITE.'product?productId='.$product['id']; ?>">
                                <?php echo $product['name']; ?>
                            </a>
                        </div>

                        <div class="rate">
                            <span>
                                <?php echo $reviews['rank']; ?>
                            </span>
                        </div>

                    </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>

</body>
</html>