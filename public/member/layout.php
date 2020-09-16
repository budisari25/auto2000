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
    <link rel="stylesheet" href="<?=$this->asset('/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('/css/font-awesome.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('/css/mdb.min.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('/css/addons/datatables.min.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('/css/member.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('/css/morris.css')?>">
</head>
<body class="fixed-sn mdb-skin">
    <!-- insert header -->
    <?=$this->insert('member::partials/header')?>

    <!--Main Layout-->
    <main>
        <div class="container-fluid">            
            <!-- Alert -->
            <?php
            $core = new Racik\Core();
            $core->flash->display();
            ?>
            <!-- Insert Content -->
            <?=$this->section('content');?> 
        </div>
    </main>
    <!--Main Layout-->

    <!-- insert footer -->
    <?=$this->insert('member::partials/footer')?>

    <!-- Javascript -->
    <script type="text/javascript" src="<?=$this->asset('/js/jquery-3.3.1.min.js')?>"></script>
    <script type="text/javascript" src="<?=$this->asset('/js/popper.min.js')?>"></script>
    <script type="text/javascript" src="<?=$this->asset('/js/bootstrap.min.js')?>"></script>
    <script type="text/javascript" src="<?=$this->asset('/js/addons/datatables.min.js')?>"></script>
    <script type="text/javascript" src="<?=$this->asset('/js/mdb.min.js')?>"></script>
    <script type="text/javascript" src="<?=$this->asset('/js/core.js')?>"></script>
    <script type="text/javascript" src="<?=$this->asset('/js/raphael-min.js')?>"></script>
    <script type="text/javascript" src="<?=$this->asset('/js/morris.min.js')?>"></script>
    <script type="text/javascript" src="<?=$this->asset('/js/addons/moment.min.js')?>"></script>
	<script type="text/javascript">
        var BASE_URL = '<?=BASE_URL;?>';
	</script>
    <?=$this->section('scripts')?>
</body>
</html>