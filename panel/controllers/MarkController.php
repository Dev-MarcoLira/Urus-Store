<?php

    class MarkController{

        function create(){
            if(isset($_POST['createMark'])){

                $name = $_POST['name'];

                $createdAt = $this->createMark($name);

                if($createdAt){
                    $_SESSION['mark_success'] = 'Marca criada!';
                    Login::redirect(FULL_PATH_ESTOQUE.'marks');
                }else{
                    Login::redirect(FULL_PATH_ESTOQUE.'marca/create');
                }
            }else{

                Login::redirect(FULL_PATH_PANEL);
            }
        }

        function edit(){

            if(isset($_POST['editMark'])){
                $id = $_POST['id'];
                if($this->updateMark() == true){
                    $_SESSION['mark_success'] = 'Marca atualizada com sucesso!';
                    Login::redirect(FULL_PATH_ESTOQUE.'marks');
                }else{
                    Login::redirect(FULL_PATH_ESTOQUE."marca?id=$id");
                }

            }else{

                Login::redirect(FULL_PATH_PANEL);
            }

        }

        public function enable(){

            if(isset($_GET['id'])){

                try{
                    $id = $_GET['id'];

                    if(MarkModel::enable($id)){
                        $_SESSION['mark_success'] = "Marca ativada!";
                        Login::redirect(FULL_PATH_ESTOQUE."marks");
                    }else{
                        $_SESSION['mark_error'] = "Não foi possível ativar a marca!";
                        Login::redirect(FULL_PATH_ESTOQUE."marks");
                    }
                }catch(Throwable $error){
                    $_SESSION['mark_error'] = "Não foi possível ativar a marca!";
                    Login::redirect(FULL_PATH_ESTOQUE.'marks');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function disable(){

            if(isset($_GET['id'])){

                try{
                    $id = $_GET['id'];

                    if(MarkModel::disable($id)){
                        $_SESSION['mark_success'] = "Marca desativada!";
                        Login::redirect(FULL_PATH_ESTOQUE."marks");
                    }else{
                        $_SESSION['mark_error'] = "Não foi possível desativar a marca!";
                        Login::redirect(FULL_PATH_ESTOQUE."marks");
                    }
                }catch(Throwable $error){
                    $_SESSION['mark_error'] = "Não foi possível desativar a marca!";
                    Login::redirect(FULL_PATH_ESTOQUE.'marks');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        function delete(){

            if(isset($_GET['id'])){

                $id = $_GET['id'];

                if(MarkModel::deleteMark("WHERE id = $id")){

                    Login::redirect(FULL_PATH_ESTOQUE);
                }else{
                    Login::redirect(FULL_PATH_ESTOQUE.'marks');
                }

            }else{

                Login::redirect(FULL_PATH_PANEL);
            }

        }

        function index(){
            
            if(isset($_GET['id'])){

                $id = $_GET['id'];
                include(PATH_ESTOQUE.'editMark.php');

            }else{

                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function viewCreate(){
            $marks = MarkModel::selectMark('*', '');

            include(PATH_ESTOQUE.'createMark.php');
        }

        /* functions */

        private function createMark($name){

            if(Sanitizer::validateNumberInput($name))
                return false;

            if($this->checkMark($name, 0) == true)
                return false;

            return MarkModel::createMark($name);
        }

        private function checkMark($name, $number){
            $name = strtolower($name);
            if(MarkModel::selectMark('*', "WHERE name = '$name'")->rowCount() > $number)
                return true;
            

            return false;
        }

        private function updateMark(){

            $id = $_POST['id'];
            $name = $_POST['name'];

           /* if(!Sanitizer::validateNumberInput($name))
                return false;

            if($this->checkMark($name, 1) == true)
                return false;          
*/          
            
            return MarkModel::updateMark($name, "WHERE id = $id");

        }
    }
?>