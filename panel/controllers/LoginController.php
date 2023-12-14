<?php

	class LoginController{

		/*   	Login Validations	   */

		function login(){

			if(isset($_GET['loginAction'])){
				
				$email = $_GET['email'];
				$password = hash('sha512', $_GET['senha']);
				
				$select  = MySQL::select('*','users',"where email = '$email' and passwd = '$password' and (role = 'adm' or role = 'func')");
				$count = $select->rowCount();
				
				if($count == 1){
					
					$_SESSION['panel'] = $email;
					Login::redirect(FULL_PATH_PANEL);

				}else{
					$_SESSION['login_error'] = 'Usuário ou senha incorretos!';
					Login::redirect(FULL_PATH_PANEL);
				}

			}else{
				Login::redirect(FULL_PATH_PANEL);
			}
		}
		
		function loggout(){
			session_destroy();
			Login::redirect(FULL_PATH_PANEL);
		}
		
		//include views

		function index(){
			
			include(PATH_VIEWS.'login.php');
			
		}
	}
	
?>