<?php

    $marks = MarkModel::selectMark('*', "WHERE id = $id");
    $mark = '';
    foreach($marks as $mrk) $mark = $mrk; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>edit.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">
    <title>Urus Store</title>
</head>
<body>
    
    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>
        <div class="container">
            <section>
                <h1>Editar Marca</h1>
                <form action="<?php echo FULL_PATH_PANEL; ?>marca/edit" method="post">
                    <input type="hidden" name="id" value="<?php echo $mark['id']; ?>">
                    <label for="name">Nome</label>
                    <input type="text" name="name" value="<?php echo $mark['name']; ?>">
                    <input type="submit" name="editMark">
                    <a href="<?php echo FULL_PATH_PANEL; ?>marca/delete?id=<?php echo $mark['id']; ?>">Deletar</a>
                </form>
            </section>
        </div>
    </main>

    <?php include(PATH_VIEWS.'footer.php'); ?>

    <script src="<?php echo PATH_SCRIPTS; ?>header.js"></script>

</body>
</html>