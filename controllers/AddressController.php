<?php

    class AddressController{

        public function addAddress(){
            if($this->createAddress()){
                $_SESSION['address_success'] = 'Endereço criado!';
                Login::redirect(FULL_PATH_ACCOUNT);
            }else{
                Login::redirect(FULL_PATH_ACCOUNT);
            }
        }

        public function editAddress(){
            if($this->modifyAddress()){
                $_SESSION['address_success'] = 'Endereço editado!';
                Login::redirect(FULL_PATH_ACCOUNT);
            }else{
                $_SESSION['address_error'] = 'Não foi possível editar esse endereço!';
                Login::redirect(FULL_PATH_ACCOUNT);
            }
        }

        public function delete(){
            if(isset($_GET['addressId'])){
                if(UserAddressModel::deleteAddress($_GET['addressId'])){
                    $_SESSION['address_success'] = 'Endereço deletado!';
                    Login::redirect(FULL_PATH_ACCOUNT);
                }else{
                    $_SESSION['address_error'] = 'Não foi possível deletar esse endereço!';
                    Login::redirect(FULL_PATH_ACCOUNT);
                }
            }else{
                Login::redirect(FULL_PATH_ACCOUNT);
            }
        }

        /* views */

        public function viewCreate(){
            include(PATH_ACCOUNT.'createAddress.php');
        }

        public function viewEdit(){
            include(PATH_ACCOUNT.'editAddress.php');
        }


        /* functions */

        private function getInputs(){

            try{
                $fName = $_POST['fName'];
                $lName = $_POST['lName'];
                $phone = $_POST['phone'];
                $cep = $_POST['cep'];
                $estado = $_POST['estado'];
                $cidade = $_POST['cidade'];
                $bairro = $_POST['bairro'];
                $numero = $_POST['numero'];
                $complemento = empty($_POST['complemento']) ? 'DEFAULT' : $_POST['complemento'];
                $endereco = $_POST['endereco'];
                $isDefault = isset($_POST['isDefault']) ? 1 : 0;

                return [
                    $fName, $lName, $phone, $cep, $estado, $cidade, $bairro, $numero, $complemento, $endereco, $isDefault
                ];

            }catch(Throwable $e){
                return false;
            }
        }

        private function createAddress(){
            [
                $fName,
                $lName,
                $phone,
                $cep,
                $estado,
                $cidade,
                $bairro,
                $numero,
                $complemento,
                $endereco,
                $isDefault
            ] = $this->getInputs();   
            
            $cep = str_replace('-', '', $cep);
            $phone = str_replace(['-', '(', ')'], '', $phone);
            if(!$this->validateInputs(['cep' => $cep, 'number' => $numero, 'phone' => $phone]))
                return false;
            
            if(!UserAddressModel::linkUserAddress($fName, $lName, $phone, $cep, $estado, $cidade, $bairro, $endereco, $numero, $complemento, $isDefault)){
                $_SESSION['address_error'] = "Não foi possível cadastrar o endereço!";
                return false;
            }

            return true;
            
        }

        private function modifyAddress(){

            [
                $fName,
                $lName,
                $phone,
                $cep,
                $estado,
                $cidade,
                $bairro,
                $numero,
                $complemento,
                $endereco,
                $isDefault
            ] = $this->getInputs();   
            
            $id = $_POST['id'];
            $sql = "WHERE id = $id";

            $cep = str_replace('-', '', $cep);
            $phone = str_replace(['-', '(', ')'], '', $phone);

            if(!$this->validateInputs(['cep' => $cep, 'number' => $numero, 'phone' => $phone]))
                return false;
            
            return UserAddressModel::updateUserAddress($id, $fName, $lName, $phone, $cep, $estado, $cidade, $bairro, $endereco, $numero, $complemento, $isDefault,$sql);
        }

        private function validateInputs($numbers){
            $hasError = false;

            foreach($numbers as $num){
                if(!empty($num)){
                    if(!Sanitizer::validateNumberInput($num))
                        $hasError = true;
                    
                }else
                    $hasError = true;
            }

            if($hasError){ 
                $_SESSION['address_error'] = 'Número inválido!';
                return false;
            }
            return true;
        }
    }
?>







