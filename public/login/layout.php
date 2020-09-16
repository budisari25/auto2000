<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Informasi Situs -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta http-equiv="Copyright" content="<?=$this->e($page_owner)?>" />
    <meta name="description" content="<?=$this->e($page_desc)?>" />
    <meta name="keywords" content="<?=$this->e($page_key)?>" />
    <meta name="author" content="Boed Winangun" />
    <meta name="robots" content="index, follow" />
    <meta name="language" content="Indonesia" />
    <meta name="revisit-after" content="7" />
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />
    <title><?=$this->e($page_title)?></title>
    <!-- Mobile meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=BASE_URL.'/favicon.ico'?>" type="image/x-icon">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,600">
    <link rel="stylesheet" href="<?=$this->asset('/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('/css/login.css')?>">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="<?=$this->asset('/img/logo.png')?>" width="100" >
					</div>
                    <!-- Alert -->
                    <?php
                    $core = new Racik\Core();
                    $core->flash->display();
                    ?>
                    <!-- Content -->
                    <?=$this->section('content')?>
					<div class="footer">
                        &copy; <?=date('Y')?> Created by <a href="https://racikproject.com" target="_blank"> RacikID</a>                     
                        <p class="text-center">
                            <?php if( CONF_RELEASE == date('d.m.y')) { echo '<div class="badge badge-primary animated bounceIn">New</div>'; }?>
                            <small>Version <?=CONF_VER.'.'.CONF_BUILD.' | '.CONF_RELEASE?></small>
                        </p>
					</div>
				</div>
			</div>
		</div>
	</section>

    <!-- JQuery -->
    <script type="text/javascript" src="<?=$this->asset('/js/jquery-3.3.1.min.js')?>"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?=$this->asset('/js/bootstrap.min.js')?>"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?=$this->asset('/js/login.js')?>"></script>
    <!-- Custom -->
    <?=$this->section('scripts')?>
</body>
</html>