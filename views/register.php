<?php

  require_once(PATH_VIEWS.'notification.php');

  if(isset($_SESSION['register_error'])){
    $errorMsg = $_SESSION['register_error'];
    setFlag('active', 'Erro', $errorMsg);
    $_SESSION['register_error'] = null;
  }

?>

<!DOCTYPE html>
<html>
<head> 
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>fonts.css">
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>cad.css">  
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>footer.css">  
  <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS ?>notification.css">  

  <title>Apolo Store</title> 
</head>
<body> 

  <div class="overlay">
    <div class="main-login"> 
      <div class="left-login"> 
      
      <div class="overlay">
        <div id="form-container">
          <form name="f1" autocomplete="off" method="post">

            <h1 id="main">CADASTRO</h1>
          
            <label class="text" for="Nome"> Nome </label>
          
            <input type="text" name="nome" maxlength="50" required placeholder="DIGITE SEU NOME COMPLETO">

            
            <label class="text" for="email"> E-mail </label>
          
            <input type="email" name="email" maxlength="100" required placeholder="DIGITE SEU E-MAIL">

            <label class="text" for="sexo"> Sexo </label>

            <div id="sexo">
              

              <input type="radio" name="sexo" id="masc" value="M">
              <label for="op">Masc</label>

              
              <input type="radio" name="sexo" value="F" id="F">
              <label>Fem</label> 

              <input type="radio" name="sexo" value="O" id="outro">
              <label>n/b</label>

            </div>
            
            <label class="text" for="senha"> Senha </label>
          
            <input type="password" name="senha" id="password" minlength="6" maxlength="12"
              onKeyUp="verificaForcaSenha()" required placeholder="DIGITE SUA SENHA" />
            <span id="password-status"></span>
            
            
            <label class="text" for="confirm_passwd"> Confirme Sua Senha </label> 
            
            <input type="password" required id="password2" name="confirm-passwd" minlength="6" maxlength="12"
            placeholder="DIGITE SUA SENHA">
            <span id="confirm-passwd-status"></span>
            
            <input type="submit" name="registerAction" value="Cadastrar" onclick="verificaForcaSenha()">
              
            <h2> Ou </h2> 
            <a href="<?php echo FULL_PATH_SITE ?>"> <h1> Faça Seu Login </h1> </a>
            </form>
          
            <?php include(PATH_VIEWS.'footer.php'); ?>          

          </div>
        </div>
      </div>
      
    

      <div class="right-login">
      
        <div class="overlay"></div>
      
     </div>
    </div>
  </div>

  <script src="<?php echo PATH_SCRIPTS ?>jquery.js"></script>
  <script src="<?php echo PATH_SCRIPTS ?>cad.js"></script>
  <script src="<?php echo PATH_SCRIPTS ?>verifyPassword.js"></script>
  <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>globals.js"></script>
  <script type="text/javascript" src="<?php echo PATH_SCRIPTS ?>notification.js"></script>
</body>
</html>

 
  
 