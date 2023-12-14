<?php

    $id = $_GET['id'];
    
    if(!$address = UserAddressModel::getAddress($id)){
        $_SESSION['address_error'] = 'Não foi possível encontrar esse endereço!';
        Login::redirect(FULL_PATH_ACCOUNT);
    }

    function checkIsDefault(){
        $state = UserAddressModel::getDefaultState($_GET['id']);

        if($state){
            return 'checked';
        }else{
            return;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>address.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">

    <title>Urus Store</title>
</head>

<body>
    <?php include(PATH_VIEWS.'header.php'); ?>

    <section>
        <main>

            <div class="container3">
                <form action="<?php echo FULL_PATH_ACCOUNT; ?>/address/edit" method="post">

                    <a href="<?php echo FULL_PATH_ACCOUNT; ?>">
                        <h1>VOLTAR</h1>
                    </a>
                    <div class="container2">
                        <h1 id="cade">EDITAR ENDEREÇO</h1>
                        <div class="container">
        
                            <div id="div1">
        
                                <input type="hidden" name="id" value="<?php echo $address['id']; ?>">

                                <h6>PRIMEIRO NOME*</h6>
                                <input type="text" required name="fName" minlength="5" maxlength="20" placeholder="DIGITE SEU PRIMEIRO NOME"
                                 value="<?php echo $address['first_name']; ?>">
                                <div id="cep-div">
                                    <h6>CEP/CÓDIGO POSTAL</h6>
                                    <input type="text" id="cep" name="cep" required minlength="9" maxlength="9" placeholder="EXEMPLO:12345-123"
                                    value="<?php echo $address['cep']; ?>" >
                                    <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank">Não sei o meu CEP</a>
                                </div>
                                
                                <h6>ESTADO/PROVÍNCIA</h6>
                                <input type="text" name="estado" readonly maxlength="20" readonly
                                value="<?php echo $address['estado']; ?>" >

                                <h6>CIDADE</h6>
                                <input type="text" name="cidade" readonly maxlength="20" readonly
                                value="<?php echo $address['cidade']; ?>" >

                                <h6>BAIRRO</h6>
                                <input type="text" name="bairro" readonly maxlength="20" readonly
                                value="<?php echo $address['bairro']; ?>" >
                            </div>
                            <div id="div2">
                                <h6>SOBRENOME*</h6>
                                <input type="text" required name="lName" minlength="5" maxlength="20" placeholder="DIGITE SEU SOBRENOME"
                                value="<?php echo $address['last_name']; ?>" >

                                <h6>CELULAR*</h6>
                                <input type="text" required id="phone" name="phone" minlength="14" maxlength="14" placeholder="INSIRA SEU TELEFONE CELULAR"
                                value="<?php echo $address['phone']; ?>" >

                                <h6>ENDEREÇO</h6>
                                <input type="text" name="endereco" readonly maxlength="20" placeholder="DIGITE SEU ENDEREÇO"
                                value="<?php echo $address['endereco']; ?>" >

                                <h6>NÚMERO</h6>
                                <input type="text" name="numero" required maxlength="5" placeholder="NÚMERO DA RESIDÊNCIA"
                                value="<?php echo $address['numero']; ?>" >

                                <h6>COMPLEMENTO</h6>
                                <input type="text" name="complemento" maxlength="60" placeholder="INFORME O COMPLEMENTO"
                                value="<?php echo $address['complemento']; ?>" >

                                <div class="padrao1">

                                    <div>
                                        <span><h6>TORNAR PADRÃO</h6></span>
                                        <label class="switch">
                                            <input type="checkbox" <?php echo checkIsDefault(); ?> name="isDefault">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    
                                    <h5>AO ATIVAR, TODOS OS SEUS PEDIDOS SERÃO AUTOMATICAMENTE ENVIADOS AO ENDEREÇO INDICADO.</h5>
                                    <input type="submit" id="save" value="SALVAR">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
        </main>
        <?php include(PATH_VIEWS.'footer.php') ?>
    </section>

    <script src="<?php echo PATH_SCRIPTS; ?>showMaskedInputs.js"></script>
    <script src="<?php echo PATH_SCRIPTS; ?>address.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>
</body>

</html>