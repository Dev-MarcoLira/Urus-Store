<?php

	session_start();
	include('config.php');
	
	$sql = "SELECT a.id FROM products AS a INNER JOIN discounts_products AS b ON a.id = b.product_id";
	
	foreach(MySQL::freeSelect($sql) as $productId){
		try{

			ProductModel::controlDiscountTime($productId[0]);

		}catch(Throwable $error){
			continue;
		}
	}

	$sql = null;

	$url = !empty($_GET['url']) ? $_GET['url'] : 'main';

	if(empty($_SESSION['panel'])){
		if($url != 'login' & $url != 'login/account'){
			Login::redirect(FULL_PATH_PANEL.'login');
		}
	}

	/* controllers */

	$chatController = new ChatController();
	$loginController = new LoginController();
	$estoqueController = new EstoqueController();
	$andController = new AndController();
	$categoryController = new CategoryController();
	$productController = new ProductController();
	$discountController = new DiscountController();
	$statisticsController = new StatisticsController();
	$markController = new MarkController();
	$mainController = new MainController();
	$imageController = new ImageController();
	$orderController = new OrderController();
	$settingsController = new SettingsController();

	/* Route validations */

	if($url == 'main'){

		$mainController->index();
	}else if($url == 'login'){

		$loginController->index();
	}else if($url == 'login/account'){

		$loginController->login();
	}else if($url == 'logout'){

		$loginController->loggout();
	}else if($url == 'estoque'){

		$estoqueController->index();
	}else if($url == 'estoque/products'){

		$estoqueController->viewProducts();

	}else if($url == 'estoque/categories'){

		$estoqueController->viewCategories();

	}else if($url == 'estoque/discounts'){

		$estoqueController->viewDiscounts();

	}else if($url == 'estoque/marks'){

		$estoqueController->viewMarks();

	}else if($url == 'and'){

		$andController->index();
	}else if($url == 'category'){

		$categoryController->index();
	}else if($url == 'category/create'){

		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$categoryController->viewCreate();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$categoryController->create();
		}
	}else if($url == 'category/edit'){

		$categoryController->edit();
	}else if($url == 'category/delete'){

		$categoryController->delete();
	}else if($url == 'category/enable'){

		$categoryController->enable();
	}else if($url == 'category/disable'){

		$categoryController->disable();
	}else if($url == 'product'){

		$productController->index();
	}else if($url == 'product/create'){
		
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$productController->viewCreate();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$productController->create();
		}
	}else if($url == 'product/edit'){

		$productController->edit();
	}else if($url == 'product/delete'){

		$productController->delete();
	}else if($url == 'product/enable'){

		$productController->enable();
	}else if($url == 'product/disable'){

		$productController->disable();
	}else if($url == 'discount'){

		$discountController->index();
	}else if($url == 'discount/create'){

		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$discountController->viewCreate();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$discountController->create();
		}
	}else if($url == 'discount/edit'){

		$discountController->edit();
	}else if($url == 'discount/delete'){

		$discountController->delete();
	}else if($url == 'discount/deleteDiscountByProduct'){

		///$discountController->deleteByProduct();
	}else if($url == 'discount/enable'){

		$discountController->enable();
	}else if($url == 'discount/disable'){

		$discountController->disable();
	}else if($url == 'marca'){

		$markController->index();
	}else if($url == 'marca/create'){

		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$markController->viewCreate();
		}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$markController->create();
		}
	}else if($url == 'marca/edit'){

		$markController->edit();
	}else if($url == 'marca/delete'){

		$markController->delete();
	}else if($url == 'marca/enable'){

		$markController->enable();
	}else if($url == 'marca/disable'){

		$markController->disable();
	}else if($url == 'image/delete'){
		
		$imageController->delete();
	}else if($url == 'sac'){

		$chatController->view();

	}else if($url == 'sac/novos' || $url == 'sac/em-aberto' || $url == 'sac/finalizados'){

		$chatController->viewTemplate($url);
	}else if($url == 'sac/topic'){

		$chatController->viewTopic();

	}else if($url == 'sac/topic/delete'){

		$chatController->deleteTopic();

	}else if($url == 'sac/topic/finalizar'){

		$chatController->endTopic();

	}else if($url == 'sac/message/send'){

		$chatController->sendSacMessage();

	}else if($url == 'sac/message/delete'){

		$chatController->deleteMessage();

	}else if($url == 'statistics'){

		$statisticsController->view();

	}else if($url == 'vendas'){

		$orderController->view();

	}else if($url == 'settings'){

		$settingsController->view();
	}else if($url == 'settings/user/disable'){

		$settingsController->disable();
	}else if($url == 'settings/user/register'){

		$settingsController->register();
		
	}else if($url == 'api/admin/check-password'){

		API::checkSelfAdminPassword();

	}else if($url == 'api/get-sac-messages'){

		$chatController->getMessages();
	}else if($url == 'api/get-order-items'){

		API::getOrderItems();

	}else{
		Login::redirect(FULL_PATH_PANEL);
	}
?>