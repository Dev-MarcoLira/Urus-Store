<?php

	$email = $_SESSION['login'];
	$users = UserModel::selectUser('*',"where email= '$email'");

	foreach($users as $usr) $users = $usr;


	function checkGender($sex){
		$gender = UserModel::getGender(Login::getId());
		
		if($gender == $sex){
			return 'checked';
		}else
			return;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Apolo Store</title>

	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>fonts.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>editAccount.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>footer.css">

</head>
<body>

	<?php include(PATH_VIEWS.'header.php'); ?>

	<main>
		
		<section class="container" id="form-container">

			<form method="post" action="<?php echo FULL_PATH_ACCOUNT; ?>/edit" autocomplete="off">
			
				<div class="wrapper">
					<label>Nome*</label>
					<input type="text" name="name" minlength="10" maxlength="50" required value="<?php echo $users['name']; ?>">
				</div>

				<div class="wrapper">
					<label>E-mail*</label>
					<input type="email" name="email" maxlength="100" required value="<?php echo $users['email']; ?>">
				</div>

				<div class="wrapper">
					<label>CPF*</label>
					<input type="text" id="cpf" name="cpf" value="<?php echo $users['cpf']; ?>" maxlength="14">
				</div>

				<div class="wrapper">
					<label>Data de Nascimento*</label>
					<input type="date" name="birth" required value="<?php echo $users['birth']; ?>">
				</div>	

				<div class="wrapper">
					<label>Gênero*</label>

					<div>
						<legend>Masculino</legend>
						<input type="radio" name="gender" <?php echo checkGender('M'); ?> required value="M">
					</div>

					<div>
						<legend>Feminino</legend>
						<input type="radio" name="gender" required <?php echo checkGender('F'); ?> value="F">
					</div>

					<div>
						<legend>Outro</legend>
						<input type="radio" name="gender" required <?php echo checkGender('O'); ?> value="O">
					</div>
				</div>

				<input type="submit" name="editAccount" value="Enviar">

			</form>

		</section>

	</main>

	<?php include(PATH_VIEWS.'footer.php'); ?>

    <script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>showInputMaskedCpf.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>editAccount.js"></script>
	<script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>account-menu.js"></script>
    <script type="text/javascript" src="<?php echo PATH_SCRIPTS; ?>globals.js"></script>
</body>
</html>