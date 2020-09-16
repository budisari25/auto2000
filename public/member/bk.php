<!DOCTYPE html>
<html lang="zxx">

<!-- head -->
<head>
    <!-- meta default -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <!-- title -->
    <title>Digimon - View <?=$_SESSION['nobk']?></title>
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
    <link rel="stylesheet" href="<?=$this->asset('/auth/css/style.css')?>">
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

    <div class="_ds-auto2000-container">
        <div class="_ds-auto2000-header" style="background-image: url('<?=$this->asset('/auth/img/bg.jpg')?>')">
            <div class="_ds-auto2000-layout">
                <a href="<?=BASE_URL;?>/logoutbk" class="_ds-logout">Logout</a>

                <div class="_ds-auto2000-user" style="background-image: url('<?=BASE_URL.'/favicon.ico'?>')">

                </div>
                <div class="_ds-auto2000-user-desc">
                    <h5>Nomer Polisi : <?= $_SESSION['nobk'] ?></h5>
                </div>
            </div>
        </div>
        <div class="_ds-auto2000-content">
            <div class="_ds-auto2000-nav-box">
                <div class="_row _grid">
                    <?php if($user['whatsapp']) {?>
                        <a class="_column _grid _l3 _m6 _s12">
                            <div class="_ds-auto2000-box _center">
                                <strong>Whatsapp : </strong> <?=$user['whatsapp'];?>
                            </div>
                        </a>
                    <?php } ?>
                    <?php if($user['email']) {?>
                        <a class="_column _grid _l3 _m6 _s12">
                            <div class="_ds-auto2000-box _center">
                                <strong>Email : </strong> <?=$user['email'];?>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="_ds-auto2000-content">
            <div class="_layout-d">
                <div class="_row _grid">
                    <div class="_column _grid _s12">
                        <?php
                            $core = new Racik\Core();
                            $core->flash->display();
                        ?>
                    </div>
                </div>
            </div>
            <div id="auto2000-result"></div>
            <div class="_ds-auto2000-nav-box">
                <div class="_row _grid">
                    <?php if($semua['sa']) {?>
                        <a class="_column _grid _l3 _m6 _s12">
                            <div class="_ds-auto2000-box _center">
                                <strong>Penerimaan</strong>
                            </div>
                        </a>
                    <?php }?>
                    <?php if($semua['opl']) {?>
                        <a class="_column _grid _l3 _m6 _s12">
                            <div class="_ds-auto2000-box _center">
                                <strong>Job Alokasi</strong>
                            </div>
                        </a>
                    <?php }?>
                    <?php if($semua['fo']) {?>
                        <a class="_column _grid _l3 _m6 _s12">
                            <div class="_ds-auto2000-box _center">
                                <strong>Pengerjaan</strong>
                            </div>
                        </a>
                    <?php }?>
                    <?php if($semua['wa']) {?>
                        <a class="_column _grid _l3 _m6 _s12">
                            <div class="_ds-auto2000-box _center">
                                <strong>Pencucian Mobil</strong>
                            </div>
                        </a>
                    <?php }?>
                </div>
            </div>
        </div>

        <?php if($galleries) { ?>
            <div class="_container">
                <div class="_row _grid">
                    <div class="_column _grid _s12">
                        <h4>Visual Mobil</h4>
                    </div>
                </div>
                <div class="_row _grid">
                    <?php foreach ($galleries as $gallery) { ?>
                        <div class="_column _grid _l3 _m6 _s12">
                            <div class="_ds-gallery" style="background-image: url(<?=BASE_URL?>/res/uploads/medium/medium_<?=$gallery['picture'];?>)">
                                <ul>
                                    <li><a href="<?=BASE_URL?>/res/uploads/<?=$gallery['picture'];?>" data-toggle="tooltip" title="View" target="_blank"><i class="fa fa-search"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php if($user['status']=='Y' || $user['status']=='S' && $user['k_status']=='N'){ ?>
            <div class="_layout-d">
                <div class="_row _grid">
                    <div class="_column _grid _s12">
                        <h4>Beri Kepuasan Anda</h4>
                    </div>
                    <form method="POST" action="<?=BASE_URL ?>/member/bk" class="_column _grid _l12 _m12 _s12">
                        <div class="_ds-polling-user">

                            <div class="_ds-polling-user-img" style="background-image: url(<?=BASE_URL.'/favicon.ico'?>)">

                            </div>
                            <p class="_push-t-s"><?=$_SESSION['nobk']?></p>
                            
                            <div style="text-align: left">
                                <!-- Pelayanan SA -->
                                <div style="font-size: 16px">
                                    1) Pelayanan dan keramahan SA
                                </div>
                                <div class="_ds-polling-user-star">
                                    <div class="_ds-star _ds-star-1"><i class="fa fa-star"></i></div>
                                    <div class="_ds-star _ds-star-2"><i class="fa fa-star"></i></div>
                                    <div class="_ds-star _ds-star-3"><i class="fa fa-star"></i></div>
                                    <div class="_ds-star _ds-star-4"><i class="fa fa-star"></i></div>
                                    <div class="_ds-star _ds-star-5"><i class="fa fa-star"></i></div>
                                </div>
                                <input type="hidden" name="id_tracker" value="<?=$user['id']?>">
                                <input type="hidden" name="nobk" value="<?=$_SESSION['nobk']?>">
                                <input type="hidden" name="pelayanan_sa">
                                <br><br>

                                <!-- Hasil Service -->
                                <div style="font-size: 16px">
                                    2) Hasil service dan Kebersihan Kendaraan
                                </div>
                                <div class="_ds-polling-user-star">
                                    <div class="_ds-star _ds-star-hasil-1"><i class="fa fa-star"></i></div>
                                    <div class="_ds-star _ds-star-hasil-2"><i class="fa fa-star"></i></div>
                                    <div class="_ds-star _ds-star-hasil-3"><i class="fa fa-star"></i></div>
                                    <div class="_ds-star _ds-star-hasil-4"><i class="fa fa-star"></i></div>
                                    <div class="_ds-star _ds-star-hasil-5"><i class="fa fa-star"></i></div>
                                </div>
                                <input type="hidden" name="hasil_service">
                                <br><br>

                                <!-- Waktu Service -->
                                <div style="font-size: 16px">
                                    3) Durasi Waktu Service
                                </div>
                                <p>
                                    <label>
                                        <input name="waktu_service" type="radio" value="3" />
                                        <span>Cepat</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input name="waktu_service" type="radio" value="2" />
                                        <span>Sedang</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input name="waktu_service" type="radio" value="1" />
                                        <span>Lambat</span>
                                    </label>
                                </p>
                                <br><br>

                                <!-- Janji Penyerahan -->
                                <div style="font-size: 16px">
                                    4) Janji Penyerahan
                                </div>
                                <p>
                                    <label>
                                        <input name="penyerahan" type="radio" value="3" />
                                        <span>Cepat</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input name="penyerahan" type="radio" value="2" />
                                        <span>Tepat</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input name="penyerahan" type="radio" value="1" />
                                        <span>Telat</span>
                                    </label>
                                </p>
                                <br><br>

                                <!-- Bersedia Merekomendasikan -->
                                <div style="font-size: 16px">
                                    5) Apakah Bapak/Ibu bersedia merekomendasikan Bengkel <?=CABANG_AUTO?>?
                                </div>
                                <p>
                                    <label>
                                        <input name="rekomendasi" type="radio" value="2" />
                                        <span>Ya</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input name="rekomendasi" type="radio" value="1" />
                                        <span>Tidak</span>
                                    </label>
                                </p><br>
                                <button type="submit" class="_ds-btn-submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>

        <div class="_ds-auto2000-footer">
            <h5 class="_push-b-m"><strong><?=CABANG_AUTO?></strong></h5>
            &copy; <?=date('Y')?> Created by <a href="https://racikproject.com" target="_blank"> RacikID</a>
            <p class="text-center"><small>Version <?=CONF_VER.'.'.CONF_BUILD.' | '.CONF_RELEASE?></small></p>
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
    <script type="text/javascript">
        $(document).ready(function(){
            // function load data Ajax
            const BASE_URL = "<?=BASE_URL?>";
            function load_data(page){  
                $.ajax({  
                    url: BASE_URL + "/member/bk/get-bk",  
                    method:"POST",  
                    data:{page:page},  
                    success:function(data){  
                        $("#auto2000-result").hide().html(data).fadeIn(500);
                    }  
                })  
            };
            load_data();
        });
    </script>

</body>
</html>