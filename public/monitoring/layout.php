<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Digital E-Monitoring Control Job">
    <meta name="author" content="Racikproject">
    <meta name="keyword" content="monitoring, service, auto2000, Digital E-Monitoring Control Job">
    <!-- Icons -->
    <link rel="stylesheet" href="<?=$this->asset('/vendors/simple-line-icons/css/simple-line-icons.css')?>">
    <!-- Style -->
    <link rel="stylesheet" href="<?=$this->asset('/css/digimon.min.css')?>">
    <link rel="stylesheet" href="<?=$this->asset('/css/digimon_custom.css')?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"> 
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?=BASE_URL;?>/favicon.ico" />
    <title>Digital E-Monitoring Control Job</title>
  </head>
  <body class="o-wrap">
    <!-- insert header -->
    <?=$this->insert('monitoring::header')?>

    <!-- body -->
    <main id="body" class="d-flex justify-content-center">
      <!-- Alert -->
      <?php
      $core = new Racik\Core();
      $core->flash->display();
      ?>
      <!-- Insert Content -->
      <?=$this->section('content');?>  
    </main>
    <!-- /.body -->

    <!-- Insert Footer -->
    <?=$this->insert('monitoring::footer')?>

    <!-- Script -->
    <script src="<?=$this->asset('/vendors/jquery/js/jquery.min.js')?>"></script>
    <script src="<?=$this->asset('/vendors/popper.js/js/popper.min.js')?>"></script>
    <script src="<?=$this->asset('/vendors/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?=$this->asset('/vendors/pace-progress/js/pace.min.js')?>"></script>
    <script src="<?=$this->asset('/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js')?>"></script>
    <script src="<?=$this->asset('/vendors/@racikui/racikui-bootstrap/js/racikui.min.js')?>"></script>
    <script src="<?=$this->asset('/js/addons/moment.min.js')?>"></script>
    <script src="<?=$this->asset('/js/monitoring.js')?>"></script>
    <?=$this->section('scripts')?>
    <script>
      var BASE_URL = '<?=BASE_URL;?>';
      $('[data-toggle="tooltip"]').tooltip();
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122515133-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-122515133-1');
    </script>
  </body>
</html>