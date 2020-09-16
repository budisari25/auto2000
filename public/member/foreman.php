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
                ->where('f_kelompok = :fk', array(':fk' => $user['id_user']))
                ->where('forman = :f', array(':f' => 'Y'))
                ->where('f_status = :fs', array(':fs' => 'N'))
                ->where('date = :d OR status = :s', array(':d' => date("Y-m-d"), ':s' => 'N'))
                ->where('f_status = :fst', array(':fst' => 'N'))
                ->where('forman = :ft', array(':ft' => 'Y'))
                ->where('f_kelompok = :fkt', array(':fkt' => $user['id_user']))
                ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                ->count();
                if ($notif_post > 0) {
            ?>                
            <!-- Proses Service -->
            <div class="col-12">
                <a href="<?=BASE_URL;?>/member/foreman/service">
                <div class="card mb-3 animated headShake infinite">
                    <div class="card-body warning-color white-text">
                        <h5 class="card-title m-0">                                
                            <?=$notif_post;?>
                        </h5>
                        <p class="card-text white-text">Proses Service</p>
                    </div>
                </div>
                </a>
            </div>
            <?php } ?>
            <!-- Proses Service -->
            <div class="col-12">
                <a href="<?=BASE_URL;?>/member/foreman/selesai">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">                                
                        <?=$this->core()->call->db->from('tracker')
                        ->where('member = :etm', array(':etm' =>$user_member['id_user']))
                        ->where('f_kelompok = :fk', array(':fk' => $user['id_user']))
                        ->where('forman = :fo', array(':fo' => 'Y'))
                        ->where('f_status = :fs', array(':fs' => 'Y'))
                        ->where('date = :d OR status = :s', array(':d' => date("Y-m-d"), ':s' => 'N'))
                        ->where('forman = :fot', array(':fot' => 'Y'))
                        ->where('f_status = :fst', array(':fst' => 'Y'))
                        ->where('f_kelompok = :fky', array(':fky' => $user['id_user']))
                        ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                        ->count();?>
                        </h5>
                        <p class="card-text">Selesai Service</p>
                    </div>
                    <div class="card-footer success-color">
                        <small class="text-muted white-text">Forman</small>
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
        $(document).ready(function() {
            <?php
                $notif_post = $this->core()->call->db->from('tracker')
                ->where('member = :etm', array(':etm' =>$user_member['id_user']))
                ->where('f_kelompok = :fk', array(':fk' => $user['id_user']))
                ->where('forman = :f', array(':f' => 'Y'))
                ->where('f_status = :fs', array(':fs' => 'N'))
                ->where('date = :d OR status = :s', array(':d' => date("Y-m-d"), ':s' => 'N'))
                ->where('f_status = :fst', array(':fst' => 'N'))
                ->where('forman = :ft', array(':ft' => 'Y'))
                ->where('f_kelompok = :fkt', array(':fkt' => $user['id_user']))
                ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                ->count();
                if ($notif_post > 0) {
            ?>  
                Push.create("Notifikasi Baru", {
                    body: "<?=$notif_post;?> proses service",
                    timeout: 4000,
                    link: "<?=BASE_URL?>/member",
                    onClick: function () {
                        window.focus();
                        this.close();
                    }
                });
            <?php } ?>
        });
    </script>
 
<?php $this->end() ?>