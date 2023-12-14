<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urus Store</title>

    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>edit.css"/>
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css"/>
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css"/>

</head>
<body>
    
    <?php include PATH_VIEWS.'header.php'; ?>

    <main>
        <div class="container">
            <section>
                <h1>Editar Categoria</h1>
                <form action="<?php echo FULL_PATH_PANEL; ?>category/edit" name="formEditCategory" method="post">
                    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                    <label for="cName">Nome</label>
                    <input type="text" name="cName" value="<?php echo $category['name']; ?>">
                    <label for="cDesc">Descrição</label>
                    <textarea name="cDesc" cols="30" rows="10"></textarea>
                    <input type="submit" name="editCategory" value="Enviar">
                    <a href="<?php echo FULL_PATH_PANEL."category/delete?id=".$category['id'];?>">Deletar</a>
                </form>
            </section>
        </div>
    </main>

    <?php include PATH_VIEWS.'footer.php'; ?>

    <script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>header.js" ></script>

	<script type="text/javascript">
		
		document.querySelector('textarea').value = "<?php echo $category['description']; ?>";

	</script>

</body>
</html>