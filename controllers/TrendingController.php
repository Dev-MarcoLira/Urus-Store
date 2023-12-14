<?php

    class TrendingController{

        public static function view(){
            $sql = "WHERE is_highlighted = 1 AND is_active = 1";
            $numOfProducts = ProductModel::selectProduct('*', $sql)->rowCount();

            $productsPerPage = 9;

            $totalPages = Paginator::calcNumOfPages($numOfProducts, $productsPerPage);
            $limit = Paginator::calcLimit($productsPerPage, $numOfProducts);

            $sql .= $limit;

            $products = ProductModel::selectProduct('*', $sql);

            include(PATH_VIEWS.'trending.php');
        }

    }

?>