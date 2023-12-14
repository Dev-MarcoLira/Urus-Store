<?php

    $pendentes = PaymentModel::selectPayments('*', "WHERE status = 'pending'");
    $finalizadas = PaymentModel::selectPayments('*', "WHERE status = 'sucesso'");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urus Store</title>

    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>orders.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>main-menu.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">

</head>
<body>
  
    <div id="menu-trigger">
        <img src="<?php echo PATH_ICONS_SITE; ?>icon_list.png" alt="menu">
    </div>

    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>
        <div class="container">

          <?php include(PATH_VIEWS.'main-menu.php'); ?>

            <section id="right">

                <div id="product-modal">
                    

                </div>

                <h1>Vendas</h1>
                <div id="linha"></div>

                <?php if($pendentes->rowCount() > 0){ ?>

                <h2>Em Aberto</h2>

                    <div class="abr">

                        <?php foreach($pendentes as $venda){ 
                            $user = '';

                            foreach(UserModel::selectUser('name', "WHERE id = ".$venda['user_id']) as $usr)
                                $user = $usr;
                            

                            $status = $venda['status'];
                            $status = $status == 'pending' ? 'pendente' : $status;

                            $paymentId = $venda['id'];
                            $products = PaymentModel::selectOrderItems('id', "WHERE payment_id = $paymentId");
                        ?>

                        <table>
                            <tr id="inicio">
                                <td class="id">Venda</td>
                                <td class="date">Data</td>
                                <td>Cliente</td>
                                <td>Total</td>
                                <td class="link">Produtos</td>
                                <td>Status de Pagamento</td>
                                <td>Status de Envio</td>
                                <td class="actions">Ações</td>
                            </tr>
                            <tr id="fim">
                                <td class="segunda id">#<?php echo $paymentId; ?></td>
                                <td class="segunda date"><?php echo $venda['created_at']; ?></td>
                                <td class="segunda"><?php echo $user['name']; ?></td>
                                <td class="segunda">R$<?php echo $venda['amount']; ?></td>
                                <td class="segunda link"><button class="product-modal-trigger" id="<?php echo $paymentId; ?>">Ver <?php echo $products->rowCount(); ?></button></td>
                                <td class="segunda status"><div class="pag <?php echo $venda['status']; ?>"><?php echo $status; ?></div></td>
                                <td class="segunda status"><div class="env transito">Aguardando Pagamento</div></td>  
                                <td class="segunda actions"></td>
                            </tr>
                        </table>

                        <?php } ?>
                    </div>

                <?php } ?>

                <?php if($finalizadas->rowCount() > 0){ ?>

                <h2>Finalizadas</h2>
                    <div class="fin">
                        <table>
                            <tr id="inicio">
                                <td class="id">Venda</td>
                                <td class="date">Data</td>
                                <td>Cliente</td>
                                <td>Total</td>
                                <td class="link">Produtos</td>
                                <td>Status de Pagamento</td>
                                <td>Status de Envio</td>
                                <td class="actions">Ações</td>
                            </tr>

                            <?php foreach($finalizadas as $venda){

                                $user = '';

                                foreach(UserModel::selectUser('name', "WHERE id = ".$venda['user_id']) as $usr)
                                    $user = $usr;
                            
                                $status = $venda['status'];
                                $status = $status == 'pending' ? 'pendente' : $status;

                                $paymentId = $venda['id'];
                                $products = PaymentModel::selectOrderItems('id', "WHERE payment_id = $paymentId");    
                            ?>

                            <tr id="fim">
                                <td class="segunda id">#<?php echo $paymentId; ?></td>
                                <td class="segunda date"><?php echo $venda['created_at']; ?></td>
                                <td class="segunda"><?php echo $user['name']; ?></td>
                                <td class="segunda">R$<?php echo $venda['amount']; ?></td>
                                <td class="segunda link"><button class="product-modal-trigger" id="<?php echo $paymentId; ?>">Ver <?php echo $products->rowCount(); ?></button></td>
                                <td class="segunda status"><div class="pag <?php echo $venda['status']; ?>"><?php echo $status; ?></div></td>
                                <td class="segunda status"><div class="env transito">Aguardando pagamento?></div></td>
                                <td class="segunda actions"></td>
                            </tr>

                            <?php } ?>
                        </table>
                    </div>

                    <?php } ?>
            </section>
        </div>
    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script src="<?php echo PATH_SCRIPTS; ?>header.js"></script>
    <script src="<?php echo PATH_SCRIPTS_SITE; ?>globals.js"></script>
    <script src="<?php echo PATH_SCRIPTS; ?>main-menu.js"></script>
    <script src="<?php echo PATH_SCRIPTS; ?>orders.js"></script>

</body>
</html>