<?php

    class ChatController{

        public function sendSacMessage(){
            if($_POST['protocolId']){
                if($this->createSacMessage()){
                    Login::redirect(FULL_PATH_PANEL.'sac/topic?protocolId='.$_POST['protocolId']);

                }else{
                    $_SESSION['sac_error'] = 'Não foi possível enviar a mensagem!';
                    Login::redirect(FULL_PATH_PANEL.'sac/topic?protocolId='.$_POST['protocolId']);
                }
            }else{
                $_SESSION['sac_error'] = 'Você não selecionou nenhum chat!';
                Login::redirect(FULL_PATH_PANEL.'sac');
            }
        }

        public function deleteTopic(){
            if(isset($_GET['protocolId'])){
                $id = $_GET['protocolId'];
                if(SacModel::deleteProtocol($id)){

                    $_SESSION['sac_success'] = 'Protocolo removido com sucesso!';
                    Login::redirect(FULL_PATH_PANEL.'sac');

                }else{
                    $_SESSION['sac_error'] = 'Não foi possível deletar esse protocolo!';
                    Login::redirect(FULL_PATH_PANEL.'sac');
                }
            }else{
                $_SESSION['sac_error'] = 'Você não selecionou nenhum protocolo!';
                Login::redirect(FULL_PATH_PANEL.'sac');
            }
        }

        public function endTopic(){
            if(isset($_GET['protocolId'])){
                if($this->checkProtocol($_GET['protocolId'])){
                    if($this->endProtocol($_GET['protocolId'])){
                        $_SESSION['sac_success'] = 'O protocolo foi finalizado!';
                        Login::redirect(FULL_PATH_PANEL.'sac');
                    }else{
                        $_SESSION['sac_error'] = 'Erro ao finalizar!';
                        Login::redirect(FULL_PATH_PANEL.'sac');
                    }
                }else{
                    $_SESSION['sac_error'] = 'Esse chat já está finalizado!';
                    Login::redirect(FULL_PATH_PANEL.'sac');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL.'sac');
            }
        }

        public function deleteMessage(){
            if(isset($_GET['messageId'])){
                if(SacModel::deleteMessage("WHERE id = ".$_GET['messageId'])){
                    $_SESSION['sac_success'] = 'Mensagem deletada!';
                    Login::redirect(FULL_PATH_PANEL.'sac');
                }else{
                    $_SESSION['sac_error'] = 'Não foi possível enviar a mensagem!';
                    Login::redirect(FULL_PATH_PANEL.'sac');
                }
            }else{
                Login::redirect(FULL_PATH_PANEL.'sac');
            }
        }

        public function getMessages(){

            $id = json_decode(file_get_contents('php://input'), true);
            if(isset($id)){
                if(is_int($id)){

                    API::getChatMessages();

                }else{
                    Login::redirect(FULL_PATH_PANEL.'sac');

                }
            }else{
                Login::redirect(FULL_PATH_PANEL.'sac');
            }

        }


        /* views */
         
        public function view(){
            include(PATH_VIEWS.'clients.php');
        }

        public function viewTopic(){
            if(isset($_GET['protocolId'])){

                include(PATH_VIEWS.'protocol.php');

            }else{
                Login::redirect(FULL_PATH_PANEL.'sac');
            }
        }

        public function viewTemplate($url){

            $delimiter = explode('/', $url)[1];

            if($delimiter == 'novos'){
                $delimiter = 'novo';
            }else if($delimiter == 'em-aberto'){
                $delimiter = 'aberto';
            }else if($delimiter == 'finalizados'){
                $delimiter = 'finalizado';
            }

            include(PATH_VIEWS.'sac.php');

        }

        /* functions */

        private function createSacMessage(){

            $protocolId = $_POST['protocolId'];
            $message = $_POST['message'];

            return SacModel::createMessage($message, $protocolId);

        }

        private function checkProtocol($id){
            
            $status = SacModel::getStatus("WHERE id = $id");

            if($status != 'finalizado')
                return true;

            return false;
        }

        private function endProtocol($id){

            $status = 'finalizado';

            return SacModel::setStatus($status, "WHERE id = $id");
        }

    }
?>