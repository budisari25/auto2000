<!-- Layout -->
<?=$this->layout('member::layout')?>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="page-header mb-3">
            <h3>Selamat Datang</h3>
            <small><?=$user['nama_lengkap'];?> di halaman member</small>
        </div>

        <div class="member-content">
            <div class="row">
                <!-- Proses Service -->
                <div class="col-6 col-md-6">
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-cloud-download"></i></h5>
                            <p class="card-text time"></p>
                        </div>
                        <a href="<?=BASE_URL;?>/member/mana/export">
                        <div class="card-footer info-color-dark">
                            <small class="text-muted white-text">Export Data Tracking</small>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="card mb-2">
                        <a href="<?=BASE_URL;?>/member/mana/user">
                        <div class="card-body primary-color">
                            <h5 class="card-title white-text"><i class="fa fa-users"></i></h5>
                            <p class="card-text white-text">Users</p>
                        </div>
                        <div class="card-footer info-color-dark primary-color-dark">
                            <small class="text-muted white-text">Detail</small>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="card mb-2">
                        <a href="<?=BASE_URL;?>/member/manager/resume-washing">
                        <div class="card-body success-color">
                            <h5 class="card-title white-text"><i class="fa fa-bookmark"></i></h5>
                            <p class="card-text white-text">Resume Washing</p>
                        </div>
                        <div class="card-footer info-color-dark success-color-dark">
                            <small class="text-muted white-text">Detail</small>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <div class="card mb-2">
                        <a href="<?=BASE_URL;?>/member/manager/resume-opl">
                        <div class="card-body success-color-dark">
                            <h5 class="card-title white-text"><i class="fa fa-bookmark"></i></h5>
                            <p class="card-text white-text">Resume OPL</p>
                        </div>
                        <div class="card-footer info-color-dark success-color">
                            <small class="text-muted white-text">Detail</small>
                        </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">           
                    <div class="caption text-center pt-5">
                        <b>Statistik Tracking Hari Ini</b>
                        <a href="<?=BASE_URL;?>/member/manager/5" class="badge badge-info">Lihat Detail</a>
                        </div>
                    <div class="table-responsive">
                        <div id="hero-bar" class="graph"></div>
                    </div>
                </div>
                <div class="col-12"> 
                    <div class="caption text-center pt-5">
                        <b>Statistik Foreman Hari ini</b>
                        <a href="<?=BASE_URL;?>/member/manager/3" class="badge badge-info">Lihat Detail</a>
                        </div>
                    <div class="table-responsive">
                        <div id="hero-bar-foreman" class="graph"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-12">           
                    <div class="caption text-center pt-5">
                        <b>Statistik Tipe Mobil Hari Ini</b>
                    </div>                            
                    <div class="table-responsive">
                        <div id="hero-bar-tipe" class="graph"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add script -->
<?php $this->push('scripts') ?>
    <script>        
        $(document).ready(function() {
            $('.card-text.time').html(moment().format("dddd, MMM Do YYYY"));
            // Bar
            Morris.Bar({
                element: 'hero-bar',
                data: [<?=$this->chart()->bar_sa();?>],
                xkey: 'ket',
                ykeys:['jumlah'],
                labels:['Jumlah'],
                hideHover:'auto',
                xLabelAngle: 35
            });
            // Bar
            Morris.Bar({
                element: 'hero-bar-foreman',
                data: [<?=$this->chart()->bar_foreman();?>],
                xkey: 'ket',
                ykeys:['jumlah'],
                labels:['Jumlah'],
                hideHover:'auto',
                xLabelAngle: 35
            });
            
            // Bar
            Morris.Bar({
                element: 'hero-bar-tipe',
                data: [<?=$this->chart()->bar_tipe();?>],
                xkey: 'ket',
                ykeys:['jumlah'],
                labels:['Jumlah'],
                hideHover:'auto',
                xLabelAngle: 35
            });
        });     
    </script>
<?php $this->end() ?>