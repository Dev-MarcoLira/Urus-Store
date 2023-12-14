<?php

	class LoginController{

		public function login(){
			if(isset($_POST['loginAction'])){
				
				[$email, $password,,] = $this->getInputs();
				
				$users = MySQL::select('*','users',"where email = '$email' and passwd = '$password'");
				$count = $users->rowCount();

				if($count == 1){
					$_SESSION['login'] = $email;

					foreach($users as $user){
						$id = $user['id'];
					}
					
					Login::redirect(FULL_PATH_SITE);
				}else{
					$_SESSION['login_error'] = 'Usuário ou senha incorretos!';
					Login::redirect(FULL_PATH_SITE.'login');
				}
			}
		}

		public function register(){
			if(isset($_POST['registerAction'])){
				
				$email = $_POST['email'];

				if($this->createUser()){

					$cookie = array('cookieName'=> 'registerToken');
					$token = Login::setToken($cookie);

					$_SESSION['login'] = $email;

					if($this->sendMail($token)){	
						$_SESSION['checkMail'] = true;
						Login::redirect(FULL_PATH_SITE.'checkMail');
					}else{
						$_SESSION['register_error'] = 'Erro ao enviar e-mail!';
						Login::redirect(FULL_PATH_SITE.'register');
					}
				}else{
					$_SESSION['register_error'] = 'Não foi possível criar esse usuário!';
					Login::redirect(FULL_PATH_SITE.'register');
				}

			}
		}

		public function checkAccount(){
			if(isset($_GET['token'])){

				if($_GET['token'] == $_COOKIE['registerToken']){

					if($this->confirmEmail()){
						$_COOKIE['registerToken'] = null;
						Login::redirect(FULL_PATH_SITE);
					}else{
						$_SESSION['confirmMail_error'] = 'Não foi possível confirmar o seu E-mail!';
						Login::redirect(FULL_PATH_SITE);
					}

				}else{
					
					$_SESSION['confirmMail_error'] = 'Token inválido!';
					Login::redirect(FULL_PATH_SITE);
				}

			}else{
				Login::redirect(FULL_PATH_SITE);
			}
		}

		public function sendForgotPassword(){
			
			//if(!isset($_COOKIE['forgotPasswordToken'])){

				$email = $_POST['email'];

				$token = Login::setToken();

				if($this->sendPasswordMail($token, $email)){
					setcookie('forgotPasswordToken', $token, time() + 60*10, '/');
					$_SESSION['checkMail'] = true;
					$_SESSION['email'] = $email;
					Login::redirect(FULL_PATH_SITE.'checkMail');
				}else{
					$token = null;
				}

			/*}else{
				$_SESSION['forgotPassword_error'] = "O link já foi enviado para o seu e-mail!";
				Login::redirect(FULL_PATH_SITE);
			}*/
			
		}

		public function changePassword(){

			if(isset($_POST['changePassword'])){

				$changedAt = $this->updatePassword($_POST['password']);
				
				if($changedAt){
					$_COOKIE['forgotPasswordToken'] = null;
					$_SESSION['forgotPassword_success'] = 'Senha atualizada com sucesso!';
					$_SESSION['email'] = null;
					Login::redirect(FULL_PATH_SITE);
				}else{
					$_SESSION['forgotPassword_error'] = 'Não foi possível atualizar sua senha';
					Login::redirect(FULL_PATH_SITE);
				}
			}
		}

		public function logout(){
			$email = $_SESSION['login'];
			//$users = MySQL::select("*", "users", "where email = '$email'");

			session_destroy();
			Login::redirect(FULL_PATH_SITE);
		}

		//  Include views

		public function view(){
			include(PATH_VIEWS."login.php");
		}

		public function viewRegister(){
			include(PATH_VIEWS."register.php");
		}

		public function viewForgotPassword(){
			if(!isset($_GET['token'])){
				
				Login::redirect(FULL_PATH_SITE);
			}else{
				$token = $_GET['token'];
				
				if($_COOKIE['forgotPasswordToken'] != $token)
					Login::redirect(FULL_PATH_SITE);  
			}

			include(PATH_VIEWS.'forgotPassword.php');
		}

		public function viewForgotPasswordMail(){
			if(!isset($_SESSION['login'])){
				include(PATH_VIEWS.'forgotPasswordMail.php');
			}else{
				Login::redirect(FULL_PATH_SITE);
			}
		}

		// Functions
		
		private function sendPasswordMail($token, $email){

			$subject = "Altere sua senha da Apolo Store";
			$body = "Clique no link para alterar sua senha: <a href='".FULL_PATH_SITE."forgot-my-password?token=$token'>Alterar senha</a>";

			return Email::mail($email, $subject, $body);
		}

		private function updatePassword($password){
			$newPassword = hash('sha512', $password);

			return UserModel::updatePasswordByEmail($_SESSION['email'], $newPassword);
		}

		private function confirmEmail(){
			return UserModel::confirmEmail();
		}

		private function getInputs(){
			$email = $_POST['email'];
			$password = hash('sha512', $_POST['senha']);
			$name = isset($_POST['nome']) ? $_POST['nome'] : '';
			$gender = isset($_POST['sexo']);
			
			return [ $email, $password, $name, $gender ];

		}

		private function createUser(){
			[
				$email,
				$password,
				$name,
				$gender
			] = $this->getInputs();

			return UserModel::createUser($name, $email, $password, $gender);		
		}


		private function sendMail($token){
			$address = $_SESSION['login'];
			$subject = "Boas Vindas da Apolo Store";
			$body = "Obrigado por se Cadastrar na Apolo Store! ".
			"<a href=".FULL_PATH_SITE."login/confirm?token=$token>Confirme seu E-mail</a>";

			return Email::mail($address, $subject, $body);
		}
	}
?>