<!DOCTYPE html>
<html lang="zxx">

<!-- head -->
<head>
    <!-- Informasi Situs -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!-- favicon -->
    <link rel="icon" href="<?=BASE_URL.'/favicon.ico'?>" type="image/x-icon">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet"> 
    <!-- icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- mnel@alpha.style.js -->
    <script src="https://cdn.jsdelivr.net/npm/coconut.gun@1.0.1/mnel@alpha.style.js" integrity="sha256-YqcQukwL77+HsivItnpddVE8F3tWQALa/xp5CvmPHcA=" crossorigin="anonymous"></script>
    <!-- style.css -->
    <link rel="stylesheet" href="<?=$this->asset('/auth/css/style.css') ?>">
</head>
<!-- end head -->

<!-- body -->
<body>

    <!-- alert dont support IE -->
    <div id="_IE-Alert"></div>
    <!-- end alert dont support IE -->

    <!-- cursor -->
    <div class="cursor">
        <div class="cursor__inner cursor__inner--circle"></div>
        <div class="cursor__inner cursor__inner--dot"></div>
    </div>
    <!-- end cursor -->

    <div class="_auto2000-container">
        <div class="_auto2000-header">
            <div class="_auto2000-slideshow">
                <div class="_auto2000-mover-1"></div>
            </div>
        </div>
        <div class="_auto2000-hero">
            <h2 class="_push-b-m"><strong>Auto<span class="_nel-red-auto2000">2000</span></strong></h2>
            <p class="_layout-t">Cabang <?=CABANG_AUTO?></p>
            <!-- Alert -->
            <p class="_layout-t">
                <?php
                    $core = new Racik\Core();
                    $core->flash->display();
                ?>
            </p>  
        </div>
        <div class="_auto2000-option">
            <?php if(!isset($_SESSION['iduser_member'])) { ?>
                <h5 class="_push-b-d">Pilih Login</h5>
            <?php } elseif(!empty($_SESSION['namalengkap_member'])) { ?>
                <h5 class="_push-b-d"><?=ucfirst($_SESSION['namalengkap_member'])?></h5>
            <?php } else { ?>
                <h5 class="_push-b-d">Login</h5>
            <?php } ?>
                <div class="_auto2000-client">
                Karyawan
            </div>
            <div class="_auto2000-BK">
                Pelanggan
            </div>
        </div>
        <div class="_window"></div>
        <div class="_auto2000-client-content">
            <h4>Login Karyawan</h4>

            <form role="form" id="login-form" method="post" action="<?=BASE_URL;?>/login" autocomplete="off">
                <div class="input-field _push-t-g">
                    <i class="material-icons prefix">person_pin</i>
                    <input id="username" type="text" class="validate" name="username" required>
                    <label for="username">Username</label>
                    <span class="helper-text" data-error="Wajib diisi" data-success="OK"></span>
                </div>

                <?php if (!isset($_SESSION['iduser_member'])) { ?>
                    <div class="input-field _push-t-m">
                        <i class="material-icons prefix">verified_user</i>
                        <input id="password" type="password" class="validate" name="password" required data-eye>
                        <label for="password">Password</label>
                        <span class="helper-text" data-error="Wajib diisi" data-success="OK"></span>
                        <?php if(!isset($_SESSION['iduser_member'])) { ?>
                        <a href="<?=BASE_URL?>/forgot" class="waves-effect">
                            Forgot Password?
                        </a>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="input-field _push-t-m">
                    <button class="btn waves-effect green waves-light" type="submit" name="action">Login
                        <i class="material-icons right">send</i>
                    </button>
                </div>
                <?php if(!isset($_SESSION['iduser_member'])) { ?>
                <!-- <div class="margin-top20 text-center">
                    Don't have an account? <a href="<?=BASE_URL?>/register">Create One</a>
                </div> -->
                <?php } else { ?>
                <div class="margin-top20 text-center">
                    Back to <a href="<?=BASE_URL?>/monitoring">Home</a>
                </div>
                <?php } ?>
            </form>
        </div>
        <div class="_auto2000-BK-content">
            <h4>Login Pelanggan</h4>
            <form role="form" id="login-form" method="post" action="<?=BASE_URL;?>/bk" autocomplete="off">
                <div class="input-field _push-t-g">
                    <i class="material-icons prefix">perm_data_setting</i>
                    <input id="icon_prefix3" name="nobk" type="text" class="validate">
                    <label for="icon_prefix3">No. Polisi</label>
                </div>
                <div class="input-field _push-t-m">
                    <button class="btn waves-effect green waves-light" type="submit" name="action">Login
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>  
        </div>
    </div>

    <!-- mnel.alpha.combine.js -->
    <script src="https://cdn.jsdelivr.net/npm/coconut.gun@1.0.1/mnel@alpha.combine.js" integrity="sha256-BUBowUKTPtcsrpDFolz7wP8oJ59QrNsN+GyHaM+jOTA=" crossorigin="anonymous"></script>
    <!-- mnel.alpha.main.js -->
    <script src="https://cdn.jsdelivr.net/npm/coconut.gun@1.0.1/mnel@alpha.main.js" integrity="sha256-wkr4lpxQfCrQMuFtRpuAvRaucfa9edKAswGEgwZ6qHE=" crossorigin="anonymous"></script>
    <!-- ie@alert -->
    <script src="<?=$this->asset('/auth/js/ie@alert.js')?>"></script>
    <!-- script -->
    <script src="<?=$this->asset('/auth/js/script.js')?>"></script>

</body>
</html>