<?php

    class CartController{

        /* Route validations  */

        public function add(){

            if(isset($_POST['addProduct'])){
                
                // Atualizar banco de dados
                $inserted = $this->updateCart();
                
                if($inserted){
                    $_SESSION['product_success'] = 'Produto adicionado ao carrinho!';
                    Login::redirect(FULL_PATH_SITE);
                }else{
                    $_SESSION['product_error'] = 'Não foi possível adicionar o produto ao carrinho!';
                    Login::redirect(FULL_PATH_SITE);
                }
                
            }else{
                Login::redirect(FULL_PATH_SITE);
            }

        }
        
        public function setAmount(){
            $setted = $this->changeAmount();
            if($setted){
                Login::redirect(FULL_PATH_SITE.'cart');
            }else{
                Login::redirect(FULL_PATH_SITE);
            }
        }

        public function delete(){

            $deletedAt = $this->deleteProducts();

            if($deletedAt){
                Login::redirect(FULL_PATH_SITE.'cart');
            }else{
                Login::redirect(FULL_PATH_SITE.'cart');
            }

        }

        /* Include views  */

        public function view(){
            include(PATH_VIEWS.'cart.php');
        }

        /* Functions  */

        public function APIupdateCart(){
            $email = $_SESSION['login'];
            $user = MySQL::select('*', "users","where email = '$email'");
            foreach($user as $usr)
                $userId = $usr['id'];


            $productId = json_decode($_POST['productId']);
            $amount = json_decode($_POST['cartAmount']);
            $price = json_decode($_POST['productPrice']);

            $totalPrice = $price * $amount;


            if(!$this->checkCartItem($userId, $productId)){
                header('HTTP/1.1 500 Internal Server Error; Content-Type: application/json; charset=utf-8; Access-Control-Allow-Origin: *; Access-Control-Allow-Methods: GET, POST, OPTIONS');
                echo json_encode(new Error());
            }

            if(CartModel::createCartItem($userId, $productId, $amount, $totalPrice)){
                header('HTTP/1.1 200 Internal Server Error; Content-Type: application/json; charset=utf-8; Access-Control-Allow-Origin: *; Access-Control-Allow-Methods: GET, POST, OPTIONS');
                echo json_encode(['status'=>'ok']);
            }
            
        }

        private function updateCart(){

            $userId = Login::getId();

            $productId = (int)($_POST['productId']);
            $amount = (int)($_POST['cartAmount']);
            $price = $_POST['productPrice'];

            $totalPrice = $price * $amount;


            $valid = $this->checkCartItem($userId, $productId);
            if(!$valid){
                $_SESSION['product_error'] = 'Este produto já está no carrinho!';
                return false;
            }


            if(CartModel::createCartItem($userId, $productId, $amount, $totalPrice))
                return true;
            

            return false;

        }

        private function checkCartItem($userId, $productId){
            $productsByUser = CartModel::selectCartItem('*', "where user_id = $userId and product_id = $productId");

            if($productsByUser->rowCount() > 0){
                return false;
            }

            return true;
        }

        private function changeAmount(){

            $productId = $_GET['productId'];
            $amount = !empty($_GET['amount']) ? $_GET['amount'] : 1;

            return CartModel::updateAmount($amount, "WHERE product_id = $productId");
        }


        private function deleteProducts(){

            if(isset($_POST['productsIds'])){

                $productsIds = $_POST['productsIds'];

            }else{
                return false;
            }

            foreach($productsIds as $id){

                if(!CartModel::deleteCartItem("WHERE product_id = $id")) return false;

            }

            return true;
        }
    }
?>