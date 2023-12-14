<?php

    require_once(PATH_VIEWS_GLOBAL.'notification.php');

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

    if(isset($_SESSION['image_error'])){
        $errorMsg = $_SESSION['image_error'];
        setFlag('active', 'Erro', $errorMsg);
        $_SESSION['image_error'] = null;
    }

    if(isset($_SESSION['image_success'])){
        setFlag('active', 'Sucesso', $_SESSION['image_success']);
        $_SESSION['image_success'] = null;
    }

    $product = '';
    $counter = 0;

    foreach(ProductModel::selectProduct('*', "WHERE id = ".$_GET['id']) as $prd){
        $product = $prd;
        $category_id = $product['category_id'];
        $mark_id = $product['mark_id'];
    }

    $id = $product['id'];

    $categories = CategoryModel::selectCategory('*', "WHERE id <> $category_id AND is_active = 1");
    $marks = MarkModel::selectMark('*', "WHERE id <> $mark_id AND is_active = 1");
    $categoryChosen = CategoryModel::selectCategory('*', "WHERE id = $category_id");
    $markChosen = MarkModel::selectMark('*', "WHERE id = $mark_id");

    foreach($categoryChosen as $cat)
        $categoryChosen = $cat;

    foreach($markChosen as $mark)
        $markChosen = $mark;

    $discountsChosen = DiscountModel::selectDiscountProduct("*", "WHERE product_id = $id");
    $discounts = '';

    if($discountsChosen->rowCount() > 0){

        foreach($discountsChosen as $discount)
            $discountsChosen = $discount;
        

        foreach(DiscountModel::selectDiscount('*', "WHERE id = ".$discountsChosen['discount_id']) as $dsct){
            $discountsChosen = DiscountModel::selectDiscount('*', '');
            $discounts = DiscountModel::selectDiscount('*', "WHERE id <> ".$discount['discount_id']);
        }
    }else{
        $discountsChosen = null;
        $discounts = DiscountModel::selectDiscount('*', "");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urus Store</title>

    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>createProduct.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>notification.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>main-menu.css">

</head>
<body>
    
    <?php include PATH_VIEWS.'header.php'; ?>

    <main>

        <div class="container">
            
            <h1>Editar Produto</h1>

            <form action="<?php echo FULL_PATH_PANEL; ?>product/edit" autocomplete="off" enctype="multipart/form-data" method="post" name="formCreatePorduct">

                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                    <div class="box">

                        <div class="title"><h2>Nome e Descrição</h2></div>

                        <label for="name">Nome</label>
                        <input type="text" name="name" value="<?php echo $product['name']; ?>">
                        <label for="desc">Descrição</label>
                        <textarea name="desc" cols="30" rows="10"><?php echo $product['description']; ?></textarea>
                    </div>

                    
                    <div class="box">

                        <div class="title"><h2>Fotos</h2></div>

                        <div class="imgs">

                            <?php 
                                            
                                for($counter = 1; $counter < 5; $counter++){
                                    $where = "WHERE order_number = $counter AND product_id = $id";
                                    if(ImageModel::selectImage("id, name, order_number", $where)->rowCount () > 0){
                                        $images = ImageModel::selectImage("id, name, order_number", $where);
                                        foreach($images as $image){   
                                            $imgId = $image['id'];
                                            $imgName = $image['name'];
                                            $path = PATH_UPLOAD."products/$id";
                                            $fileName = '';
                                            foreach(scandir($path) as $item){
                                                if(preg_match("/image$counter/", $item))
                                                    $fileName = $item;
                                            }
                                            $imgOrder = $image['order_number'];
                            ?>

                            <div class="img">
                                <label class="botao-attach-file">
                                    <img src="<?php echo "$path/$fileName"; ?>" alt="imagem do produto">
                                    <span><a href="<?php echo FULL_PATH_PANEL."image/delete?imgId=$imgId&productId=$id&imgOrder=$imgOrder&imgName=$imgName"; ?>">X</a></span>
                                </label>
                            </div>

                            <?php }}else{ ?>

                                <div class="img">
                                    <label class="botao-attach-file">
                                        <input type="file" <?php if($counter == 1) echo 'required'; ?> name="<?php echo "image$counter"; ?>"> <img src="<?php echo PATH_ICONS_SITE; ?>icon_add.png" class="circle">
                                    </label>
                                </div>

                             <?php }} ?>

                        </div>
                        <div class="cu">
                            <label class="fotos">Tamanho máximo: 1MB</label> <label class="fotos">Formatos aceitos: PNG, JPEG ou GIF</label>
                            <img src="<?php echo PATH_ICONS_SITE; ?>i.png" class="i">
                        </div> 
                    </div>

                    <div class="box">

                        <div class="title">
                            <h2>Preços</h2>
                        </div>

                        <div class="flex">

                            <div>
                                <label for="price">Preço de venda</label>
                                <input type="text" placeholder="R$0,00" value="<?php echo $product['price']; ?>" name="price" class="price">
                            </div>

                            <div>
                                <label for="promoPrice">Preço promocional</label>
                                <input type="text" placeholder="R$0,00" value="<?php echo $product['promotion_price']; ?>" name="promoPrice" class="promoPrice">
                            </div>
                        </div>
                    </div>


                    <div class="box">

                        <div class="title"><h2>Peso e Dimensões</h2></div>

                        <div class="flex" id="dimensions">
                            <div>
                                <label for="massa">Peso</label>
                                <input type="text" value="<?php echo $product['massa']; ?>" name="massa" placeholder="0,00">
                            </div>

                            <div>
                                <label for="altura">Altura</label>
                                <input type="text" value="<?php echo $product['altura']; ?>" name="altura" placeholder="0,00">
                            </div>
                            
                            <div>
                                <label for="largura">Largura</label>
                                <input type="text" value="<?php echo $product['largura']; ?>" name="largura" placeholder="0,00"> 
                            </div>
                            
                            <div>
                                <label for="comprimento">Comprimento</label>
                                <input type="text" value="<?php echo $product['comprimento']; ?>" name="comprimento" placeholder="0,00">
                            </div>
                        </div>
                        
                    </div>


                    <div class="box">
                        
                        <div class="title"><h2>Categoria e Marca</h2></div>

                        <div class="flex">
                            <div>
                                <label for="category">Categoria</label>
                                <select name="category">
                                    <option selected value="<?php echo $categoryChosen['id'] ?>"><?php echo $categoryChosen['name']; ?></option>
                                    <?php
                                        foreach($categories as $row){
                                            $name = $row['name'];
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $name; ?></option>
                                    <?php
                                
                                        }
                                    ?>
                                </select>
                            </div>

                            <div>
                                <label for="mark">Marca</label>
                                <select name="mark">
                                    <option selected value="<?php echo $markChosen['id']; ?>"><?php echo $markChosen['name']; ?></option>
                                    <?php
                                        foreach($marks as $row){
                                
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        
                        <div class="title"><h2>Desconto</h2></div>

                        <select id="discount" name="discount[]">
                            
                            <?php 
                            
                                if($discountsChosen != null){ 
                                    foreach($discountsChosen as $dsct)
                                        $discountsChosen = $dsct;
                            
                            ?>
                            <option value=""></option>
                            <option value="<?php echo $discountsChosen['id']; ?>" selected><?php echo $discountsChosen['name']; ?></option>
                            
                            <?php }else{ ?>

                            <option value=""></option>
                            
                            <?php
                                }

                                foreach($discounts as $row){
                        
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                        
                                }
                            ?>
                        </select>

                        <input type="datetime-local" id="date" name="expiryDate">

                    </div>
                    
                    <div class="box">
                        <div class="title">
                            <h2>destacar</h2>
                        </div>
                        <label id="secao">Escolha em quais seções esse produto ficará em destaque.</label>
                        <aside class="add_var" id="destaque">
                            <div class="botao_checkbox <?php echo checkTrending($id); ?>"></div>
                            <input type="checkbox" name="isHighlighted" <?php echo checkTrending($id); ?>>
                            <label for="destaque">Destaque</label>
                        </aside>
                    </div>
                    
                    <div class="box" id="stock">
                        <div class="title">
                            <h2>Estoque</h2>
                        </div>
                        <div class="flex">

                            <!--
                            <div class="escolha">
                                <label for="amount">Infinito</label>
                                <input type="radio" id="infinity" name="isLimited" value="0" <?php echo checkAmount('unlimited', $id); ?>>
                            </div>
                            -->

                            <div class="escolha">
                                <label for="amount">Limitado</label>
                                <div>
                                    <input type="radio" id="limited" name="isLimited" value="1" <?php echo checkAmount('limited', $id); ?>>
                                    <?php if(checkAmount('limited', $id) != null){ ?>

                                        <input class="active" type="number" id="amount" value="<?php echo $product['amount']; ?>" name="amount" min="0" max="1024">

                                    <?php }else{ ?>

                                        <input type="number" id="amount" name="amount" min="0" max="1024">

                                    <?php } ?>
                                </div>
                            </div>
                        </div>  
                    </div>

                    <div class="title">
                        <h2>Mais opções</h2>
                    </div>
                    <div class="more">
                        <aside>
                            <div class="botao_checkbox"></div>
                            <label for="frete">este produto possui frete grátis</label>
                        </aside>
                        <aside>
                            <div class="botao_checkbox <?php echo checkInitPage($id); ?>"></div>
                            <input type="checkbox" name="isInitPage" <?php echo checkInitPage($id); ?>>
                            <label for="pag_inicial" >exibir produto na página inicial</label>
                        </aside>
                    </div>
                    <div class="criar">
                        <input type="submit" name="editProduct" value="Editar">
                    </div>

            </form>

        </div>

    </main>

    <?php include PATH_VIEWS.'footer.php'; ?>
    <script src="<?php echo PATH_SCRIPTS; ?>createProduct.js"></script>
    <script src="<?php echo PATH_SCRIPTS; ?>header.js"></script>
    <script src="<?php echo PATH_SCRIPTS_SITE; ?>notification.js"></script>
</body>
</html>