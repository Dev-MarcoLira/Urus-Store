<?php

    class API{

        private static function setHeader(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: Application/json;');
            header('mode: cors;');
            header('method: POST;');
        }

        public static function getUser(){

            $id = Login::getId();
            $sql = "SELECT u.cpf, u.email, a.* FROM addresses AS a INNER JOIN users_addresses AS ad ON a.id = ad.address_id ".
            "INNER JOIN users AS u ON u.id = ad.user_id AND u.id = $id";
            $user = '';

            foreach(MySQL::freeSelect($sql) as $usr){
                $user = $usr;
            }

            self::setHeader();

            echo json_encode($user);

        }

        public static function getOrderItems(){

            self::setHeader();

            try{

                $id = json_decode(file_get_contents('php://input'), true)[0];

                if(isset($id)){

                    $sql = "SELECT a.id, a.name, b.quantity, b.total FROM products AS a INNER JOIN order_items AS b ON b.product_id = a.id INNER JOIN payment_details AS c ON c.id = b.payment_id WHERE c.id = $id";
                    $products = [];
                    foreach(MySQL::freeSelect($sql) as $query)
                        array_push($products, $query);

                    echo json_encode(array('products' => $products));

                }else{
                    throw new Error("Id doesn't exist!!!");
                }

            }catch(Throwable $error){
                echo json_encode(array('error' => $error->getMessage()));
            }

        }

        public static function getChatMessages(){

            self::setHeader();

            try{

                //$id = json_decode($_POST['id']);
                
                echo json_encode(array('$id' => 'id'));

            }catch(Throwable $error){
                echo json_encode(array('error' => $error->getMessage()));
            }

        }

        public static function checkSelfAdminPassword(){
            
            
            self::setHeader();
            
            try{

                $response = json_decode(file_get_contents('php://input'), true);

                $id = Login::getAdmId();
                $password = hash('sha512', $response['password']);


                $sql = UserModel::selectUser('id', "WHERE passwd = '$password' AND id = $id");

                if($sql->rowCount() > 0){
                    echo json_encode(array('status'=>'ok'));
                }else{
                    echo json_encode(array('status'=>'failed'));
                }

            }catch(Throwable $error){
                echo json_encode(array('status'=>$error->getMessage()));
            }


        }

    }

?>