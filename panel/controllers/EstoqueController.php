<?php

    class EstoqueController{

        public function index(){

            $products = ProductModel::selectProduct('id', '')->rowCount();;
            $categories = CategoryModel::selectCategory('id', '')->rowCount();;
            $discounts = DiscountModel::selectDiscount('id', '')->rowCount();;
            $marks = MarkModel::selectMark('id', '')->rowCount();

            include(PATH_ESTOQUE.'estoque.php');
        }

        public function viewProducts(){
            $products = ProductModel::selectProduct('*', ''); 

            include(PATH_ESTOQUE.'products.php');
        }
        
        public function viewCategories(){
            $categories = CategoryModel::selectCategory('*', '');

            include(PATH_ESTOQUE.'categories.php');
        }

        public function viewMarks(){
            $marks = MarkModel::selectMark('*', '');

            include(PATH_ESTOQUE.'marks.php');
        }

        public function viewDiscounts(){
            $discounts = DiscountModel::selectDiscount('*', '');
            $discountTypes = DiscountModel::selectDiscountType('*', '');

            include(PATH_ESTOQUE.'discounts.php');
        }

    }
?>