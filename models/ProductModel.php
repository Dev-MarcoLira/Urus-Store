<?php

	/**
	 * 
	 */
	class ProductModel
	{
		
		private static $productsTable = 'products';

		private static $productsFields = 'name, description, category_id, mark_id, price, promotion_price, amount, massa, altura, largura, comprimento';
		private static $inventoryFields = 'is_limited, is_active, is_init_page, is_highlighted';

		private static $variationsTable = 'product_variations';

		public static function createProduct($name, $description, $category, $mark, $price, $promoPrice, $amount, $massa, $altura, $largura, $comprimento){
			
			$values = "'$name', '$description', $category, $mark, $price, $promoPrice, $amount, $massa, $altura, $largura, $comprimento";

			return MySQL::getLastInsertId(self::$productsTable, self::$productsFields, $values);

		}

		public static function insertInventoryOptions($productId, $isLimited, $isHighlighted, $isInitPage){

			$where = "WHERE id = $productId";
			$columns = "SET is_limited = $isLimited, is_active = 1, is_highlighted = $isHighlighted, is_init_page = $isInitPage";
			echo $columns;
			return MySQL::update(self::$productsTable, $columns, $where);
		}


		public static function selectProduct($columns, $where){

			return MySQL::select($columns, self::$productsTable, $where);

		}

		public static function getVariations($columns, $productId){
			$where = "WHERE product_id = $productId";

			return MySQL::select($columns, self::$variationsTable, $where);
		}

		public static function setAmount($productId, $amount){
			$columns = "SET amount = $amount";
			$where = "WHERE id = $productId";

			return MySQL::update(self::$productsTable, $columns, $where);
		}

		public static function getAmount($id){
			foreach(self::selectProduct('amount', "WHERE id = $id") as $amount){
					return $amount[0];
			}
		}

		public static function getLogoName($productId){
			$where = "product_id = $productId AND order_number = 1";
			foreach(ImageModel::selectImage('name', $where) as $logo){
				return $logo[0];
			}
		}

		public static function getPrice($productId){
			
			$where = "WHERE id = $productId";

			foreach(MySQL::select('price', self::$productsTable, $where) as $price) return $price;

		}

		public static function updateProduct($name, $description, $category, $mark, $price, $promoPrice, $amount, $massa, $altura, $largura, $comprimento, $where){
			$columns = "set name = '$name', description = '$description', category_id = $category, mark_id = $mark , price = $price, promotion_price = $promoPrice, amount = $amount, massa = $massa, altura = $altura, largura = $largura, comprimento = $comprimento";
			echo $columns;
			return MySQL::update(self::$productsTable, $columns, $where);
		}

		public static function enable($id){
			$columns = "SET is_active = 1";

			return MySQL::update(self::$productsTable, $columns, "WHERE id = $id");
		}

		public static function disable($id){
			$columns = "SET is_active = 0";

			return MySQL::update(self::$productsTable, $columns, "WHERE id = $id");
		}

		public static function deleteProduct($where){
			return MySQL::delete(self::$productsTable, $where);
		}

		public static function getPromotionPrice($productId, $originalPrice){

			$promotionPrice = self::getPromotion($productId)[0];
			
			$discountsByProduct = DiscountModel::selectDiscountProduct('*', "WHERE product_id = ".$productId);
			$discountedPrice = $promotionPrice > 0 ? $promotionPrice : $originalPrice;
	
			foreach($discountsByProduct as $discountByProduct){
	
				$discountId = $discountByProduct['discount_id'];
				$discounts = DiscountModel::selectDiscount('*', "WHERE id = $discountId");
				
				foreach($discounts as $discount)
					$discountedPrice = self::getDiscountedPrice($discount, $discountedPrice);
				
			}

			return $discountedPrice;
		}

		private static function getDiscountedPrice($discount, $price){

			if($discount['type'] == 'preco'){
	
				$discountedPrice = $price - $discount['discount'];
	
			}else if($discount['type'] == 'porcen'){
	
				$rate = ($discount['discount']/100) * $price;
	
				$discountedPrice = $price - $rate;
			}
	
			return $discountedPrice;
		}

		private static function getPromotion($productId){

			foreach(self::selectProduct('promotion_price', "WHERE id = $productId") as $promotionPrice) return $promotionPrice;
		}

		public static function checkInitPage($id){
			foreach(self::selectProduct('*', "WHERE id = $id") as $product){
				return $product['is_init_page'];
			}
		}

		public static function checkInventoryType($id){
			foreach(self::selectProduct('is_limited', "WHERE id = $id") as $product){
				return $product[0];
			}
		}

		public static function checkTrending($id){
			foreach(self::selectProduct('*', "WHERE id = $id") as $product){
				return $product['is_highlighted'];
			}
		}

		public static function controlDiscountTime($productId){

			$sql = "SELECT a.expiry_date FROM discounts_products AS a WHERE a.product_id = $productId";
			$now = date('Y-m-d H:i:s');
			foreach(MySQL::freeSelect($sql) as $date){
				if($date[0] <= $now){
					DiscountModel::deleteDiscountProduct("WHERE product_id = $productId");
				}else
					continue;
				
			}

		}

	}
?>