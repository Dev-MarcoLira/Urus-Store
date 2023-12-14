<?php

	class ProductController{
		/* Include views */

		public function view(){

			if(isset($_GET['productId'])){
				$id = $_GET['productId'];

				$product = ProductModel::selectProduct('*', 'where id = '.$id);

				foreach($product as $prod)
					$product = $prod;

				$category = CategoryModel::selectCategory('*', 'where id = '.$product['category_id']);
				$mark = MarkModel::selectMark('*', 'where id = '.$product['mark_id']);

				foreach($category as $cat)
					$category = $cat;
				
				foreach($mark as $mrk)
					$mark = $mrk;

				include(PATH_VIEWS. "product.php");
			}else{
				
			}
		}
	}
?>