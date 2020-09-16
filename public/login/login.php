<!-- Layout -->
<?=$this->layout('login::layout')?>

<div class="card fat">
    <div class="card-body">
        <?php if(!isset($_SESSION['iduser_member'])) { ?>
        <h4 class="card-title">Login</h4>
        <?php } elseif(!empty($_SESSION['namalengkap_member'])) { ?>
        <h4 class="card-title"><?=ucfirst($_SESSION['namalengkap_member'])?></h4>
        <?php } else { ?>
        <h4 class="card-title">Demo</h4>
        <?php } ?>
        <form role="form" id="login-form" method="post" action="<?=BASE_URL;?>/login" autocomplete="off">
            
            <div class="form-group">
                <label for="username">User ID</label>

                <input id="username" type="text" class="form-control" name="username" required autofocus>
            </div>

            <?php if (!isset($_SESSION['iduser_member'])) { ?>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required data-eye>
            </div>
            <?php } ?>

            <div class="form-group no-margin">
                <button type="submit" class="btn btn-primary btn-block">
                    Login
                </button>
            </div>
            <?php if(!isset($_SESSION['iduser_member'])) { ?>
            <div class="margin-top20 text-center">
                Don't have an account? <a href="<?=BASE_URL?>/register">Create One</a>
            </div>
            <?php } else { ?>
            <div class="margin-top20 text-center">
                Back to <a href="<?=BASE_URL?>/monitoring">Home</a>
            </div>
            <?php } ?>
        </form>
    </div>
    <?php if (isset($_SESSION['iduser_member']) AND $demo['term'] == 0) { ?>
    <div class="card-footer text-center">
        <?php 
            $dtTime = new Racik\DateTime();
            $selisih = $dtTime->selisih_tgl($demo['tgl_daftar']) ?>
        <h5>Account Demo: <div class="badge badge-info">Free <?=14-$selisih?> day</div></h5>
		<ul class="list-group">
			<li class="list-group-item d-flex justify-content-between align-items-center">          
				<small>UserID: <b>demosa</b></small>
				<div class="badge badge-primary">SA</div>
			</li>
            <li class="list-group-item d-flex justify-content-between align-items-center">          
                <small>UserID: <b>demoopl1</b></small>
                <div class="badge badge-primary">OPL 1</div>
            </li>
			<li class="list-group-item d-flex justify-content-between align-items-center">  
				<small>UserID: <b>demoopl</b></small>
				<div class="badge badge-primary">PTM</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">  
				<small>UserID: <b>demoforeman</b></small>
				<div class="badge badge-primary">Foreman</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">  
				<small>UserID: <b>demowa</b></small>
				<div class="badge badge-primary">Washing</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">  
				<small>UserID: <b>demomanager</b></small>
				<div class="badge badge-primary">Manager</div>
			</li>
		</ul>
    </div>
    <?php } ?>
</div>

<!-- Add script -->
<?php $this->push('scripts') ?>
    <!-- Console.log -->
<?php $this->end() ?>