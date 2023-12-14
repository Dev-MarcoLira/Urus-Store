<?php

  $sails = PaymentModel::selectPayments('id', "")->rowCount();
  $canceledSails = PaymentModel::selectPayments('id', "WHERE status = 'cancelada'")->rowCount();

  $users = UserModel::selectUser('*', '')->rowCount();
  $activeUsers = UserModel::selectUser('*', 'WHERE is_active = 1')->rowCount();
  $nonActiveUsers = UserModel::selectUser('*', 'WHERE is_confirmed = 0')->rowCount();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>statistics.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS_SITE; ?>fonts.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>main-menu.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>header.css">
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>footer.css">

    <title>Urus Store</title>
  </head>

  <body>
    
    <div id="menu-trigger">
      <img src="<?php echo PATH_ICONS_SITE; ?>icon_list.png" alt="menu">
    </div>

    <?php include(PATH_VIEWS.'header.php'); ?>

    <main>

      <div class="container">

        <?php include(PATH_VIEWS.'main-menu.php'); ?>

        <section id="right">
          
          <h1>Faturamento da Empresa</h1>

          <canvas id="myChart"></canvas>

          <div id="data">
            
            <div class="row">
              <div>
                <span>Compras</span>
                <span>Totais:</span>
                <span class="number"><?php echo $sails; ?></span>
              </div>
              <div>
                <span>Compras</span>
                <span>Canceladas:</span>
                <span class="number"><?php echo $canceledSails; ?></span>
              </div>
              <div>
                <span>Compras</span>
                <span>Entregues:</span>
                <span class="number">0</span>
              </div>
            </div>
            <div class="row">
              <div>
                <span>Usuários</span>
                <span>Totais:</span>
                <span class="number"><?php echo $users; ?></span>
              </div>
              <div>
                <span>Usuários</span>
                <span>Ativos:</span>
                <span class="number"><?php echo $activeUsers; ?></span>
              </div>
              <div>
                <span>Usuários</span>
                <span>Não-confirmados:</span>
                <span class="number"><?php echo $nonActiveUsers; ?></span>
              </div>
            </div>
          </div>

        </section>

      </div>

    </main>

    <div class="data">
      <?php for($month = 1; $month <= 12; $month++){ ?>
        <div>
          <?php foreach(PaymentModel::selectPayments('SUM(amount)', "WHERE MONTH(created_at) = $month") as $amount)
            echo $amount[0] | 0;
          ?>
        </div>
      <?php } ?>
    </div>

    <?php include(PATH_VIEWS.'footer.php'); ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="<?php echo PATH_SCRIPTS; ?>header.js"></script>
    <script src="<?php echo PATH_SCRIPTS.'main-menu.js'; ?>"></script>
    <script src="<?php echo PATH_SCRIPTS; ?>statistics.js"></script>
    </body>
</html>