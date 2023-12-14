<?php


    class DiscountModel{

        private static $discountTable = "discounts";
        private static $discountFields = "name, description, type, discount";

        private static $discountProductTable = "discounts_products";
        private static $discountProductFields = "product_id, discount_id, expiry_date";


        public static function createDiscount($name, $description, $discountType, $discount){
            $values = "'$name', '$description', '$discountType', $discount";

            return MySQL::insert(self::$discountTable, self::$discountFields, $values);
        }

        public static function selectDiscount($columns, $where){
            return MySQL::select($columns, self::$discountTable, $where);
        }

        public static function updateDiscount($name, $description, $discountType, $discount, $where){
            $columns = "SET name = '$name', description = '$description', type = '$discountType', discount = $discount";

            return MySQL::update(self::$discountTable, $columns, $where);
        }

        public static function enable($id){
			$columns = "SET is_active = 1";

			return MySQL::update(self::$discountTable, $columns, "WHERE id = $id");
		}

		public static function disable($id){
			$columns = "SET is_active = 0";

			return MySQL::update(self::$discountTable, $columns, "WHERE id = $id");
		}

        public static function deleteDiscount($where){
            return MySQL::delete(self::$discountTable, $where);
        }

        public static function selectDiscountType($where){
            return MySQL::select('type', self::$discountTable, $where);
        }

        public static function createDiscountProduct($product_id, $discount_id, $expiryDate){
            
            $date = date('Y-m-d H:i:s', strtotime($expiryDate));
            $values = "$product_id, $discount_id, '$date'";
            echo $date;
            return MySQL::insert(self::$discountProductTable, self::$discountProductFields, $values);
        }

        public static function selectDiscountProduct($columns, $where){

            return MySQL::select($columns, self::$discountProductTable, $where);
        }

        public static function updateDiscountProduct($product_id, $discount_id, $where){
            
            $date = date('Y-m-d H:i:s', strtotime($expiryDate));
            $columns = "SET product_id = $product_id, discount_id = $discount_id";

            return MySQL::update(self::$discountProductTable, $columns, $where);
        }

        public static function deleteDiscountProduct($where){
            return MySQL::delete(self::$discountProductTable, $where);
        }
    }

?>