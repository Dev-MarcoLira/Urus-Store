<?php

    class CartModel{
    
        private static $cartTable = "cart_products";
        private static $cartFields = "user_id, product_id, amount, total_price";


        public static function createCartItem($userId, $productId, $amount, $totalPrice){

            $values = "$userId, $productId, $amount, $totalPrice";

            return MySQL::insert(self::$cartTable, self::$cartFields, $values);

        }

        public static function selectCartItem($columns, $where){

            return MySQL::select($columns, self::$cartTable, $where);
        }

        public static function getQuantity($productId){

            $where = "WHERE product_id = $productId";

            foreach(MySQL::select('amount', self::$cartTable, $where) as $quantity) return $quantity;

        }

        public static function updateAmount($amount, $where){
            $sql = "SET amount = $amount";
            
            return MySQL::update(self::$cartTable, $sql, $where);
        }

        public static function deleteCartItem($where){
            return MySQL::delete(self::$cartTable, $where);
        }

    }


?>