<?php 
/** Class Core */
define('CORE_PATH', dirname(__FILE__));

/** Require Vendor */
require_once CORE_PATH."/vendor/autoload.php";

/** Inisialisasi class core*/     
$core = new Racik\Core();

/** Inisialisasi class router */
$router = new Bramus\Router\Router();

/** Alihkan permintaan ke 404, jika router tidak ditemukan */
$router->set404(function() {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    include_once '404.php';
});

/** Memanggil View */
$templates = new League\Plates\Engine();
$templates->addFolder('site',           'public/site/');
$templates->addFolder('login',          'public/login/');
$templates->addFolder('member',         'public/member/');
$templates->addFolder('monitoring',     'public/monitoring/');
$templates->addFolder('opl',         'public/opl/');
$templates->loadExtension(new League\Plates\Extension\Asset('public/assets/'));

/** Memanggil Controllers */
$get_controllers = new Racik\Directory();
$controllers = $get_controllers->listDir(DIR_APP.'/controllers/');
foreach($controllers as $controller) {
    if ($controller != 'index.html') {
        if (file_exists(DIR_APP.'/controllers/'.$controller.'/'.$controller.'.php')) {
            include DIR_APP.'/controllers/'.$controller.'/'.$controller.'.php';
        } else {
            include DIR_APP.'/controllers/'.$controller;
        }
    }
}

// will result home
$router->get('/', function() use($core, $templates){
    // Render template home
    echo $templates->render('site::home');
});

/** Memanggil Model */
$get_models = new Racik\Directory();
$models = $get_models->listDir(DIR_APP.'/models/');
foreach($models as $model) {
    if ($model != 'index.html') {
        if (file_exists(DIR_APP.'/models/'.$model.'/'.$model.'.php')) {
            include_once DIR_APP.'/models/'.$model.'/'.$model.'.php';
        } else {
            include_once DIR_APP.'/models/'.$model;
        }
        // mengambil informasi dari sebuah path file.
        $class = pathinfo($model);
        $model_name = ucfirst($class['filename']);
        $templates->loadExtension(new $model_name());
    }
}

/** Menjalankan router */
$router->run(); 