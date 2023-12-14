<?php

	session_start();
	include('config/config.php');
	
	$sql = "SELECT a.id FROM products AS a INNER JOIN discounts_products AS b ON a.id = b.product_id";
	
	foreach(MySQL::freeSelect($sql) as $productId){
		try{

			ProductModel::controlDiscountTime($productId[0]);

		}catch(Throwable $error){
			continue;
		}
	}

	$sql = null;

	$url = !empty($_GET['url']) ? $_GET['url'] : '/';
	
	if($url == 'logout' || preg_match("/account/", $url) || preg_match("/cart/", $url) || preg_match("/address/", $url)
		|| preg_match("/sac/", $url) || preg_match("/account/", $url) || preg_match("/order/", $url)
		|| preg_match("/payment/", $url) || preg_match("/review/", $url) || preg_match("/api/", $url)
	){

		if(!isset($_SESSION['login']))
			Login::redirect(FULL_PATH_SITE.'login');

	}

	if(isset($_SESSION['changePassword_error'])){
		$errorMsg = "<h1>".$_SESSION['changePassword_error']."</h1";
		echo $errorMsg;
	}
	
	$mainController = new MainController();
	$accountController = new AccountController();
	$addressController = new AddressController();
	$andController = new AndController();
	$cartController = new CartController();
	$checkMailController = new CheckMailController();
	$catalogoController = new CatalogoController();
	$productController = new ProductController();
	$paymentController = new PaymentController();
	$promotionsController = new PromotionsController();
	$loginController = new LoginController();
	$reviewController = new ReviewController();
	$sacController = new SacController();
	$trendingController = new TrendingController();

	if($url == '/'){
		$mainController->view();
	}else if($url == 'login'){
		
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$loginController->view();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$loginController->login();
		}
		
	}else if($url == 'logout'){

		$loginController->logout();

	}else if($url == 'register'){

		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$loginController->viewRegister();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$loginController->register();
		}

	}else if($url == 'login/confirm'){

		$loginController->checkAccount();

	}else if($url == 'forgot-my-password'){

		//$checkMailController->forgotPassword();

		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$loginController->viewForgotPassword();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$loginController->changePassword();
		}

	}else if($url == 'forgot-my-password/sendMail'){

		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$loginController->viewForgotPasswordMail();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$loginController->sendForgotPassword();
		}
		

	}else if($url == 'checkMail'){

		$checkMailController->view();

	}else if($url == 'and'){

		$andController->view();

	}else if($url == 'promotions'){

		$promotionsController->view();

	}else if($url == 'trending'){

		$trendingController->view();

	}else if($url == 'product'){
		$productController->view();

	}else if($url == 'cart'){
		$cartController->view();

	}else if($url == 'cart/add'){

		$cartController->add();

	}else if($url == 'cart/setAmount'){

		$cartController->setAmount();

	}else if($url == 'cart/delete'){

		$cartController->delete();

	}else if($url == 'account/orders'){

			$paymentController->viewOrders();

	}else if($url == 'account'){

		$accountController->view();

	}else if($url == 'account/reviews'){

		$reviewController->index();

	}else if($url == 'account/edit'){

		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$accountController->viewEditAccount();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$accountController->editAccount();
		}

	}else if($url == 'account/address/create'){

		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$addressController->viewCreate();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$addressController->addAddress();
		}

	}else if($url == 'account/address/edit'){

		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$addressController->viewEdit();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$addressController->editAddress();
		}

	}else if($url == 'account/address/delete'){

		$addressController->delete();
		
	}else if($url == 'account/changePassword/sendMail'){


		$accountController->sendPasswordEmail();

	}else if($url == 'account/changePassword'){

		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$accountController->viewChangePassword();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$accountController->changePassword();
		}
		
	}else if($url == 'account/confirm'){

		$accountController->checkAccount();

	}else if($url == 'account/confirm/sendMail'){

		$accountController->sendConfirmEmail();

	}else if($url == 'review/rate'){

		$reviewController->sendReview();

	}else if($url == 'review/disable'){

		$reviewController->disable();
	}else if($url == 'orders'){

		$paymentController->viewOrders();

	}else if($url == 'order/add'){

		$paymentController->addOrder();

	}else if($url == 'order/details'){

		$paymentController->viewDetails();

	}else if($url == 'payment/process'){

		$paymentController->processPayment();

	}else if($url == 'payment/error'){

		$paymentController->errorHandling();

	}else if($url == 'catalogo' | $url == 'catalogo/' | $url == 'catalogo/processadores' |
	$url == 'catalogo/discosRigidos' | $url == 'catalogo/headsets' | $url == 'catalogo/monitores'
	| $url == 'catalogo/placasDeVideo' | $url == 'catalogo/SSDs' | $url == 'catalogo/placasMaes'
	| $url == 'catalogo/mouses' | $url == 'catalogo/teclados' | $url == 'catalogo/tabletsIpads'
	| $url == 'catalogo/memorias' | $url == 'catalogo/coolers'){

		$catalogoController->view();

	}else if($url == 'sac'){

		$sacController->view();

	}else if($url == 'sac/topic'){

		$sacController->viewTopic();

	}else if($url == 'sac/topic/create'){

		$sacController->createTopic();

	}else if($url == 'sac/topic/delete'){

		$sacController->deleteTopic();

	}else if($url == 'sac/topic/finalizar'){

		$sacController->endTopic();
	}else if($url == 'sac/message/send'){

		$sacController->sendSacMessage();

	}else if($url == 'sac/message/delete'){

		$sacController->deleteMessage();

	}else if($url == 'api/user/get'){
		API::getUser();

	}else if($url == 'api/get-sac-messages'){

	}
?>