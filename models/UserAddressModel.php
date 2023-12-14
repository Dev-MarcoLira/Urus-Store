<?php


    class UserAddressModel{

        private static $addressTable = 'addresses';
		private static $addressFields = 'first_name, last_name, phone, cep, estado, cidade, bairro, endereco, numero, complemento';

		private static $addressUserTable = 'users_addresses';
		private static $addressUserFields = 'user_id, address_id, is_default';

        public static function selectUserAdress($columns, $where){

            return MySQL::select($columns, self::$addressTable, $where);

        }

		public static function createUserAddress($f_name, $l_name, $phone, $cep, $estado, $cidade, $bairro, $endereco, $numero, $complemento){

			$values = "'$f_name', '$l_name', $phone, $cep, '$estado', '$cidade', '$bairro', '$endereco', $numero, '$complemento'";
			
			return MySQL::insert(self::$addressTable, self::$addressFields, $values);
		}

		public static function selectDefaultAddress(){

			$id = Login::getId();

			$sql = "SELECT a.* FROM addresses AS a, users_addresses AS b WHERE b.user_id = $id AND b.is_default = 1 and b.address_id = a.id";

			return MySQL::freeSelect($sql);

		}

		public static function getDefaultAddress(){

			$id = Login::getId();

			$sql = "SELECT a.* FROM addresses AS a, users_addresses AS b WHERE b.user_id = $id AND b.is_default = 1 and b.address_id = a.id";

			foreach(MySQL::freeSelect($sql) as $address) return $address;

		}


		public static function linkUserAddress($f_name, $l_name, $phone, $cep, $estado, $cidade, $bairro, $endereco, $numero, $complemento, $isDefault){

			$id = Login::getId();
			
			if($dbh = MySQL::getConnection()){
                
                try {
            
                    $dbh->beginTransaction();
            
					self::createUserAddress($f_name, $l_name, $phone, $cep, $estado, $cidade, $bairro, $endereco, $numero, $complemento);
                    $addressId = $dbh->lastInsertId();
  
                    $dbh->commit();
  
					$values = "$id, $addressId, $isDefault";
					
                    return MySQL::insert(self::$addressUserTable, self::$addressUserFields, $values);        
                    
                }catch(PDOException $e) {
            
                    $dbh->rollback();
					$_SESSION['address_error'] = $e->getMessage();
                    return false;
                }
            }else{
				return false;
			}

		}

		public static function getDefaultState($id){
			$where = "WHERE address_id = $id";

			foreach(MySQL::select('is_default', self::$addressUserTable, $where) as $state){
				return $state[0];
			}
		}

		public static function getAddresses(){

			$id = UserModel::getUser()[0];

			$query = "SELECT a.* FROM addresses AS a, users_addresses AS b WHERE a.id = b.address_id AND b.user_id = $id";

			return MySQL::freeSelect($query);

		}

		public static function getAddress($id){
			$query = "WHERE id = $id";

			foreach(self::selectUserAdress('*', $query) as $address) return $address;
		}

		public static function setIsDefault($id, $state){
			$sql = "SET is_default = $state";
			$where = "WHERE address_id = $id";


			if(MySQL::update(self::$addressUserTable, "SET is_default = 0", "WHERE address_id != $id")){
				return MySQL::update(self::$addressUserTable, $sql, $where);
			}else
				return false;
		}

		public static function deleteAddress($addressId){
			$where = "WHERE address_id = $addressId";

			if(MySQL::delete(self::$addressUserTable, $where)){

				$where = "WHERE id = $addressId";

				return MySQL::delete(self::$addressTable, $where);
			}else
				return false;
		}

        public static function updateUserAddress($id, $f_name, $l_name, $phone, $cep, $estado, $cidade, $bairro, $endereco, $numero, $complemento, $isDefault, $where){

			if(!self::setIsDefault($id, $isDefault)) return false;


			$sql = "SET first_name = '$f_name', last_name = '$l_name', phone = $phone, cep = $cep, estado = '$estado', cidade = '$cidade'".
			", bairro = '$bairro', endereco = '$endereco', numero = $numero, complemento = '$complemento'";

			return MySQL::update(self::$addressTable, $sql, $where);
		}

    }
?>