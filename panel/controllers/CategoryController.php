<?php

    class CategoryController{

        function create(){
            if(isset($_POST['createCategory'])){

                [, $name, $description] = $this->getInputs();
                
                $createdAt = $this->createCategory($name, $description);

                if($createdAt){
                    $_SESSION['category_success'] = 'Categoria criada!';
                    Login::redirect(FULL_PATH_ESTOQUE.'categories');
                }else{
                    $_SESSION['category_error'] = 'Não foi possível criar a categoria!';
                    Login::redirect(FULL_PATH_ESTOQUE.'category/create');
                }
            }else{

                Login::redirect(FULL_PATH_PANEL);
            }
        }

        function edit(){
            if(isset($_POST['editCategory'])){

                [$id, $name, $description] = $this->getInputs();

                $updatedAt = $this->editCategory($id, $name, $description);

                if($updatedAt){
                    $_SESSION['category_success'] = 'Categoria atualizada com sucesso!';
                    Login::redirect(FULL_PATH_ESTOQUE.'categories');
                }else{
                    Login::redirect(FULL_PATH_ESTOQUE."category?id=$id");
                }
            }else{

                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function enable(){

            if(isset($_GET['id'])){

                try{
                    $id = $_GET['id'];

                    if(CategoryModel::enable($id)){
                        $_SESSION['category_success'] = 'Categoria ativada!';
                        Login::redirect(FULL_PATH_ESTOQUE."categories");
                    }else{
                        $_SESSION['category_error'] = 'Não foi possível ativar a categoria!';
                        Login::redirect(FULL_PATH_ESTOQUE."categories");
                    }
                }catch(Throwable $error){
                    $_SESSION['category_error'] = 'Não foi possível ativar a categoria!';
                    Login::redirect(FULL_PATH_ESTOQUE.'categories');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function disable(){

            if(isset($_GET['id'])){

                try{
                    $id = $_GET['id'];

                    if(CategoryModel::disable($id)){
                        $_SESSION['category_success'] = 'Categoria desativada!';
                        Login::redirect(FULL_PATH_ESTOQUE."categories");
                    }else{
                        $_SESSION['category_error'] = 'Não foi possível desativar a categoria!';
                        Login::redirect(FULL_PATH_ESTOQUE."categories");
                    }
                }catch(Throwable $error){
                    $_SESSION['category_error'] = 'Não foi possível desativar a categoria!';
                    Login::redirect(FULL_PATH_ESTOQUE.'categories');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        function delete(){

            if(isset($_GET['id'])){

                $id = $_GET['id'];

                $deletedAt = CategoryModel::deleteCategory("where id = $id");

                if($deletedAt)
                    Login::redirect(FULL_PATH_ESTOQUE);
            }else{

                Login::redirect(FULL_PATH_PANEL);
            }
        }

        function index(){

            if(isset($_GET['id'])){

                $id = $_GET['id'];
                $categories = CategoryModel::selectCategory('*', "where id = $id");

                foreach($categories as $cat)
                    $category = $cat;

                include(PATH_ESTOQUE. 'editCategory.php');

            }else{

                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function viewCreate(){
            $categories = CategoryModel::selectCategory('*', '');

            include(PATH_ESTOQUE.'createCategory.php');
        }


        /* Functions */

        private function getInputs(){
            $id = !empty($_POST['id']) ? $_POST['id'] : 'null';
            $name = !empty($_POST['cName']) ? $_POST['cName'] : null;
            $description = !empty($_POST['cDesc']) ? $_POST['cDesc'] : null;

            return [ $id, $name, $description ];
        }

        private function createCategory($name, $desc){

            $name = strtolower($name);
            $desc = strtolower($desc);

            return CategoryModel::createCategory($name, $desc);
        }

        private function editCategory($id, $name, $desc){

            $name = strtolower($name);
            $desc = strtolower($desc);

            return CategoryModel::updateCategory($name, $desc, "where id = $id");
        }

    }
?>