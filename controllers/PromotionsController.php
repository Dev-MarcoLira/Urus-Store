<?php

    class PromotionsController{

        public static function view(){

            $sql = "SELECT DISTINCT a.* FROM products AS a LEFT JOIN discounts_products AS b ON (a.id = b.product_id OR a.promotion_price > 0) AND a.is_active = 1";
            $numOfProducts = MySQL::freeSelect($sql)->rowCount();

            $productsPerPage = 9;

            $totalPages = Paginator::calcNumOfPages($numOfProducts, $productsPerPage);
            $limit = Paginator::calcLimit($productsPerPage, $numOfProducts);

            $sql .= $limit;

            $products = MySQL::freeSelect($sql);

            include(PATH_VIEWS.'promotions.php');
        }
    }

?>