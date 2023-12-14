<?php

    class ReviewController{

        public function disable(){
            if($_GET['id']){

                if($this->disableReview($_GET['id'])){
                    $_SESSION['review_success'] = "Avaliação apagada!";
                    Login::redirect(FULL_PATH_SITE.'product?productId='.$_GET['productId']);
                }else{
                    $_SESSION['review_error'] = "Não foi possível apagar Avaliação apagada!";
                    Login::redirect(FULL_PATH_SITE.'product?productId='.$_GET['productId']);
                }

            }else{
                Login::redirect(FULL_PATH_SITE);
            }
        }

       public function sendReview(){

            if(isset($_GET['productId'])){
            
                if($this->rate()){
                    $_SESSION['review_success'] = 'Avaliação recebida!';
                }else
                    $_SESSION['review_error'] = 'Não foi possível avaliar o produto! Tente novamente em instantes.';

                Login::redirect(FULL_PATH_SITE."product?productId=".$_GET['productId']);

            }else{
                Login::redirect(FULL_PATH_SITE);
            }

       } 

       public function index(){
            include(PATH_ACCOUNT.'productReviews.php');
       }

       //functions

       private function rate(){
            try{

                $id = $_GET['productId'];
                $rating = $_GET['rate'];

                $userId = Login::getId();

                return ReviewModel::insertReview($userId, $id, $rating);

            }catch(Throwable $error){

                return false;
            }
       } 

       private function disableReview($id){
            try{

                return ReviewModel::disableReview($id);

            }catch(Throwable $error){
                return false;
            }
       }

    }


?>