<?php

	require_once(PATH_VIEWS.'notification.php');
    require_once(PATH_VIEWS.'modal-confirm.php');

	$users = UserModel::getUser();
	$id = Login::getId();

	$gender = $users['gender'];
	$birth = $users['birth'];

	//$userAddresses = UserAddressModel::getAddresses('*', "where user_id = $id");
	$id = UserModel::getUser()[0];
	
	$query = "SELECT a.* FROM addresses AS a, users_addresses AS b WHERE a.id = b.address_id AND b.user_id = $id";

	$userAddresses = MySQL::freeSelect($query);

	if(isset($_SESSION['changePassword_error'])){
		$error = $_SESSION['changePassword_error'];
		setFlag('active', 'Erro', $error);
		$_SESSION['changePassword_error'] = null;
	}else{
		if(isset($_SESSION['changePassword_success'])){
			$msg = $_SESSION['changePassword_success'];
			setFlag('active', 'Sucesso', $msg);
			$_SESSION['changePassword_success'] = null;
		}
	}

	if(isset($_SESSION['checkMail_error'])){
		$error = $_SESSION['checkMail_error'];
		setFlag('active', 'Erro', $error);
		$_SESSION['checkMail_error'] = null;
	}else{
		if(isset($_SESSION['checkMail_success'])){
			$msg = $_SESSION['checkMail_success'];
			setFlag('active', 'Sucesso', $msg);
			$_SESSION['checkMail_success'] = null;
		}
	}

	if(isset($_SESSION['address_error'])){
		$errorMsg = $_SESSION['address_error'];
		setFlag('active', 'Erro', $errorMsg);
		$_SESSION['address_error'] = null;
	}else{
		if(isset($_SESSION['address_success'])){
			$msg = $_SESSION['address_success'];
			setFlag('active', 'Sucesso', $msg);
			$_SESSION['address_success'] = null;
		}
	}

	if(isset($_SESSION['account_error'])){
		$errorMsg = "<h1 class='error'>".$_SESSION['account_error']."</h1>";
		setFlag('active', 'Erro', $errorMsg);
		$_SESSION['account_error'] = null;
	}else{
		if(isset($_SESSION['account_success'])){
			$msg = $_SESSION['account_success'];
			setFlag('active', 'Sucesso', $msg);
			$_SESSION['account_success'] = null;
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Apolo Store</title>

	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>account.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>fonts.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>notification.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS_PANEL; ?>password_modal.css">

</head>
<body>

	<?php include(PATH_VIEWS.'header.php'); ?>

	<main>
		<div class="container">
			<h1>Configurações da conta</h1>
			<div id="main">
				<section id="personal-info">

					<h3 class="subtitle">Dados pessoais</h3>

					<div class="wrapper">
						<div>
							<div class="center">
								<h2>Nome</h2>
								<h3><?php echo $users['name']; ?></h3>
							</div>
						</div>
						<div>
							<div class="center">
								<h2>E-mail</h2>
								<h3><?php echo $users['email']; ?></h3>

								<?php if(UserModel::isConfirmed()){ ?>
									<span id="checked">E-mail confirmado</span>
								<?php }else{
									$_SESSION['checkMail'] = true;
								?>

									<span id="not-checked"><a href="<?php echo FULL_PATH_ACCOUNT; ?>/confirm/sendMail">Confirmar E-mail</a></span>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="wrapper">
						<div>
							<div class="center">
								<h2>CPF</h2>
								<h3 id="cpf"><?php echo $users['cpf']; ?></h3>
							</div>
						</div>
						<div>
							<div class="center">
								<h2>Senha</h2>
								<h3>*********</h3>
								<span id="password"><a href="<?php echo FULL_PATH_ACCOUNT; ?>/changePassword/sendMail">Editar</a></span>
							</div>
						</div>
					</div>
					<div class="wrapper">
						<div>
							<div class="center">
								<h2>Gênero</h2>
								<h3><?php echo $gender ?></h3>
							</div>
						</div>
						<div>
							<div class="center">
								<h2>Data de Nascimento</h2>
								<h3><?php echo $birth ?></h3>
							</div>
						</div>
					</div>

					<a id="edit-account" class="links" href="<?php echo FULL_PATH_ACCOUNT; ?>/edit">Editar Conta</a>

				</section>

				<section id="address-info">

					<?php 
						
						if($userAddresses->rowCount() > 0){

					?>

					<h3 class="subtitle">Dados de endereço</h3>

					<?php
							foreach($userAddresses as $userAddress){
								$complemento = $userAddress['complemento'] == 'DEFAULT' ? '' : $userAddress['complemento'];
					?>

					<div class="wrapper">
						
						<div>
							<div class="center">
								<h2>País</h2>
								<h3>Brasil</h3>
							</div>
						</div>
						<div>
							<div class="center">
								<h2>Estado</h2>
								<h3><?php echo $userAddress['estado']; ?></h3>
							</div>
						</div>

					</div>

					<div class="wrapper">
						
						<div>
							<div class="center">
								<h2>Cidade</h2>
								<h3><?php echo $userAddress['cidade']; ?></h3>
							</div>
						</div>

						<div>
							<div class="center">
								<h2>Bairro</h2>
								<h3><?php echo $userAddress['bairro']; ?></h3>
							</div>	
						</div>

					</div>

					<div class="wrapper">
						
						<div>
							<div class="center">
								<h2>Endereço</h2>
								<h3><?php echo $userAddress['endereco']; ?></h3>
							</div>
						</div>
						<div>
							<div class="center">
								<h2>Complemento</h2>
								<h3><?php echo $complemento; ?></h3>
							</div>
						</div>
					</div>

					<div class="wrapper">
						
						<div>
							<div class="center">
								<h2>CEP</h2>
								<h3 id="cep"><?php echo $userAddress['cep']; ?></h3>
							</div>
						</div>
						<div>
							<div class="center">
								<h2>Número</h2>
								<?php if($userAddress['numero'] != 0){ ?>
									<h3><?php echo $userAddress['numero']; ?></h3>
								<?php } ?>
								
							</div>
						</div>

					</div>

					<div class="links">
						<a id="edit-address" href="<?php echo FULL_PATH_ACCOUNT; ?>/address/edit?id=<?php echo $userAddress['id']; ?>">Editar Endereço</a>
						<a id="edit-address" class="confirm-modal-trigger" href="<?php echo FULL_PATH_ACCOUNT; ?>/address/delete?addressId=<?php echo $userAddress['id']; ?>">Remover Endereço</a>
						
					</div>

					<?php }} ?>

					<?php if($userAddresses->rowCount() < 3){ ?>
						<a id="create-address" class="links" href="<?php echo FULL_PATH_ACCOUNT; ?>/address/create">Adicionar Endereço</a>
					<?php } ?>

				</section>
			</div>
		</div>
	</main>

	<?php include(PATH_VIEWS.'footer.php'); ?>

	<script src="<?php echo PATH_SCRIPTS; ?>showMaskedInfo.js"></script>
	<script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>globals.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>notification.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>modal-confirm.js"></script>

</body>
</html>