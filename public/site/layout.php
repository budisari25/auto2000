<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Informasi Situs -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="author" content="Boed Winangun" />
    <meta name="robots" content="index, follow" />
    <meta name="language" content="Indonesia" />
    <meta name="revisit-after" content="7" />
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />
    <title><?=CONF_STRUCTURE?></title>
    <!-- Mobile meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=BASE_URL.'/favicon.ico'?>" type="image/x-icon">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,600">
    <link rel="stylesheet" href="<?=$this->asset('/css/site.css')?>">
</head>
<body>
    <!-- insert header -->
    <?=$this->insert('site::header')?>

    <!-- Content -->
    <?=$this->section('content')?>

    <!-- Insert Footer -->
    <?=$this->insert('site::footer')?>

    <!-- Javascript -->
    <?=$this->section('scripts')?>
</body>
</html>