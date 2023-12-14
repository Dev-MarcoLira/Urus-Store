<?php

    class MessageModel{

        private static $messagesTable = 'messages';
        private static $messagesFields = 'user_id, message';

        public static function createMessage($userId, $message){

            $values = "$userId, '$message'";

            return MySQL::insert(self::$messagesTable, self::$messagesFields, $values);
        }

        public static function selectMessage($columns, $where){
            
            return MySQL::select($columns,self::$messagesTable, $where);
        }

        public static function updateMessageStatus($status, $where){
            $columns = "SET status = '$status'";

            return MySQL::update(self::$messagesTable, $columns, $where);
        }

    }
?>