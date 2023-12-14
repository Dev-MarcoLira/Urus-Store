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
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>main-menu.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>notification.css">

</head>
<body>
    
    <?php include PATH_VIEWS.'header.php'; ?>

    <main>

        <div class="container">
            
            <h1>Novo Produto</h1>

            <form action="<?php echo FULL_PATH_PANEL; ?>product/create" autocomplete="off" enctype="multipart/form-data" method="post" name="formCreatePorduct">

                    <div class="box">

                        <div class="title"><h2>Nome e Descrição</h2></div>

                        <label for="name">Nome</label>
                        <input type="text" name="name">
                        <label for="desc">Descrição</label>
                        <textarea name="desc" cols="30" rows="10"></textarea>
                    </div>

                    
                    <div class="box">

                        <div class="title"><h2>Fotos</h2></div>

                        <div class="imgs">
                            <div class="img">
                                <label class="botao-attach-file">
                                   <input type="file" required name="image1"> <img src="<?php echo PATH_ICONS_SITE; ?>icon_add.png" class="circle">
                                </label>
                            </div>
                            
                            <div class="img">
                                <label class="botao-attach-file">
                                    <input type="file" name="image2"> <img src="<?php echo PATH_ICONS_SITE; ?>icon_add.png" class="circle">
                                </label>  
                            </div>
                            <div class="img">
                                <label class="botao-attach-file">
                                    <input type="file" name="image3"> <img src="<?php echo PATH_ICONS_SITE; ?>icon_add.png" class="circle">
                                </label>
                            </div>
                            <div class="img">
                                <label class="botao-attach-file">
                                    <input type="file" name="image4"> <img src="<?php echo PATH_ICONS_SITE; ?>icon_add.png" class="circle">
                                </label>
                            </div>
                        </div>
                        <div class="cu">
                            <label class="fotos">Tamanho mínimo: 000px</label> <label class="fotos">Formatos recomendados: PNG, JPEG ou GIF</label>
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
                                <input type="text" placeholder="R$0,00" name="price" class="price">
                            </div>

                            <div>
                                <label for="promoPrice">Preço promocional</label>
                                <input type="text" placeholder="R$0,00" name="promoPrice" class="promoPrice">
                            </div>
                        </div>
                    </div>


                    <div class="box">

                        <div class="title"><h2>Peso e Dimensões</h2></div>

                        <div class="flex" id="dimensions">
                            <div>
                                <label for="massa">Peso</label>
                                <input type="text" name="massa" placeholder="0,00">
                            </div>

                            <div>
                                <label for="altura">Altura</label>
                                <input type="text" name="altura" placeholder="0,00">
                            </div>
                            
                            <div>
                                <label for="largura">Largura</label>
                                <input type="text" name="largura" placeholder="0,00"> 
                            </div>
                            
                            <div>
                                <label for="comprimento">Comprimento</label>
                                <input type="text" name="comprimento" placeholder="0,00">
                            </div>
                        </div>
                        
                    </div>


                    <div class="box">
                        
                        <div class="title"><h2>Categoria e Marca</h2></div>

                        <div class="flex">
                            <div>
                                <label for="category">Categoria</label>
                                <select name="category">
                                    <?php
                                        foreach($categories as $row){
                                
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                
                                        }
                                    ?>
                                </select>
                            </div>

                            <div>
                                <label for="mark">Marca</label>
                                <select name="mark">
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
                            <option value=""></option>
                            <?php
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
                            <div class="botao_checkbox"></div>
                            <input type="checkbox" name="isHighlighted">
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
                                <input type="radio" id="infinity" name="isLimited" value="0">
                            </div>
                            -->
                            <div class="escolha">
                                <label for="amount">Limitado</label>
                                <div>
                                    <input type="radio" id="limited" name="isLimited" value="1">
                                    <input type="number" id="amount" name="amount" min="1" max="1024">
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
                            <div class="botao_checkbox"></div>
                            <input type="checkbox" name="isInitPage">
                            <label for="pag_inicial" >exibir produto na página inicial</label>
                        </aside>
                    </div>
                    <div class="criar">
                        <input type="submit" name="createProduct" value="Criar">
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