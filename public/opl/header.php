<!-- header -->
<header id="s-bar">
    <!-- Logo -->
    <div class="s-logo">
    <a href="<?=BASE_URL?>" title="Auto2000">
        <img src="<?=$this->asset('/img/logo.png')?>" alt="Auto2000">
    </a>
    </div>
    <!-- /.logo -->

    <!-- Product -->
    <div class="s-product">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Progress OPL <span class="badge">APPS</span></a>
    <div class="dropdown-menu">
        <a href="<?=BASE_URL?>/monitoring" class="dropdown-item">DigitalECtrlJob</a>
    </div>
    </div>
    <!-- /.product -->
    <!-- /.app -->
    <div id="s-app" class="s-product">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">APPS</a>
    <div class="dropdown-menu">
        <a href="<?=BASE_URL?>/monitoring" class="dropdown-item">DigitalECtrlJob</a>
    </div>
    </div>
    <!-- /.app -->

    <div class="updatejam"><i class="icon-clock"></i> <span id="oclock"></span></div>    

    <!-- login button -->
    <?php if(isset($_SESSION['iduser_member']) AND isset($_SESSION['iduser'])){ ?>
    <div class="s-btn s-btn-login ml-auto">
    <a href="<?=BASE_URL;?>/member" class="icon-user" title="User"></a>
    </div>
    <?php } else { ?>
    <div class="s-btn s-btn-login ml-auto">
    <a href="<?=BASE_URL;?>/login" class="icon-login" title="Sign In"></a>
    </div>
    <div class="s-btn s-btn-close">
    <a href="<?=BASE_URL;?>/logout" class="icon-close" title="Logout"></a>
    </div>
    <?php } ?>
</header>
<!-- /.header -->