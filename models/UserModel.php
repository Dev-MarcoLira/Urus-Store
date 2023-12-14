<?php

	class UserModel{

		private static $usersTable = 'users';
		private static $usersFields = 'name, email, passwd, gender';

		public static function createUser($name, $email, $passwd, $gender){

			$values = "'$name', '$email', '$passwd', '$gender'";

			return MySQL::insert(self::$usersTable, self::$usersFields, $values);

		}

		public static function getUser(){

			$id = Login::getId();
			$users = UserModel::selectUser('*', "where id = $id");

			foreach($users as $usr) return $usr;
		}


		public static function selectUser($columns, $where){

			return MySQL::select($columns, self::$usersTable, $where);
		}

		public static function getName($where){
			foreach(self::selectUser('name', $where) as $name)
				return $name[0];
			
		}

		public static function updateUser($name, $gender, $birth, $where){
			$timestamp = date('Y-m-d H:i:s');
			$sql = "set name = '$name', gender = '$gender', birth = '$birth', modified_at = '$timestamp'";

			return MySQL::update(self::$usersTable, $sql, $where);

		}

		public static function updateEmail($email, $where){

			$sql = "set email = '$email', is_confirmed = DEFAULT";
			return MySQL::update(self::$usersTable, $sql, $where);
		}

		public static function confirmEmail(){

			$email = $_SESSION['login'];
			$sql = "SET is_confirmed = 1";

			return MySQL::update(self::$usersTable, $sql, "WHERE email = '$email'");
		}

		public static function isConfirmed(){
			$email = $_SESSION['login'];

			foreach(self::selectUser('is_confirmed', "WHERE email = '$email'") as $confirmed) return $confirmed[0];
		}

		public static function getGender($id){
			foreach(self::selectUser('gender', "WHERE id = $id") as $gender)
				return $gender[0];
		}

		public static function updateCpf($cpf, $where){

			$sql = "SET cpf = '$cpf'";
			return MySQL::update(self::$usersTable, $sql, $where);
		}

		public static function updateRole($role, $where){
			$sql = "SET role = '$role'";

			return MySQL::update(self::$usersTable, $sql, $where);
		}

		public static function updatePasswordById($password){
			$id = Login::getId();
			$sql = "set passwd = '$password'";
			$where = "WHERE id = $id";

			return MySQL::update(self::$usersTable, $sql, $where);
		}

		public static function updatePasswordByEmail($email, $password){
			$sql = "set passwd = '$password'";
			$where = "WHERE email = '$email'";

			return MySQL::update(self::$usersTable, $sql, $where);
		}

		public static function deleteUser($where){
			return MySQL::delete(self::$usersTable, $where);
		}

	}


?>