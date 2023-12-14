<?php

    class SettingsController{

        public function register(){
            if(isset($_POST['form'])){
                if($this->addRole()){
                    $_SESSION['settings_success'] = 'Usuário cadastrado com sucesso!';
                    Login::redirect(FULL_PATH_PANEL.'settings');
                }else{
                    $_SESSION['settings_error'] = 'Não foi possível cadastrar o usuário!';
                    Login::redirect(FULL_PATH_PANEL.'settings');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function disable(){
            
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                if(UserModel::updateRole('usr', "WHERE id = $id")){
                    $_SESSION['settings_success'] = 'Operação realizada com sucesso!';
                    Login::redirect(FULL_PATH_PANEL.'settings');
                }else{
                    $_SESSION['settings_error'] = 'Não foi possível realizar a operação! Tente novamente em instantes.';
                    Login::redirect(FULL_PATH_PANEL.'settings');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        public function view(){
            
            $role = '';
            
            foreach(UserModel::selectUser('role', "WHERE email = '". $_SESSION['panel']."'") as $roles)
                $role = $roles[0];

            //Role ==> 'adm'; 'func'; 'usr'

            if($role == 'adm'){

                include(PATH_VIEWS.'settings.php');
            }else{
                $_SESSION['settings_error'] = 'Apenas ADMs podem acessar as configurações!';
                Login::redirect(FULL_PATH_PANEL);
            }
        }

        private function addRole(){
            $role = $_POST['role'];
            $email = $_POST['email'];
            
            return UserModel::updateRole($role, "WHERE email = '$email'");
        }
    }

?>