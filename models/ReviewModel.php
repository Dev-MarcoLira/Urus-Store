<?php

    class ReviewModel{

        private static $reviewTable = 'product_reviews';
        private static $reviewFields = 'user_id, product_id, rank';

        public static function insertReview($userId, $productId, $rank){

            if(!self::deleteReview("WHERE user_id = $userId AND product_id = $productId")) return false;

            $values = "$userId, $productId, $rank";

            return MySql::insert(self::$reviewTable, self::$reviewFields, $values);
        }

        public static function selectReview($columns, $where){
            return MySQL::select($columns, self::$reviewTable, $where);
        }

        public static function getRank($where){
            return MySQL::select('rank', self::$reviewTable, $where);
        }

        public static function getProductReview($productId){

            $rank = MySQL::select('rank, comment', self::$reviewTable, "WHERE product_id = $productId");

            foreach($rank as $rk) return $rk;
        }

        public static function disableReview($id){
            $query = "SET rank = 0";

            return MySql::update(self::$reviewTable, $query, "WHERE id = $id");
        }

        public static function deleteReview($where){

            return MySQL::delete(self::$reviewTable, $where);
        }

    }
?>