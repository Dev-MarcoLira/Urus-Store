<?php

    date_default_timezone_set('America/Sao_Paulo');

    include('autoloader.php');

    spl_autoload_register($autoload);

    define('FULL_PATH_SITE', 'http://localhost/UrusStore/');
    define('FULL_PATH_PANEL', FULL_PATH_SITE.'panel/');
    define('FULL_PATH_CATALOGO', FULL_PATH_SITE.'catalogo');
    define('FULL_PATH_ACCOUNT', FULL_PATH_SITE.'account');
    define('FULL_PATH_CART', FULL_PATH_SITE.'cart');
    define('FULL_PATH_UPLOADS', FULL_PATH_PANEL.'uploads/');

    define('FULL_PATH', '');
    define('PATH_CONTROLLERS', FULL_PATH.'controllers/');
    define('PATH_VIEWS', FULL_PATH.'views/');
    define('PATH_IMAGES', FULL_PATH_SITE.PATH_VIEWS.'images/');
    define('PATH_SRC', PATH_VIEWS.'src/');
    define('PATH_MODELS', FULL_PATH.'models/');
    
    define('PATH_ICONS', PATH_IMAGES.'icons/');
    define('PATH_CATALOGO', PATH_SRC.'catalogo/');
    define('PATH_ACCOUNT', PATH_SRC.'account/');

    define('PATH_CSS', FULL_PATH_SITE.PATH_VIEWS.'css/');
    define('PATH_CSS_PANEL', FULL_PATH_PANEL.PATH_VIEWS.'css/');
    define('PATH_SCRIPTS', FULL_PATH_SITE.PATH_VIEWS.'scripts/');

    define('PATH_UPLOADS', 'panel/uploads/');
    define('PATH_DEPARTAMENTOS', FULL_PATH.'catalogo/');
    
    include('dbconfig.php');

?>