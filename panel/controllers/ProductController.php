<?php
    
    class ProductController{

        public function create(){

            if(isset($_POST['createProduct'])){

                $insertedAt = $this->createProduct();

                if($insertedAt){
                    $_SESSION['product_success'] = "Produto criado!";
                    Login::redirect(FULL_PATH_ESTOQUE.'products');    
                }else{
                    $_SESSION['product_error'] = "Não foi possível criar o produto!";
                    Login::redirect(FULL_PATH_ESTOQUE.'product/create');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function edit(){
            if(isset($_POST['editProduct'])){

                $updatedAt = $this->updateProduct();
                $id = $_POST['id'];
                if($updatedAt == true){
                    $_SESSION['product_success'] = "Produto atualizado!";
                    ProductModel::enable($id);
                    Login::redirect(FULL_PATH_ESTOQUE."products");
                }else{
                    $_SESSION['product_error'] = "Não foi possível editar o produto!";
                    Login::redirect(FULL_PATH_PANEL."product?id=$id");
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);

            }
        }
        
        public function delete(){
            if(isset($_GET['id'])){

                $id = $_GET['id'];

                try{

                    CartModel::deleteCartItem("WHERE product_id = $id");
                    DiscountModel::deleteDiscountProduct("WHERE product_id = $id");

                    if(!ProductModel::deleteProduct("WHERE id = $id")) throw new Throwable;

                    ImageModel::deleteImageByProductId($id);
                    Image::deleteDirectory(PATH_UPLOAD."products/$id");

                    $_SESSION['product_success'] = "Produto deletado!";
                    Login::redirect(FULL_PATH_ESTOQUE.'products');

                }catch(Throwable $error){
                    $_SESSION['product_error'] = "Não foi possível remover o produto!";
                    Login::redirect(FULL_PATH_ESTOQUE."product?id=$id");
                }

            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function enable(){

            if(isset($_GET['id'])){

                try{
                    $id = $_GET['id'];

                    if(ProductModel::enable($id)){
                        $_SESSION['product_success'] = 'Produto ativado!';
                    }else{
                        $_SESSION['product_error'] = 'Não foi possível ativar o produto!';
                    }

                    Login::redirect(FULL_PATH_ESTOQUE."products");
                }catch(Throwable $error){
                    $_SESSION['product_error'] = 'Não foi possível ativar o produto!';
                    Login::redirect(FULL_PATH_ESTOQUE.'products');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function disable(){

            if(isset($_GET['id'])){

                try{
                    $id = $_GET['id'];

                    if(ProductModel::disable($id)){
                        $_SESSION['product_success'] = 'Produto desativado!';
                    }else{
                        $_SESSION['product_error'] = 'Não foi possível desativar o produto!';
                    }

                    Login::redirect(FULL_PATH_ESTOQUE.'products');
                }catch(Throwable $error){
                    $_SESSION['product_error'] = 'Não foi possível desativar o produto!';
                    Login::redirect(FULL_PATH_ESTOQUE.'products');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        /* Include views */

        public function index(){

            if(isset($_GET['id'])){

                function checkInitPage($id){
                    $isInitPage = ProductModel::checkInitPage($id);

                    if($isInitPage == true)
                        return 'checked';
                    
                    return;
                }

                function checkAmount($inventory, $id){
                    $isLimited = ProductModel::checkInventoryType($id);

                    if($isLimited == true){
                        if($inventory == 'limited')
                            return 'checked';
                    }else{
                        if($inventory == 'unlimited')
                            return 'checked';                        
                    }

                    return;
                }

                function checkTrending($id){
                    $isTrending = ProductModel::checkTrending($id);

                    if($isTrending == true)
                        return 'checked';

                    return;
                }


                include(PATH_ESTOQUE.'editProduct.php');
            }else{

                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function viewCreate(){

            $products = ProductModel::selectProduct('*', ''); 
            $categories = CategoryModel::selectCategory('*', 'WHERE is_active = 1');
            $marks = MarkModel::selectMark('*', 'WHERE is_active = 1');
            $discounts = DiscountModel::selectDiscount('*', 'WHERE is_active = 1');
            $discountTypes = DiscountModel::selectDiscountType('*', '');

            include(PATH_ESTOQUE.'createProduct.php');
        }

        /* functions */

        private function getInputs(){

            $id = !empty($_POST['id']) ? $_POST['id'] : '';
            $name = !empty($_POST['name']) ? $_POST['name'] : '';
            $desc = !empty($_POST['desc']) ? $_POST['desc'] : '';
            $category_id = !empty($_POST['category']) ? $_POST['category'] : '';
            $mark_id = !empty($_POST['mark']) ? $_POST['mark'] : 'null';
            $price = !empty($_POST['price']) ? $_POST['price'] : '';
            $promoPrice = !empty($_POST['promoPrice']) ? $_POST['promoPrice'] : 'DEFAULT';
            $amount = !empty($_POST['amount']) ? $_POST['amount'] : 'DEFAULT';
            $massa = !empty($_POST['massa']) ? $_POST['massa'] : 'DEFAULT';
            $altura = !empty($_POST['altura']) ? $_POST['altura'] : 'DEFAULT';
            $largura = !empty($_POST['largura']) ? $_POST['largura'] : 'DEFAULT';
            $comprimento = !empty($_POST['comprimento']) ? $_POST['comprimento'] : 'DEFAULT';

            return [ $id, $name, $desc, $category_id, $mark_id, 
            $price, $promoPrice, $amount, $massa, $altura, $largura, $comprimento ];

        }

        private function createProduct(){
            [
                ,
                $name,
                $desc,
                $category_id,
                $mark_id,
                $price,
                $promoPrice,
                $amount,
                $massa,
                $altura,
                $largura,
                $comprimento
            ] = $this->getInputs();

            $productId = ProductModel::createProduct($name, $desc, $category_id, $mark_id, $price, $promoPrice, $amount, $massa, $altura, $largura, $comprimento);
            $path = PATH_UPLOAD."products/$productId/";

            $this->createFolder($path);

            if(!$this->manageInventory($productId)) return false;

            if(!$this->handleImage($productId, $path)) return false;
            
            if(!$this->handleDiscount($productId)) return false;

            return true;
        }

        private function updateProduct(){
            [
                $id,
                $name,
                $desc,
                $category_id,
                $mark_id,
                $price,
                $promoPrice,
                $amount,
                $massa,
                $altura,
                $largura,
                $comprimento,
            ] = $this->getInputs();

            $path = PATH_UPLOAD."products/$id/";

            /*Editar disconto(s) a produto*/
            if(!$this->handleDiscount($id)) return false;
            
            /*Editar imagens do produto*/
            if(!$this->handleImage($id, $path)) return false;

            if(!$this->manageInventory($id)) return false;
            echo $amount;
            return ProductModel::updateProduct($name, $desc, $category_id, $mark_id, $price, $promoPrice, $amount, $massa, $altura, $largura, $comprimento, "where id = $id");
        }

        private function manageInventory($id){
            $isLimited = $_POST['isLimited'] == 0 ? '0' : '1';
            $isHighlighted = isset($_POST['isHighlighted']) ? '1' : 'DEFAULT';
            $isInitPage = isset($_POST['isInitPage']) ? '1' : 'DEFAULT';

            if($isLimited == '0'){
                ProductModel::setAmount($id, '1');
            }

            return ProductModel::insertInventoryOptions($id, $isLimited, $isHighlighted, $isInitPage);
        }

        /* Image and Discounts */

        private function createFolder($path){
            if(mkdir($path))
                return true;

            return false;
        }

        private function handleImage($productId, $path){
            for($i = 1; $i < 5; $i++){

                if(isset($_FILES["image$i"])){
                    $image = $_FILES["image$i"];
                    if(!$this->setImage($productId, $i, $image, $path)) return false;
                }
            }

            return true;
        }


        private function setImage($productId, $counter, $image, $path){
            
            $name = $image['name'];
            $where = "where order_number = $counter and product_id = $productId";        

            if(!empty($name)){

                $imagesByProduct = ImageModel::selectImage("*", $where);
                
                if($imagesByProduct->rowCount() > 0){

                    if(!ImageModel::updateImage($productId, $name, $where)) return false;

                }else{

                    if(!Image::uploadImage("image$counter", $path)){ 
                        $_SESSION['image_error'] = 'Não foi possível upar a imagem!';
                        return false;
                    }
                    if(!ImageModel::createImage($productId, $name, $counter)){ 
                        $_SESSION['image_error'] = 'Erro ao salvar a imagem!';
                        return false;
                    }
                    
                }
            }
            
            return true;
        }
        
        private function handleDiscount($productId){
            
            if(isset($_POST['discount'])){
                
                $discounts = $_POST['discount'];
                
                foreach($discounts as $discount){
                    
                    if(!empty($discount)){
                        $where = "WHERE product_id = $productId AND discount_id = $discount";
                        $discountByProduct = DiscountModel::selectDiscountProduct('*', $where);
                        if($discountByProduct->rowCount() > 0){

                            if(!$this->updateDiscountByProduct($productId, $discount)) return false;
                        }else{
                            
                            if(!DiscountModel::createDiscountProduct($productId, $discount, $_POST['expiryDate'])) return false;
                        }
                    }else continue;
                }
            }        

            return true;
        }

        private function updateDiscountByProduct($productId, $discountId){

            $where = "WHERE product_id = $productId and discount_id = $discountId";

            $updatedAt = DiscountModel::updateDiscountProduct($productId, $discountId, $where);
            if(!$updatedAt) return false;

            return true;
        }

    }
?>