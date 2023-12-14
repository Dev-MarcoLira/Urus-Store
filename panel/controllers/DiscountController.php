<?php

    class DiscountController{

        public function create(){
            if(isset($_POST['createDiscount'])){

                [,$name, $description, $type, $value] = $this->getInputs();

                $createdAt = $this->createDiscount($name, $description, $type, $value);

                if($createdAt){
                    $_SESSION['discount_success'] = 'Desconto criado!';
                    Login::redirect(FULL_PATH_ESTOQUE.'discounts');
                }else{
                    Login::redirect(FULL_PATH_ESTOQUE.'discount/create');
                }
            }else{

                Login::redirect(FULL_PATH_PANEL);
            }
        }
            
        public function edit(){
            
            if(isset($_POST['editDiscount'])){

                [$id, $name,$description, $type, $value] = $this->getInputs();

                $updatedAt = $this->editDiscount($name, $description, $type, $value);

                if($updatedAt){
                    $_SESSION['discount_success'] = 'Desconto atualizado com sucesso!';
                    Login::redirect(FULL_PATH_ESTOQUE.'discounts');
                }else{
                    $_SESSION['discount_error'] = 'Não foi possível atualizar o desconto!';
                    Login::redirect(FULL_PATH_ESTOQUE."discount?id=$id");
                }
            }else{

                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function enable(){

            if(isset($_GET['id'])){

                try{
                    $id = $_GET['id'];

                    if(DiscountModel::enable($id)){
                        $_SESSION['discount_success'] = "Desconto ativado!";
                        Login::redirect(FULL_PATH_ESTOQUE."discounts");
                    }else{
                        $_SESSION['discount_error'] = "Não foi possível ativar o desconto!";
                        Login::redirect(FULL_PATH_ESTOQUE."discounts");
                    }
                }catch(Throwable $error){
                    $_SESSION['discount_error'] = "Não foi possível ativar o desconto!";
                    Login::redirect(FULL_PATH_ESTOQUE.'discounts');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function disable(){

            if(isset($_GET['id'])){

                try{
                    $id = $_GET['id'];

                    if(DiscountModel::disable($id)){
                        
                        if(!DiscountModel::deleteDiscountProduct("where discount_id = $id")){
                            $_SESSION['discount_error'] = "Não foi possível desativar o desconto!";
                            return false;
                        }
                        
                        $_SESSION['discount_success'] = "Desconto desativado!";
                        Login::redirect(FULL_PATH_ESTOQUE."discounts");
                    }else{
                        $_SESSION['discount_error'] = "Não foi possível desativar o desconto!";
                        Login::redirect(FULL_PATH_ESTOQUE."discounts");
                    }
                }catch(Throwable $error){
                    $_SESSION['discount_error'] = "Não foi possível desativar o desconto!";
                    Login::redirect(FULL_PATH_ESTOQUE."discounts");
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function delete(){

            if(isset($_GET['id'])){

                $id = $_GET['id'];
                
                $deletedAt = DiscountModel::deleteDiscountProduct("where discount_id = $id");
                $deletedAt = DiscountModel::deleteDiscount("where id = $id");

                if($deletedAt){
                    Login::redirect(FULL_PATH_ESTOQUE);
                }else{
                    Login::redirect(FULL_PATH_ESTOQUE.'discounts');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            } 
        }

        /*public function deleteByProduct(){
            
            if(isset($_GET['id'])){

                $id = $_GET['id'];
    
                $productId = isset($_GET['productId']) ? $_GET['productId'] : null;
                
                $deletedAt = DiscountModel::deleteDiscountProduct("where discount_id = $id and product_id = $productId");
    
                if($deletedAt){
                    echo "<script>history.back();</script>";
                }else{
                    echo 'Cannot delete the discount!!';
                }
            }else{

                Login::redirect(FULL_PATH_PANEL);
            }
        }*/
        
        public function index(){

            if(isset($_GET['id'])){

                $id = $_GET['id'];

                $discounts = DiscountModel::selectDiscount('*', "where id = $id");
                $discount = '';

                foreach($discounts as $disc)
                    $discount = $disc;

                $type = $discount['type'];

                include(PATH_ESTOQUE. 'editDiscount.php');
            }else{

                Login::redirect(FULL_PATH_PANEL.'estoque');
            }
        }

        public function viewCreate(){
            $discounts = DiscountModel::selectDiscount('*', '');
            $discountTypes = DiscountModel::selectDiscountType('*', '');

            include(PATH_ESTOQUE.'createDiscount.php');
        }

        /* functions */

        private function getInputs(){
            
            $id = !empty($_POST['id']) ? $_POST['id'] : 'null';
            $name = !empty($_POST['dName']) ? $_POST['dName'] : null;
            $description = !empty($_POST['dDescription']) ? $_POST['dDescription'] : null;
            $type = !empty($_POST['dType']) ? $_POST['dType'] : 'null';
            $value = !empty($_POST['dValue']) ? $_POST['dValue'] : 'null';

            return [$id, $name, $description, $type, $value];

        }

        private function createDiscount($name, $desc, $type, $value){

            $name = strtolower($name);

            return DiscountModel::createDiscount($name, $desc, $type, $value);
        }

        private function editDiscount($name, $desc, $type, $value){

            $id = $_POST['id'];
            $name = strtolower($name);

            return DiscountModel::updateDiscount($name, $desc, $type, $value, "where id = $id");
        }
    }
?>