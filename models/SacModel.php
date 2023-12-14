<?php

    class SacModel{

        private static $messagesTable = 'sac_messages';        
        private static $messagesFields = 'message, protocol_id, user_id';

        private static $repliesTable = 'sac_replies';
        private static $repliesFields = 'from_message_id, to_message_id';

        private static $adminMessagesTable = 'sac_admin_messages';
        private static $adminMessagesFields = 'message_id, user_id, protocol_id';

        private static $protocolsTable = 'sac_protocols';
        private static $protocolsFields = 'status, title, user_id';

        public static function selectMessages($columns, $where){

            return MySQL::select($columns, self::$messagesTable, $where);
        }

        public static function createMessage($message, $protocolId){

            $userId = Login::getId();
            $values = "'$message', $protocolId, $userId";


            return MySQL::insert(self::$messagesTable, self::$messagesFields, $values);
        }

        public static function deleteMessage($where){

            return MySQL::delete(self::$messagesTable, $where);
        }

        public static function createAdminMessage($messageId, $userId, $protocolId){

            $values = "$messageId, $userId, $protocolId";

            return MySQL::insert(self::$adminMessagesTable, self::$adminMessagesFields, $values);
        }

        public static function selectAdminMessage($columns, $where){

            return MySQL::select($columns, self::$adminMessagesTable, $where);
        }

        public static function createProtocol($status, $title){

            $id = Login::getId();

            if(empty($status)){

                $values = "DEFAULT, '$title', $id";
                return MySQL::insert(self::$protocolsTable, self::$protocolsFields, $values);
            }else{

                $values = "'$status', '$title', $id";

                return MySQL::insert(self::$protocolsTable, self::$protocolsFields, $values);
            }

        }

        public static function getProtocols(){

            $id = Login::getId();

            $where = "WHERE user_id = $id";
            return MySQL::select('*', self::$protocolsTable, $where);

        }

        public static function selectProtocol($columns, $where){

            return MySQL::select($columns, self::$protocolsTable, $where);
        }

        public static function deleteProtocol($id){
            $where = "WHERE protocol_id = $id";

            if(self::deleteMessage($where)){
                $where = "WHERE id = $id";
                return MySQL::delete(self::$protocolsTable, $where);
            }else
                return false;
        }

        public static function setStatus($status, $where){

            return MySQL::update(self::$protocolsTable, "SET status = '$status'", $where);
        }

        public static function getStatus($where){

            foreach(MySQL::select('status', self::$protocolsTable, $where) as $status){
                return $status[0];
            }
        }

        /*public static function linkProtocol($userId, $message){

            $dbh = MySQL::getConnection();
            
            try {
        
                $dbh->beginTransaction();
        
                MessageModel::createMessage($userId, $message);

                $messageId = $dbh->lastInsertId();
                $dbh->commit();
        
                
        
            } catch(PDOException $e) {
        
                $dbh->rollback();
        
                return false;
        
            }
            
            try {
        
                $dbh->beginTransaction();
        
                SacModel::createProtocol('');

                $protocolId = $dbh->lastInsertId();
                $dbh->commit();               
        
            } catch(PDOException $e) {
        
                $dbh->rollback();
        
                return false;
                
            }

            return SacModel::createMessage($messageId, $protocolId);

        }*/

        

        /*
        public static function createReply($fromMessageId, $toMessageId){
            $values = "$fromMessageId, $toMessageId";

            return MySQL::insert(self::$repliesTable, self::$repliesFields, $values);
        }

        public static function linkReply($message, $toMessageId){

            $userId = Login::getId();

            if($dbh = MySQL::getConnection()){
                
                try {
            
                    $dbh->beginTransaction();
            
                    MessageModel::createMessage($userId, $message);
                    $fromMessageId = $dbh->lastInsertId();
  
                    $dbh->commit();
            
                    return MySQL::insert('sac_replies', 'from_message_id, to_message_id', "$fromMessageId, $toMessageId");        
                    
                }catch(PDOException $e) {
            
                    $dbh->rollback();
            
                    return false;
                }
            }
        }

        public static function selectReply($columns, $where){

            return MySQL::select($columns, self::$repliesTable, $where);
        }*/

    }


?>