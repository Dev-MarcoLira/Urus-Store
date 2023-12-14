<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	class Email{

		public static function connect(){
			$mail = new PHPMailer(true);

			try {
				//Server settings
				$mail->SMTPDebug = 0;                      //Enable verbose debug output
				$mail->isSMTP();                                       //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'marcotestador6@gmail.com';                     //SMTP username
				$mail->Password   = 'CENSURED';                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				//Recipients
				$mail->setFrom('marcotestador6@gmail.com', 'Apolo Store');

			}catch(Exception $e){
				return false;
			}

			return $mail;
		}

		public static function mail($toAddress, $subject, $body){

			try{

				$mail = self::connect();
				$mail->addAddress($toAddress);
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = $subject;
				$mail->Body    = $body;
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
				$mail->send();

				return true;
			}catch(Exception $e){
				return false;
			}
		}
	}
?>