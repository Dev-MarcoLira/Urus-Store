<?php

	class CatalogoController{

		/* include views */

		public function view(){
			
			$url = $_GET['url'];
			$sql = null;
			$category = null;

			$marks = isset($_	['mark']) ? $_GET['mark'] : null;
			$price = isset($_GET['price']) ? $_GET['price'] : null;
			

			if($url !== 'catalogo'){
				$fileName = $this->getFilename(explode("/", $url)[1]);
				$category = $this->getCategoriesClauses($fileName);	
				$sql = $category;

				if(isset($_GET['search']))
				$sql .= " AND " . $this->searchEngine();
			
				if(isset($marks))
					$sql .= " AND mark_id = (SELECT id FROM marks WHERE name LIKE '$marks')";

				if(isset($price)){
					if($price != "mais-de-1000"){
						$sql .= " AND price <= $price";
					}else{
						$sql .= " AND price > 1000";
					}
				}

				$sql .= " AND is_active = 1";

			}else{
				if(isset($_GET['search'])){
					$sql = "WHERE " . $this->searchEngine();

					if(isset($marks))
						$sql .= " AND mark_id = (SELECT id FROM marks WHERE name LIKE '$marks')";

					if(isset($price)){
						if($price != "mais-de-1000"){
							$sql .= " AND price <= $price";
						}else{
							$sql .= " AND price > 1000";
						}
					}

					$sql .= " AND is_active = 1";
				}else{
					if(isset($marks)){
						$sql .= "WHERE mark_id = (SELECT id FROM marks WHERE name LIKE '$marks')";						
						
						if(isset($price)){
							if($price != "mais-de-1000"){
								$sql .= " AND price <= $price";
							}else{
								$sql .= " AND price > 1000";
							}
						}

						$sql .= " AND is_active = 1";
					}else{

						if(isset($price)){
							if($price != "mais-de-1000"){
								$sql .= " WHERE price <= $price";
							}else{
								$sql .= " WHERE price > 1000";
							}
	
							$sql .= " AND is_active = 1";
						}
					}

					if(!isset($marks) && !isset($price)){
						$sql = "WHERE is_active = 1";
					}
				}
			}

			if(ProductModel::selectProduct('*', $sql) == true){

				$numOfProducts = ProductModel::selectProduct('*', $sql)->rowCount();
				$productsPerPage = 9;

				$totalPages = Paginator::calcNumOfPages($numOfProducts, $productsPerPage);
				$limit = Paginator::calcLimit($productsPerPage, $numOfProducts);

				$sql .= $limit;

			}else{
				Login::redirect(FULL_PATH_CATALOGO);
			}

			if(count(explode('/', $url)) == 2){
				
				$fileName = explode('/', $url)[1];
				$fileName = empty($fileName) ? 'catalogo' : $fileName;
			}else
				$fileName = 'catalogo';

			if(!$products = ProductModel::selectProduct('*', $sql)) Login::redirect(FULL_PATH_CATALOGO);
			
			include(PATH_CATALOGO."catalogo.php");
		}


		/* functions */

		private function searchEngine(){

			$search = $_GET['search'];

			if(strlen($search) <= 4){

				$sql = "(name LIKE '%$search%' OR description LIKE '%$search%') ";
			}else{

				$sql = "(MATCH(name) AGAINST('*$search*' in boolean mode) OR MATCH (description) AGAINST('*$search*' in boolean mode) OR category_id = (SELECT id FROM categories WHERE MATCH(name) AGAINST('$search') LIMIT 1)) ";
			}

			return $sql;
		}

		private function getCategoriesClauses($fileName){

			if(!is_array($fileName)){
				$sql = "WHERE category_id = (SELECT id FROM categories WHERE name = '$fileName')";
			}else{
				
				$sql = "WHERE category_id = (SELECT id FROM categories WHERE name = '".$fileName[0]."')";
				$sql .= " OR category_id = (SELECT id FROM categories WHERE name = '".$fileName[1]."')";
			}

			return $sql;
		}

		private function getFilename($fileName){
			if($fileName == 'processadores'){
				$sql = 'processador';
			}else if($fileName == 'coolers'){
				$sql = 'cooler';
			}else if($fileName == 'discosRigidos'){
				$sql = 'hd';
			}else if($fileName == 'headsets'){
				$sql = 'headset';
			}else if($fileName == 'monitores'){
				$sql = 'monitor';
			}else if($fileName == 'placasDeVideo'){
				$sql = 'placa de video';
			}else if($fileName == 'SSDs'){
				$sql = 'ssd';
			}else if($fileName == 'placasMaes'){
				$sql = 'placa-mãe';
			}else if($fileName == 'mouses'){
				$sql = 'mouse';
			}else if($fileName == 'teclados'){
				$sql = 'teclado';
			}else if($fileName == 'tabletsIpads'){
				$sql = [ 'tablet', 'ipad' ];
			}else if($fileName == 'memorias'){
				$sql = [ 'memória ram', 'memória rom' ];
			}else{
				$sql = null;
			}

			return $sql;
		}
	}
?>