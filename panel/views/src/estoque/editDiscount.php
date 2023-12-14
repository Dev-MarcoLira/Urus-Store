<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Urus Store</title>

    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>edit.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS_SITE ?>fonts.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>footer.css">
</head>
<body>

    <?php include(PATH_VIEWS.'header.php'); ?>

	<main>
        <div class="container">
            <section>
                <h1>Editar Desconto</h1>
                
                    <form action="<?php echo FULL_PATH_PANEL; ?>discount/edit" method="post" name="formEditDiscount">
                
                        <input type="hidden" name="id" value="<?php echo $discount['id'] ?>">
                    <label for="dName">Nome</label>
                        <input type="text" name="dName" value="<?php echo $discount['name']; ?>">
                
                        <label for="dDescription">Descrição</label>
                        <textarea type="text" name="dDescription" cols="30" rows="10" value="<?php echo $discount['description']; ?>"></textarea>
                
                        <label for="dType">Tipo do Desconto</label>
                        <select name="dType">
                            <?php if($type == 'preco'){ ?>
                                <option value="preco" selected>preço</option>
                                <option value="porcen">porcentagem</option>
                            <?php }else{ ?>
                                <option value="porcen" selected>porcentagem</option>
                                <option value="preco">preço</option>
                            <?php } ?>
                        </select>
                        <label for="dValue">Discount Value</label>
                        <input type="text" name="dValue" value="<?php echo $discount['discount']; ?>">
                
                        <input type="submit" name="editDiscount" value="Editar">
                        <a href="<?php echo FULL_PATH_PANEL."discount/delete".$discount['id']; ?>">Deletar</a>
                    </form>
            </section>
        </div>
    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>header.js"></script>

	<script type="text/javascript">
		document.querySelector('textarea').value = "<?php echo $discount['description']; ?>";
	</script>

</body>
</html>