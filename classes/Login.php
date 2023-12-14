<?php


	/**
	 * 
	 */
	class Login
	{
		
		public static function redirect($url){
			header('Location: '. $url);

			die();
		}

		public static function getId(){

			$email = $_SESSION['login'];
			$user = '';
			foreach(UserModel::selectUser('*', "WHERE email = '$email'") as $user){
				
				return $user['id'];
			}

		}

		public static function getAdmId(){
			$email = $_SESSION['panel'];
			foreach(UserModel::selectUser('*', "WHERE email = '$email'") as $user){
				
				return $user['id'];
			}
		}

		public static function setToken(){
			
			$token = md5(rand());

			return $token;
		}
	}

?>