<?php

	if(isset($category)){
		$query = "SELECT DISTINCT a.name, a.id FROM marks AS a INNER JOIN products AS b ON a.id = ".
		"b.mark_id $category AND a.is_active = 1";
	}else{
		$query = "SELECT DISTINCT a.name, a.id FROM marks AS a INNER JOIN products AS b ON a.id = ".
		"b.mark_id WHERE a.is_active = 1";
	}

	$marks = MySql::freeSelect($query);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Apolo Store</title>

	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>catalogo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>catalogo-categorias.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">

</head>
<body>

	<?php include(PATH_VIEWS.'header.php'); ?>

	<main>

		<div class="container">

			<div id="wrapper">
				<section id="categories">

					<div><a id="clear-filter" href="<?php echo FULL_PATH_CATALOGO; ?>">Limpar filtros</a></div>

					<section>
						<h2>Departamentos</h2>
						<ul>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/processadores">Processadores</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/placasDeVideo">Placas de vídeo</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/memorias">Memórias</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/discosRigidos">Discos Rígidos</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/SSDs">SSDs</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/placasMaes">Placas-mães</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/mouses">Mouses</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/teclados">Teclados</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/monitores">Monitores</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/headsets">Headsets e fones</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO; ?>/coolers">Coolers e Water Coolers</a></li>
							<li><a href="<?php echo FULL_PATH_CATALOGO ?>/tabletsIpads">Tablets e IPads</a></li>
						</ul>
					</section>

					<section>
						<h2>Marcas</h2>

						<ul>
							<?php 
							
								foreach($marks as $mark){ 
									
									$where = "WHERE mark_id = ".$mark['id']. " AND is_active = 1";

									if(isset($_GET['price'])){
										$href = "?price=".$_GET['price']."&mark=". strtolower($mark['name']);
									}else{
										$href = "?mark=". strtolower($mark['name']);
									}
							?>
								<a href="<?php echo $href; ?>">
									<?php echo strtolower($mark['name']); ?>
									(<?php echo ProductModel::selectProduct('id', $where)->rowCount(); ?>)
								</a>

							<?php } ?>
						</ul>

					</section>

					<section>

						<h2>Preço</h2>

						<ul>

							<li>	
								<?php if(isset($_GET['mark'])){ ?>
								
									<a href="?mark=<?php echo $_GET['mark']; ?>&price=50">
										Até 50
										(<?php echo ProductModel::selectProduct('id', "WHERE price <= 50")->rowCount(); ?>)	
									</a>

									<?php }else{ ?>

									<a href="?price=50">
										Até 50
										(<?php echo ProductModel::selectProduct('id', "WHERE price <= 50")->rowCount(); ?>)	
									</a>
								
								<?php } ?>
							</li>
							
							<li>	
								<?php if(isset($_GET['mark'])){ ?>
							
								
									<a href="?mark=<?php echo $_GET['mark']; ?>&price=100">
										Até 100
										(<?php echo ProductModel::selectProduct('id', "WHERE price <= 100")->rowCount(); ?>)	
									</a>

									<?php }else{ ?>

									<a href="?price=100">
										Até 100
										(<?php echo ProductModel::selectProduct('id', "WHERE price <= 100")->rowCount(); ?>)	

									</a>
								
								<?php } ?>
							</li>

							<li>	
								<?php if(isset($_GET['mark'])){ ?>
							
								
									<a href="?mark=<?php echo $_GET['mark']; ?>&price=500">
										Até 500
										(<?php echo ProductModel::selectProduct('id', "WHERE price <= 500")->rowCount(); ?>)	

									</a>

									<?php }else{ ?>

									<a href="?price=500">
										Até 500	
										(<?php echo ProductModel::selectProduct('id', "WHERE price <= 500")->rowCount(); ?>)	

									</a>
								
								<?php } ?>
							</li>

							<li>	
								<?php if(isset($_GET['mark'])){ ?>
							
								
									<a href="?mark=<?php echo $_GET['mark']; ?>&price=1000">
										Até 1000
										(<?php echo ProductModel::selectProduct('id', "WHERE price <= 1000")->rowCount(); ?>)	
									</a>

									<?php }else{ ?>

									<a href="?price=1000">
										Até 1000
										(<?php echo ProductModel::selectProduct('id', "WHERE price <= 1000")->rowCount(); ?>)	
									</a>
								
								<?php } ?>
							</li>

							<li>	
								<?php if(isset($_GET['mark'])){ ?>
							
								
									<a href="?mark=<?php echo $_GET['mark']; ?>&price=mais-de-1000">
										Mais de 1000
										(<?php echo ProductModel::selectProduct('id', "WHERE price > 1000")->rowCount(); ?>)	
									</a>

									<?php }else{ ?>

									<a href="?price=mais-de-1000">
										Mais de 1000
										(<?php echo ProductModel::selectProduct('id', "WHERE price > 1000")->rowCount(); ?>)	
									</a>
								
								<?php } ?>
							</li>

						</ul>

					</section>

				</section>

				<section id="products">

					<?php foreach($products as $product){
						$id = $product['id'];
						$path = PATH_UPLOADS."products/$id";
						$logo = '';

						foreach(scandir($path) as $item){
							if(preg_match("/image1/", $item))
							  $logo = $item;
						}

						$discountedPrice = ProductModel::getPromotionPrice($id, $product['price']);

					?>

					<div class="product-wrapper">
	
						<form action="<?php echo FULL_PATH_SITE; ?>cart/add" method="post">

							<div class="img-box">
								<a href="<?php echo FULL_PATH_SITE; ?>product?productId=<?php echo $id; ?>">
									<img src="<?php echo FULL_PATH_UPLOADS."products/$id/$logo";?>" alt="imagem do produto">
								</a>
							</div>
							<div class="info">
								<p class="name"><?php echo $product['name']; ?></p>
								<?php if($discountedPrice == $product['price']){ ?>
									<h3>R$<?php echo $product['price']; ?></h3>
								
								<?php }else{ ?>
									<h3 class="no-discount">R$<?php echo $product['price']; ?></h3>
									<h3 class="discount">R$<?php echo $discountedPrice; ?></h3>
								<?php } ?>
								<input type="hidden" name="productId" value="<?php echo $id; ?>">
								<input type="hidden" name="cartAmount" value="1">
								<input type="hidden" name="productPrice" value="<?php echo $product['price']; ?>">
							
							</div>
							<input type="submit" name="addProduct" value="Comprar">
							
						</form>

					</div>

					<?php } ?>

				</section>
			</div>

			<div id="pages">
				<?php 

					if($totalPages){
						for($i = 1; $i <= $totalPages; $i++){

							if(isset($_GET['search'])){

								$search = $_GET['search'];

								echo "<h3><a href='?page=$i&search=$search'>$i</a></h3>";


							}else{
								echo "<h3><a href='?page=$i'>$i</a></h3>";
							}
						}
					}

				?>
			</div>
		</div>

	</main>

	<?php include(PATH_VIEWS.'footer.php'); ?>

	<script>

		const names = document.querySelectorAll('.name')

		names.forEach(name => {
			const value = name.innerText

			if(value.length > 25){
				name.innerText = value.slice(0, 24) + '...'
			}

		})
	</script>

	<script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>
</body>
</html>