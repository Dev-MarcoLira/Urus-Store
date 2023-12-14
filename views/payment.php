<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apolo Store</title>

    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>payment.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">

</head>
<body>
    
    <?php include(PATH_VIEWS).'header.php'; ?>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <div id="paymentBrick_container">
    </div>
    
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script src="globals.js"></script>

    <script>

        const mp = new MercadoPago('TEST-211efdce-9dca-4539-b6c1-9205f00670ed', {
            locale: 'pt-BR'
        });
        const bricksBuilder = mp.bricks();
            const renderPaymentBrick = async (bricksBuilder) => {
            const settings = {
                initialization: {
                /*
                    "amount" é a quantia total a pagar por todos os meios de pagamento com exceção da Conta Mercado Pago e Parcelas sem cartão de crédito, que têm seus valores de processamento determinados no backend através do "preferenceId"
                */
                    amount: 10000,
                    preferenceId: "<PREFERENCE_ID>",
                    payer: {
                        firstName: "",
                        lastName: "",
                        email: "",
                    },
                },
                customization: {
                visual: {
                    style: {
                    theme: "dark",
                    },
                },
                paymentMethods: {
                    creditCard: "all",
                                                debitCard: "all",
                                                ticket: "all",
                                                bankTransfer: "all",
                                                atm: "all",
                    maxInstallments: 12
                },
                },
                callbacks: {
                onReady: () => {
                    /*
                    Callback chamado quando o Brick está pronto.
                    Aqui, você pode ocultar seu site, por exemplo.
                    */
                },
                onSubmit: ({ selectedPaymentMethod, formData }) => {
                    // callback chamado quando há click no botão de envio de dados
                    return new Promise((resolve, reject) => {
                    fetch(fullPath + "process-payment", {
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
                            console.log(response)
                            resolve();
                        })
                        .catch((error) => {
                            // manejar a resposta de erro ao tentar criar um pagamento
                            console.log('fudeu')
                            reject();
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
    
    </script>

    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>

</body>
</html>