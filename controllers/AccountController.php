<?php

	class AccountController{

		/* Route validations */

		public function editAccount(){

			if(isset($_POST['editAccount'])){

				$editedAt = $this->updateAccount();

				if($editedAt){
					$_SESSION['account_success'] = 'Conta atualizada com sucesso!';
					Login::redirect(FULL_PATH_ACCOUNT);
				}else{
					$_SESSION['account_error'] = 'Não foi possível atualizar a conta!';
					Login::redirect(FULL_PATH_ACCOUNT);
				}
			}
		}

		public function sendConfirmEmail(){
            
            $token = Login::setToken('checkMailToken');
            if($this->sendConfirmationMail($token)){		

                $_SESSION['checkMail'] = true;
                Login::redirect(FULL_PATH_SITE.'checkMail');
            }else{
                $_SESSION['checkMail_error'] = 'Erro ao enviar e-mail!';
                $token = null;
                Login::redirect(FULL_PATH_SITE);
            }
        }

		public function sendPasswordEmail(){

			if(!isset($_COOKIE['changePasswordToken'])){

                $token = Login::setToken();
				setcookie("changePasswordToken", $token, time()+60*60*10);
				if($this->sendPasswordMail($token)){
                    $_SESSION['checkMail'] = true;
                    Login::redirect(FULL_PATH_SITE.'checkMail');
                }else{
					$token = null;
                }

			}else{
				$_SESSION['changePassword_error'] = "O Link já foi enviado para o seu e-mail. Ele permanecerá válido por 10 minutos!";
				Login::redirect(FULL_PATH_ACCOUNT);
			}	

		}

		public function changePassword(){

			if(isset($_POST['changePassword'])){

				$changedAt = $this->updatePassword($_POST['password']);
				
				if($changedAt){
					$_COOKIE['changePasswordToken'] = null;
					$_SESSION['changePassword_success'] = 'Senha atualizada com sucesso!';
					Login::redirect(FULL_PATH_SITE.'account');
				}else{
					$_SESSION['changePassword_error'] = 'Não foi possível atualizar sua senha';
					Login::redirect(FULL_PATH_SITE);
				}
		
			}

		}

		public function checkAccount(){
			if(isset($_GET['token'])){

				if($_GET['token'] == $_COOKIE['checkMailToken']){

					if($this->confirmEmail()){
						$_COOKIE['checkMailToken'] = null;
						$_SESSION['checkMail_success'] = 'Conta de e-mail verificada com sucesso!';
						Login::redirect(FULL_PATH_ACCOUNT);
					}else{
						$_SESSION['checkMail_error'] = 'Não foi possível confirmar o seu E-mail!';
						Login::redirect(FULL_PATH_ACCOUNT);
					}

				}else{
					$_SESSION['checkMail_error'] = 'Token inválido!';
					Login::redirect(FULL_PATH_ACCOUNT);
				}

			}else{
				Login::redirect(FULL_PATH_ACCOUNT);
			}
		}

		/* Include views */

		
		public function view(){
			include(PATH_ACCOUNT.'account.php');
		}

		public function viewChangePassword(){
			if(!isset($_GET['token'])){
				
				Login::redirect(FULL_PATH_SITE.'account');
			}else{
				$token = $_GET['token'];
				
				if($_COOKIE['changePasswordToken'] != $token){
					//Login::redirect(FULL_PATH_SITE.'account');
					echo $_COOKIE['changePasswordToken'];
				}  
			}

			if(isset($_SESSION['login']) | isset($_SESSION['email'])){
				include(PATH_ACCOUNT.'changePassword.php');
			}else{
				Login::redirect(FULL_PATH_SITE.'login');
			}
		}

		public function viewEditAccount(){
			include(PATH_ACCOUNT.'editAccount.php');
		}


		/* functions */

		private function sendPasswordMail($token, $email = null){
			$address = isset($_SESSION['login']) ? $_SESSION['login'] : $email;
            $address = isset($_GET['email']) ? $_GET['email'] : $address;

			$subject = "Altere sua senha da Apolo Store";
			$body = "Clique no link para alterar sua senha: <a href='".FULL_PATH_ACCOUNT."/changePassword?token=$token'>Alterar senha</a>";

			return Email::mail($address, $subject, $body);
		}

		private function sendConfirmationMail($token){
            $address = $_SESSION['login'];
			$subject = "Confirme sua Conta de E-mail!";

			$body = "Clique no link para confirmar sua conta! <a href='".FULL_PATH_ACCOUNT."/confirm?token=$token'>Confirmar E-mail</a>";

			return Email::mail($address, $subject, $body);
        }

		private function confirmEmail(){
			return UserModel::confirmEmail();
		}

		private function getInputs(){

			$name = isset($_POST['name']) ? $_POST['name'] : null;
			$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
			$email = isset($_POST['email']) ? $_POST['email'] : null;
			$password = isset($_POST['password']) ? $_POST['name'] : null;
			$gender = isset($_POST['gender']) ? $_POST['gender'] : null;
			$birth = isset($_POST['birth']) ? $_POST['birth'] : null;

			return [ $name, $cpf, $email, $password, $gender, $birth ];
		}

		private function updatePassword($password){

			$newPassword = hash('sha512', $password);
	
			return UserModel::updatePasswordById($newPassword);
		}

		private function updateAccount(){

			[
				$name,
				$cpf,
				$email,
				,
				$gender,
				$birth
				
			] = $this->getInputs();
	
			$cpf = str_replace(['-', '.'], '', $cpf);
			
			if(!$this->validateInputs($cpf)){
				return false;
			}
			
			if($_SESSION['login'] === $email){
	
				$sql = "WHERE email = '$email'";
				
				$updatedtAt = UserModel::updateUser($name, $gender, $birth, $sql);
			}else{
				
				$sessionEmail = $_SESSION['login'];
				$sql = "WHERE email = '$sessionEmail'";
	
				UserModel::updateEmail($email, $sql);
				$updatedtAt = UserModel::updateUser($name, $gender, $birth, $sql);
				$_SESSION['login'] = $email;
			}
	
			if(!$updatedtAt)
				return false;
	
			if(!$this->updateCpf($cpf, $sql))
				return false;
	
			return true;
	
		}
	
		private function updateCpf($cpf, $where){
			$cpfNoMask = str_replace(['-','.'], '', $cpf);
			
			if(!Sanitizer::validateNumberInput($cpfNoMask)){
				$_SESSION['cpf_error'] = 'CPF inválido!';
				return false;
			}
	
			return UserModel::updateCpf($cpfNoMask, $where);
	
		}
	
		private function validateInputs($numbers){
			$hasError = false;
	
			if(!empty($num)){
				if(!Sanitizer::validateNumberInput($num)){
					$_SESSION['num_error'] = 'Número inválido!';
					$hasError = true;
				}
			}
			
			if($hasError) return false;
	
			return true;
		}

		private function updateName($name){
			$defaultEmail = $_SESSION['login'];
			
			MySQL::update('users',"set name = '$name'","where email = '$defaultEmail'");
		}
	}
?>