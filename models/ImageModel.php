<?php

    class ImageModel{

        private static $imagesTable = "products_images";
        private static $imagesFields = "product_id, name, order_number";

        public static function createImage($product_id, $name, $order){

            $values = "$product_id, '$name', $order";
            
            return MySQL::insert(self::$imagesTable, self::$imagesFields, $values);
        }

        public static function selectImage($columns, $where){
            return MySQL::select($columns, self::$imagesTable, $where);
        }

        public static function updateImage($product_id, $name, $where){
            $columns = "set product_id = $product_id, name = '$name'";

            return MySQL::update(self::$imagesTable, $columns, $where);
        }

        public static function deleteImage($product_id, $order){
            $where = "where product_id = $product_id and order_number = $order";

            return MySQL::delete(self::$imagesTable, $where);
        }

        public static function deleteImageById($id){
            return MySQL::delete(self::$imagesTable, "where id = $id");
        }

        public static function deleteImageByProductId($id){
            return MySQL::delete(self::$imagesTable, "where product_id = $id");
        }

    }
?>