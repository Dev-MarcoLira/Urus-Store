
<header>

	<div class="container">

	  <a href="<?php echo FULL_PATH_SITE; ?>">
        <div class="logo"></div>
    </a>

    <ul>

      <div id="login">

        <li><a id="account"><img src="<?php echo PATH_ICONS; ?>login-icon.png"></a></li>

        <div id="wrapper">
          <ul class="disabled">
            <li><a href="<?php echo FULL_PATH_ACCOUNT; ?>">Minha conta</a></li>
            <li><a href="<?php echo FULL_PATH_SITE; ?>orders">Pedidos</a></li>
            <li><a href="<?php echo FULL_PATH_ACCOUNT; ?>/reviews">Avaliações</a></li>
            
            <?php if(isset($_SESSION['login'])){ ?>
              <li><a id="loggout" href="<?php echo FULL_PATH_SITE; ?>logout">Logout</a></li>
            <?php }else{ ?>
              <li><a id="loggout" href="<?php echo FULL_PATH_SITE; ?>login">Login</a></li>
            <?php } ?>

          </ul>
        </div>
      </div>

      <li><a href=" <?php echo FULL_PATH_SITE; ?>cart "><img src="<?php echo PATH_ICONS; ?>cart-icon.png"></a></li>
      <li><a href="<?php echo FULL_PATH_SITE; ?>sac "><img src="<?php echo PATH_ICONS; ?>sac-icon.png"></a></li>

    </ul>

	</div>


	<section class="find">

    <div class="search-container">
      <form action="<?php echo FULL_PATH_SITE; ?>catalogo" method="get">
        
          <input type="text" required name="search">
          <div class="img-box">
            <img src="<?php echo PATH_ICONS; ?>search.png" alt="search icon'">
          </div>
          <input type="submit">
      </form>
    </div>

    <div class="categories">
      <ul>
        <li><a href="<?php echo FULL_PATH_SITE; ?>">INÍCIO</a></li>
        <li><a href="<?php echo FULL_PATH_SITE; ?>promotions">PROMOÇÕES</a></li>
        <li><a href="<?php echo FULL_PATH_SITE;; ?>trending">DESTAQUES</a></li>
        <li><a href="<?php echo FULL_PATH_SITE; ?>catalogo">CATÁLOGO</a></li>
      </ul>
    </div>
  </section>
  <hr>
</header>

