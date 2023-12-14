<?php

    class PaymentController{

        public function addOrder(){
            
            $this->setHeader();

            try{
                
                $requisition = json_decode(file_get_contents('php://input'), true);

                $productsIds = $requisition['ids'];
                $payment = $requisition['payment'];
                $mercadoPagoId = $payment['id'];

                $paymentId = PaymentModel::getPaymentByMercadoPagoId($mercadoPagoId)['id'];

                /*$response = array(
                    'ids' => $productsIds,
                    'payment' => $payment,
                    'mercado' => $mercadoPagoId,
                    'payId' => $paymentId
                );*/

                foreach($productsIds as $id){

                    $originalPrice = ProductModel::getPrice($id)[0];
                    $quantity = CartModel::getQuantity($id)[0];
                    $originalQuantity = ProductModel::getAmount($id);
                    $discountedPrice = productModel::getPromotionPrice($id, $originalPrice);

                    $total = $discountedPrice * $quantity;
                    
                    if(ProductModel::checkInventoryType($id) == 1){
                        ProductModel::setAmount($id, $originalQuantity - $quantity);
                        
                        if(ProductModel::getAmount($id) < 1){
                            ProductModel::disable($id);
                        }
                    }
                    
                    PaymentModel::createOrderItems($paymentId, $id, $quantity, $total);

                    CartModel::deleteCartItem("WHERE product_id = $id");
                }

                echo json_encode(array('status' => 'ok'));

            }catch(Throwable $e){
                echo json_encode(array('status'=>$e->getMessage()));
            }
        }

        public function processPayment(){
            
            require_once 'vendor/autoload.php';

            $this->setHeader();

            $response = '';

            try{
                MercadoPago\SDK::setAccessToken("TEST-7383146863773020-091207-2282deb85fb006b869f5f9d0ed31e10f-1476967351");
                $payment = new MercadoPago\Payment();

                $contents = json_decode(file_get_contents('php://input'), true);

//                echo json_encode(array('content' => $contents));
                $method = $contents['payment_method_id'];
                $email = $contents['payer']['email'];
                
                $_SESSION['order_email'] = $email;

                $type = '';

                if($method == 'pix'){

                    $response = $this->processPix($contents, $payment);
                    $installments = 1;
                    $type = $method;
                    
                    $_SESSION['order_url'] = $response['redirects']->transaction_data->ticket_url;
                    $_SESSION['order_email'] = $email;
                    
                    $this->sendMail('sendPixMail');

                }else if($method == 'bolbradesco' || $method == 'pec'){

                    $response = $this->processTicket($contents, $payment);
                    $installments = 1;
                    $type = $method;

                    $this->sendMail('sendTicketMail');

                }else{

                    //Aqui estamos trabalhando com cartão!

                    $response = $this->processCard($contents, $payment);
                    $installments = $contents['installments'];

                    $type = $response['type'];

                    if($response['status'] == 'rejected'){ 
                        $_SESSION['payment_error'] = 'Não foi possível processar o seu pedido! Pedimos que tente novamente mais tarde.';
                        
                        throw new Error('error');
                    }

                    $this->sendMail("sendCardMail");
                }
                
                $mercadoPagoId = $response['id'];
                $status = $response['status'];
                $amount = $contents['transaction_amount'];
                $userId = Login::getId();
                $response['method'] = $type;

                PaymentModel::createPayment($userId, $mercadoPagoId, $amount, $installments, $type, $status);
                
                echo json_encode($response);

            }catch(Throwable $e){
                $_SESSION['payment_error'] = 'Não foi possível efetivar o pagamento devido a erro interno do servidor!';
                echo json_encode(array('status'=>$e->getMessage()));
            }
              
        }

        public function errorHandling(){
            if(!isset($_SESSION['payment_success']) && !isset($_SESSION['payment_error'])){

                $_SESSION['payment_error'] = "Não foi possível processar o pagamento! Tente novamente em instantes.";
                Login::redirect(FULL_PATH_CART);

            }else{
                Login::redirect(FULL_PATH_CART);
            }
        }

        function sendMail($callback){

            if(isset($_SESSION['order_email']) && isset($_SESSION['order_url'])){

                if(!$this->$callback()){
                    $_SESSION['payment_error'] = 'Não foi possível processar o seu pedido! Pedimos que tente novamente mais tarde.';
                }

                $_SESSION['order_email'] = null;
                $_SESSION['order_url'] = null;

            }else{
                Login::redirect(FULL_PATH_SITE.'cart');
            }

        }

        /* views */

        public function view(){
            include(PATH_VIEWS."payment.php");
        }

        public function viewOrders(){
            include(PATH_VIEWS.'orders.php');
        }

        public function viewDetails(){
            if(isset($_GET['paymentId'])){
                if(PaymentModel::selectOrderItems('product_id, total, quantity', "WHERE payment_id = ".$_GET['paymentId'])->rowCount()){
                    include(PATH_VIEWS.'order-details.php');
                }else{
                    Login::redirect(FULL_PATH_ACCOUNT.'/orders');
                }
            }else{
                Login::redirect(FULL_PATH_ACCOUNT.'/orders');
            }
        }

        //functions

        private function sendPixMail(){

            $_SESSION['payment_success'] = 'Pagamento gerado com sucesso! Um link foi enviado para o seu e-mail!';
            $link = $_SESSION['order_url'];
            
            $body = "Obrigado pela compra! Aqui está o código QR do seu pagamento: $link";
            $address = $_SESSION['order_email'];
            $subject = "Pedido registrado na Apolo Store";

            return Email::mail($address, $subject, $body);
        }

        private function sendTicketMail(){
            $body = "Obrigado pelo pagamento! Aproveite o seu pedido na Apolo Store enquanto aguarda a entrega!";
            $address = $_SESSION['order_email'];
            $subject = "Pedido registrado na Apolo Store";

            return Email::mail($address, $subject, $body);
        }

        private function sendCardMail(){
            $body = "Obrigado pelo pagamento! Aproveite o seu pedido na Apolo Store enquanto aguarda a entrega!";
            $address = $_SESSION['order_email'];
            $subject = "Pedido registrado na Apolo Store";

            return Email::mail($address, $subject, $body);
        }

        private function processPix($contents, $payment){
            $payment->transaction_amount = $contents['transaction_amount'];
            $payment->payment_method_id = "pix";
            $payment->payer = array(
               "email" => $contents['payer']['email'],
             );
            
            $payment->save();
            $response = array(
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'id' => $payment->id,
                'details' => $payment->transaction_details,
                'redirects' => $payment->point_of_interaction,
                'email' => '',
                'method' => ''
            );

            return $response;
        }

        private function processCard($contents, $payment){

            $payment->transaction_amount = $contents['transaction_amount'];
            $payment->token = $contents['token'];
            $payment->installments = $contents['installments'];
            $payment->payment_method_id = $contents['payment_method_id'];
            $payment->issuer_id = $contents['issuer_id'];

            $payer = new MercadoPago\Payer();
            $payer->email = $contents['payer']['email'];
            $payer->identification = array(
                "type" => $contents['payer']['identification']['type'],
                "number" => $contents['payer']['identification']['number']
            );
            $payment->payer = $payer;
            $payment->save();

            $response = array(
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'id' => $payment->id,
                'type' => $payment->payment_type_id,
                'method' => ''
            );

            return $response;
        }

        private function processTicket($contents, $payment){

            $payment->transaction_amount = $contents['transaction_amount'];
            $payment->payment_method_id = $contents['payment_method_id'];
            $payment->payer = array(
                "email" => $contents['payer']['email'],
                "first_name" => $contents['payer']['first_name'],
                "last_name" => $contents['payer']['last_name'],
                "identification" => array(
                    "type" => "CPF",
                    "number" => $contents['payer']['identification']['number']
                 ),
                "address" => array(
                    "zip_code" => $contents['payer']['address']['zip_code'],
                    "street_name" => $contents['payer']['address']['street_name'],
                    "street_number" => $contents['payer']['address']['street_number'],
                    "neighborhood" => $contents['payer']['address']['neighborhood'],
                    "city" => $contents['payer']['address']['city'],
                    "federal_unit" => $contents['payer']['address']['federal_unit']
                 )
              );
      
            $payment->save();
            
            $response = array(
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'id' => $payment->id,
                'method' => $payment->payment_method_id,
                'redirects' => $payment->point_of_interaction,
                'email' => $contents['payer']['email'],
                'method' => ''
            );

            return $response;
        }

        private function setHeader(){
            header('Access-Control-Allow-Origin: *;');
            header('Content-Type: Application/json;');
            header('mode: cors;');
        }
    }
?>