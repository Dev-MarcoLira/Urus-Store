<?php

    class PaymentModel{

        private  static $paymentTable = 'payment_details';
        private static $paymentFields = 'user_id, mercado_pago_id, amount, parcelas, method, status';

        private static $ordersTable = 'order_items';
        private static $ordersFields = 'payment_id, product_id, quantity, total';

        public static function selectPaymentByUser($columns, $where){
            return MySQL::select($columns, self::$paymentTable, $where);
        }

        public static function selectPayments($columns, $where){
            return MySQL::select($columns, self::$paymentTable, $where);
        }

        public static function selectPaymentProductsByUser(){

        }

        public static function getOrdersByPaymentId($columns, $paymentId){
            $id = Login::getId();

            $sql = "SELECT $columns FROM ".self::$ordersTable." AS a INNER JOIN ".self::$paymentTable." AS b ".
            "ON b.user_id = $id AND a.payment_id = b.id AND a.payment_id = $paymentId";
            
            return MySQL::freeSelect($sql);
        }

        public static function selectOrderItems($columns, $where){
            return MySQL::select($columns, self::$ordersTable, $where);
        }

        public static function createPayment($userId, $mercadoPagoId, $amount, $installments, $method, $status){

            $values = "$userId, $mercadoPagoId, $amount, $installments, '$method', '$status'";

            return MySQL::insert(self::$paymentTable, self::$paymentFields, $values);
        }

        public static function createOrderItems($paymentId, $productId, $quantity, $total){
            $values = "$paymentId, $productId, '$quantity', '$total'";

            return MySQL::insert(self::$ordersTable, self::$ordersFields, $values);
        }

        public static function getPaymentByMercadoPagoId($id){

            $where  = "WHERE mercado_pago_id = '$id'";

            foreach(MySQL::select('id', self::$paymentTable, $where) as $payment){
                return $payment;
            }
        }

        public static function updatePayment(){

        }

    }

?>