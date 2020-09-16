<!--Double navigation-->
<header>
	<!-- Navbar -->
	<nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
		<!-- SideNav slide-out button -->
		<div class="float-left">
			<a href="<?=BASE_URL;?>/member" data-activates="slide-out" class="button-collapse">Monitoring Service</a>
		</div>
		<ul class="nav navbar-nav nav-flex-icons ml-auto">
			<li class="nav-item">
				<?php if(isset($_SESSION['leveluser']) AND $_SESSION['leveluser'] == '5') { ?>
				<a href="<?=BASE_URL;?>/member/t/addnew" style="color:#3498db !important;">
					<span style="color: #fff">Tambah Data</span>
					<span class="fa-stack fa-lg">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-plus fa-stack-1x fa-inverse"></i>
					</span>
				</a>
				<?php } elseif(isset($_SESSION['leveluser']) AND $_SESSION['leveluser'] == '8' OR $_SESSION['leveluser'] == '9') { ?>
				<a href="<?=BASE_URL;?>/member/m/addnew" style="color:#3498db !important;">
					<span class="fa-stack fa-lg">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-plus fa-stack-1x fa-inverse"></i>
					</span>
				</a>
				<?php } elseif(isset($_SESSION['leveluser']) AND $_SESSION['leveluser'] == '6') { ?>
				<a href="<?=BASE_URL;?>/member/user/addnew" style="color:#3498db !important;">
					<span class="fa-stack fa-lg">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-plus fa-stack-1x fa-inverse"></i>
					</span>
				</a>
				<?php } elseif(isset($_SESSION['leveluser']) AND $_SESSION['leveluser'] == '10') { ?>
				<a href="<?=BASE_URL;?>/member/r/addnew" style="color:#3498db !important;">
					<span class="fa-stack fa-lg">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-plus fa-stack-1x fa-inverse"></i>
					</span>
				</a>
				<?php } ?>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-bars"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
					<?php if(isset($_SESSION['leveluser']) AND $_SESSION['leveluser'] == '8' OR $_SESSION['leveluser'] == '9') { ?>
					<a class="dropdown-item" href="<?=BASE_URL;?>/monitoring"><i class="fa fa-home">&nbsp;</i> <?=$this->e('Front End');?></a>
					<?php } else { ?>
					<a class="dropdown-item" href="<?=BASE_URL;?>/opl"><i class="fa fa-home">&nbsp;</i> <?=$this->e('Front End');?></a>
					<?php } ?>
					<a class="dropdown-item" href="<?=BASE_URL;?>/logoutuser"><i class="fa fa-power-off">&nbsp;</i> <?=$this->e('Logout');?></a>
				</div>
			</li>
		</ul>
	</nav>
	<!-- /.Navbar -->
</header>
<!--/.Double navigation-->