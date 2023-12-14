<?php

    require_once(PATH_VIEWS.'notification.php');

    if(isset($_SESSION['payment_success'])){

        setFlag('active', 'Sucesso', $_SESSION['payment_success']);
        $_SESSION['payment_success'] = null;

    }
    
    if(isset($_SESSION['payment_error'])){
        setFlag('active', 'Erro', $_SESSION['payment_error']);
        $_SESSION['payment_error'] = null;
    }

    $user = UserModel::getUser();
    $id = Login::getId();
    
    $cartProducts = CartModel::selectCartItem('*', "where user_id = $id"); 
    $totalAPagar = 0;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apolo Store</title>

    
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>cart.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>notification.css">
</head>
<body>

    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>

        <div class="container" id="title">
            
            <h1 id="main">MEU CARRINHO</h1> 

        </div>

        <section id="cart" class="container">
            <?php if($cartProducts->rowCount() > 0){ ?>

            <div id="products">
            
                    <?php foreach($cartProducts as $cart){ 

                        $id = $cart['product_id'];
                        $products = ProductModel::selectProduct("*", "where id = $id");
                        foreach($products as $product){

                            $discountedPrice = ProductModel::getPromotionPrice($product['id'], $product['price']);

                            $totalAPagar += $discountedPrice * $cart['amount'];

                            $path = PATH_UPLOADS."products/$id/";
                            $fileName = scandir($path)[2];
                    ?>

                    <div class="product">
                        
                        <input type="hidden" name="productsIds[]" value="<?php echo $product['id']; ?>">
                        <div class="checkbox"></div>

                        <div class="img-box">
                            
                            <img src="<?php echo "$path/$fileName"; ?>">

                        </div>

                        <div class="product-info">

                            <h1><?php echo $product['name']; ?></h1>

                            <?php if($discountedPrice == $product['price']){ ?>

                                <h1 class="price">R$<?php echo $product['price']; ?></h1>

                            <?php }else{ ?>

                                <h1 class="no-discount">R$<?php echo $product['price']; ?></h1>
                                <h1 class="price discount">R$<?php echo $discountedPrice; ?></h1>

                            <?php } ?>

                            <form class="amount-form" action="<?php echo FULL_PATH_SITE; ?>cart/setAmount" method="get">
                                
                                    <div class="product-amount">
                                    
                                        <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">

                                        <div class="decrement-amount">-</div>

                                        <input type="number" name="amount" value="<?php echo (int)($cart['amount']); ?>" min="1" max="<?php echo (int)($product['amount']); ?>">
                                        <div class="increment-amount">+</div>

                                        <input type="submit" name="setAmount">
                                   
                                    </div>   
                                
                            </form>
                        </div>

                    </div>

                    <?php }} ?>

                    

            </div>
            
            <div id="cart-info">
                
                <div>
                    <div id="price">
                        <h3 id="total-price">R$0,00</h3>
                    </div>

                    <div id="address-info">

                        <?php if(UserAddressModel::selectDefaultAddress()->rowCount() > 0){ 
                            $address = UserAddressModel::getDefaultAddress();    
                        ?>

                            <div class="balloon">
                                <span>Entregar em: </span>
                                <p id="full-address">
                                    <?php
                                        echo $address['endereco'].', '.
                                        $address['numero'].', '.
                                        $address['bairro'].', '.
                                        $address['cidade'].', '.
                                        $address['estado'];
                                    ?>
                                </p>
                            </div>
                            
                            <div id="right">
                                <div><span>Não é esse o endereço?</span></div>

                                <div><span id="effect"><a href="<?php echo FULL_PATH_ACCOUNT.'/address/edit?id='.$address['id']; ?>">Editar meu endereço</a></span></div>
                            </div>

                            <a id="pay">Finalizar (<?php echo $cartProducts->rowCount(); ?>)</a>
                            

                        <?php }else{ ?>

                            <div class="balloon">
                                <p><span id="opa">Opa!</span> Parece que você ainda não tem um endereço cadastrado </p>
                            </div>

                            <div id="finish-cad"> 
                                <span>
                                    Termine seu cadastro para finalizar a compra
                                </span>    

                                <a href="<?php echo FULL_PATH_ACCOUNT; ?>"><span>Completar</span> <span>Cadastro</span></a>
                            </div>

                        <?php } ?>

                    </div>

                    <div id="cart-inputs">

                        <div id="select">
                            <div class="wrapper">
                                <div id="select-icon"></div>
                                <span id="select-everything">Selecionar todos</span>
                            </div>
                        </div>

                        <div id="delete">
                            <form action="<?php echo FULL_PATH_CART; ?>" method="post">
                                <input type="submit" name="delete">
                            </form>

                            <div class="wrapper">
                                <div id="trash-icon"></div>
                                <span id="deleteItens">Excluir itens</span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <?php }else{ ?>

            <div id="empty-cart">
                <h1>Parece que seu carrinho está vazio</h1>
                <h2>Adicione itens para realizar uma compra</h2>
                <a href="<?php echo FULL_PATH_CATALOGO; ?>">Visitar catálogo</a>
            </div>
            <?php } ?>

            <div id="modal">
                <span id="close">X</span>
                <div id="paymentBrick_container"></div>
            </div>
        </section>
    </main>

    <a id="redirect" target="_blank" href=""></a>

    <?php include(PATH_VIEWS.'footer.php'); ?>
    <script src="<?php echo PATH_SCRIPTS; ?>globals.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>cart.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>notification.js"></script>

    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>

        const mp = new MercadoPago('TEST-211efdce-9dca-4539-b6c1-9205f00670ed', {
            locale: 'pt-BR'
        });

        let settings

        const bricksBuilder = mp.bricks();
        const renderPaymentBrick = async (bricksBuilder) => {

            
            
            let user
            let cep

            await fetch(fullPath + "api/user/get", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    mode: "cors",
                    body: JSON.stringify({ message: 'bom dia' }),
                })
                    .then((response) => response.json())
                    .then((response) => {
                        user = response
                        const cp = user.cep.toString()
                        cep = cp.slice(0, 5) + "-" + cp.slice(5, 8)
                        console.log(user)
                        
                    })
                    .catch((error) => {
                        console.log(error)
                    });

            settings = {
                initialization: {
                /*
                    "amount" é a quantia total a pagar por todos os meios de pagamento com exceção da Conta Mercado Pago e Parcelas sem cartão de crédito, que têm seus valores de processamento determinados no backend através do "preferenceId"
                */
                    amount: Number(document.querySelector('#total-price').innerText.slice(2)),
                    preferenceId: "<PREFERENCE_ID>",
                    payer: {
                        firstName: user.first_name,
                        lastName: user.last_name,
                        email: user.email,
                        identification: {
                            type: "CPF",
                            number: user.cpf
                        },
                        address: {
                            federalUnit: user.estado,
                            city: user.cidade,
                            neighborhood: user.bairro,
                            streetName: user.endereco,
                            zipCode: cep,
                            complement: user.complemento,
                            streetNumber: user.numero.toString()
                        }
                        
                    },
                },
                customization: {
                visual: {
                    style: {
                    theme: "dark",
                    },
                },
                paymentMethods: {
                    ticket: "all",
                    bankTransfer: "all",
                    creditCard: "all",
                    debitCard: "all",
                    maxInstallments: 12
                },
                },
                callbacks: {
                onReady: () => {
                },
                onSubmit: ({ selectedPaymentMethod, formData }) => {
                    
                    const amount = document.querySelector('#total-price').innerText.slice(2)

                    formData.transaction_amount = Number(amount)
                    console.log(formData)
                    return new Promise((resolve, reject) => {
                        fetch(fullPath + "payment/process", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            mode: "cors",
                            body: JSON.stringify(formData),
                        })
                            .then((response) => response.json())
                            .then((response) => {
                            // receber o resultado do pagamento
    
                                if(response.status){
                                    if(response.status.match(/error/g)){
                                        location.reload()
                                    }
                                }
                                console.log(response)
                                addOrder(response)
                                resolve();
                            })
                            .catch((error) => {
                                // manejar a resposta de erro ao tentar criar um pagamento
                                window.location = fullPath + 'payment/error'
                                console.log(error)
                            });
                    });
                },
                onError: (error) => {
                    // callback chamado para todos os casos de erro do Brick
                    console.error(error);
                },
                },
            };
            window.paymentBrickController = await bricksBuilder.create(
                "payment",
                "paymentBrick_container",
                settings
            );
        };

        renderPaymentBrick(bricksBuilder);

        async function addOrder(payment){

            const inputs = document.querySelectorAll('#products input[name=productId]')
            const productsIds = []

            for(input of inputs)
                productsIds.push(input.value)
            
            const order = { 'ids' : productsIds, 'payment' : payment }
            console.log(order)

            await fetch(fullPath + "order/add", {
                    method: "POST",
                    headers: {
                    "Content-Type": "application/json",
                    },
                    mode: "cors",
                    body: JSON.stringify(order),
                })
                    .then((response) => response.json())
                    .then(async(response) => {
                    // receber o resultado do pagamento
                        let method  =  payment.method
                        console.log(response)
                        if(method == 'pix'){

                            const link = document.querySelector('#redirect');
                            const url = payment.redirects.transaction_data.ticket_url

                            link.setAttribute('href', url)
                            await link.click()
                        }
                        
                        location.reload()
                    })
                    .catch((error) => {
                        // manejar a resposta de erro ao tentar criar um pagamento
                        window.location = fullPath + 'payment/error'    
                        console.log(error)
                    });           
        } 

    </script>
</body>
</html>