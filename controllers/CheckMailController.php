<?php

    class CheckMailController{


        public function view(){

            if(isset($_SESSION['checkMail'])){

				$_SESSION['checkMail'] = null;

				include(PATH_VIEWS.'checkMail.php');
			}else{
				Login::redirect(FULL_PATH_SITE);
			}

        }
    }

?>