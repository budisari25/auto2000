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
                $notif_post = $this->core()->call->db->from('tracker')
                ->where('member = :etm', array(':etm' =>$user_member['id_user']))
                ->where('washing = :wg', array(':wg' => 'Y'))
                ->where('w_status = :ws', array(':ws' => 'N'))
                ->where('date = :d OR status = :s', array(':d' => date("Y-m-d"), ':s'=>'N'))
                ->where('w_status = :w', array(':w' => 'N'))
                ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                ->where('washing = :ww', array(':ww' => 'Y'))
                ->count();
                if ($notif_post > 0) {
            ?>                
            <!-- Proses Wash -->
            <div class="col-12">
                <a href="<?=BASE_URL;?>/member/washing/tunggu">
                <div class="card mb-3 animated headShake infinite">
                    <div class="card-body info-color white-text">
                        <h5 class="card-title m-0">                                
                            <?=$notif_post;?>
                        </h5>
                        <p class="card-text white-text">Proses Wash</p>
                    </div>
                </div>
                </a>
            </div>
            <?php } ?>
            <!-- Proses Service -->
            <div class="col-12">
                <a href="<?=BASE_URL;?>/member/washing/selesai">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">                                
                        <?=$this->core()->call->db->from('tracker')
                        ->where('w_editor = :fk', array(':fk' => $user['id_user']))
                        ->where('member = :etm', array(':etm' =>$user_member['id_user']))
                        ->where('washing = :wg', array(':wg' => 'Y'))
                        ->where('w_status = :fs', array(':fs' => 'Y'))
                        ->where('date = :d OR status = :s', array(':d' => date("Y-m-d"), ':s'=>'N'))
                        ->where('w_status = :fst', array(':fst' => 'Y'))
                        ->where('washing = :ww', array(':ww' => 'Y'))
                        ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                        ->where('w_editor = :fkt', array(':fkt' => $user['id_user']))
                        ->count();?>
                        </h5>
                        <p class="card-text">Selesai Wash</p>
                    </div>
                    <div class="card-footer success-color">
                        <small class="text-muted white-text">Washing</small>
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