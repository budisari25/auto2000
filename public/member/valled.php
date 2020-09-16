<!-- Layout -->
<?=$this->layout('member::layout')?>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="page-header mb-3">
            <h3>Selamat Datang</h3>
            <small><?=$user['nama_lengkap'];?> di halaman member</small>
        </div>

        <div class="row">          
            <?php
            /**
             * Notif Tracking Penyerahan Mobil
             */
                $notif = $this->core()->call->db->from('tracker')
                ->where('w_status = :fs', array(':fs' => 'Y'))
                ->where('member = :etm', array(':etm' =>$user_member['id_user']))
                ->where('jam_selesai_cuci is not null')
                ->where('f_status = :fto', array(':fto' => 'Y'))
                ->where('status = :s', array(':s'=>'N'))
                ->count();

            $notif_mobil_selesai = $this->core()->call->db->from('tracker')
                ->where('w_status = :fs', array(':fs' => 'Y'))
                ->where('member = :etm', array(':etm' =>$user_member['id_user']))
                ->where('jam_selesai_cuci is not null')
                ->where('f_status = :fto', array(':fto' => 'Y'))
                ->where('date = :d', array(':d' => date("Y-m-d")))
                ->where('status = :s', array(':s' => 'Y'))
                ->count();
            if ($notif > 0) {
            ?>
            <!--selesai-->
            <div class="col-12">
                <a href="<?=BASE_URL;?>/member/valled">
                <div class="card mb-3 animated headShake infinite">
                    <div class="card-body info-color white-text">
                        <h5 class="card-title m-0">                                
                            <?=$notif;?>
                        </h5>
                        <p class="card-text white-text">Penyerahan Mobil</p>
                    </div>
                </div>
                </a>
            </div>
            <?php } ?>
            <!--/.done-->
            <div class="col-12 col-md-12">
                <a href="<?=BASE_URL;?>/member/valled/selesai">
                <div class="card mb-3">
                    <div class="card-body success-color">
                        <h5 class="card-title white-text">                                
                            <?=$notif_mobil_selesai?>
                        </h5>
                        <p class="card-text white-text">Mobil Selesai</p>
                    </div>
                    <div class="card-footer success-color-dark">
                        <small class="text-muted white-text">SA</small>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Add script -->
<?php $this->push('scripts') ?>
    <!-- Notifikasi Script -->
    <script>

    </script>
 
<?php $this->end() ?>