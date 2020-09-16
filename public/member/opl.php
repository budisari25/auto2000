<!-- Layout -->
<?=$this->layout('member::layout')?>
<?php
// var_dump($_SESSION);
?>
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
                ->where('member = :etm', array(':etm' => $user_member['id_user']))
                ->where('
                    o_editor_1 = :e1 AND jam_mulai_opl_1 is null OR
                    o_editor_2 = :e2 AND jam_mulai_opl_2 is null OR
                    o_editor_3 = :e3 AND jam_mulai_opl_3 is null OR
                    o_editor_4 = :e4 AND jam_mulai_opl_4 is null OR 
                    o_editor_5 = :e5 AND jam_mulai_opl_5 is null',
                    array(
                        ':e1'   => $_SESSION['leveluser'],
                        ':e2'   => $_SESSION['leveluser'],
                        ':e3'   => $_SESSION['leveluser'],
                        ':e4'   => $_SESSION['leveluser'],
                        ':e5'   => $_SESSION['leveluser']
                    ))
                ->where('date = :d OR status = :s', array(':d' => date("Y-m-d"), ':s'=>'N'))
                ->where('member = :etm', array(':etm' => $user_member['id_user']))
                ->where('
                    o_editor_1 = :e1 AND jam_mulai_opl_1 is null OR
                    o_editor_2 = :e2 AND jam_mulai_opl_2 is null OR
                    o_editor_3 = :e3 AND jam_mulai_opl_3 is null OR
                    o_editor_4 = :e4 AND jam_mulai_opl_4 is null OR 
                    o_editor_5 = :e5 AND jam_mulai_opl_5 is null',
                    array(
                        ':e1'   => $_SESSION['leveluser'],
                        ':e2'   => $_SESSION['leveluser'],
                        ':e3'   => $_SESSION['leveluser'],
                        ':e4'   => $_SESSION['leveluser'],
                        ':e5'   => $_SESSION['leveluser']
                    ))
                
                ->count();
                if ($notif_post > 0) {
            ?>                
            <!-- Mobil Masuk -->
            <div class="col-12">
                <a href="<?=BASE_URL;?>/member/opl/tunggu">
                <div class="card mb-3 animated headShake infinite">
                    <div class="card-body info-color white-text">
                        <h5 class="card-title m-0">                                
                            <?=$notif_post;?>
                        </h5>
                        <p class="card-text white-text">Mobil Masuk</p>
                    </div>
                </div>
                </a>
            </div>
            <?php } ?>       
            <!-- Mobil Service -->
            <div class="col-6 col-md-6">
                <a href="<?=BASE_URL;?>/member/opl/proses">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">                                
                        <?=$this->core()->call->db->from('tracker')
                            ->where('member = :etm', array(':etm' => $user_member['id_user']))
                            ->where('
                                o_editor_1 = :e1 AND jam_mulai_opl_1 is not null AND o_time_1 is null OR
                                o_editor_2 = :e2 AND jam_mulai_opl_2 is not null AND o_time_2 is null OR
                                o_editor_3 = :e3 AND jam_mulai_opl_3 is not null AND o_time_3 is null OR
                                o_editor_4 = :e4 AND jam_mulai_opl_4 is not null AND o_time_4 is null OR 
                                o_editor_5 = :e5 AND jam_mulai_opl_5 is not null AND o_time_5 is null',
                                array(
                                    ':e1'   => $_SESSION['leveluser'],
                                    ':e2'   => $_SESSION['leveluser'],
                                    ':e3'   => $_SESSION['leveluser'],
                                    ':e4'   => $_SESSION['leveluser'],
                                    ':e5'   => $_SESSION['leveluser']
                                ))
                            ->where('date = :d OR status = :s', array(':d' => date("Y-m-d"), ':s'=>'N'))
                            ->where('member = :etm', array(':etm' => $user_member['id_user']))
                            ->where('
                                o_editor_1 = :e1 AND jam_mulai_opl_1 is not null AND o_time_1 is null OR
                                o_editor_2 = :e2 AND jam_mulai_opl_2 is not null AND o_time_2 is null OR
                                o_editor_3 = :e3 AND jam_mulai_opl_3 is not null AND o_time_3 is null OR
                                o_editor_4 = :e4 AND jam_mulai_opl_4 is not null AND o_time_4 is null OR 
                                o_editor_5 = :e5 AND jam_mulai_opl_5 is not null AND o_time_5 is null',
                                array(
                                    ':e1'   => $_SESSION['leveluser'],
                                    ':e2'   => $_SESSION['leveluser'],
                                    ':e3'   => $_SESSION['leveluser'],
                                    ':e4'   => $_SESSION['leveluser'],
                                    ':e5'   => $_SESSION['leveluser']
                                ))
                            ->count();?>
                        </h5>
                        <p class="card-text">Mobil Service</p>
                    </div>
                    <div class="card-footer success-color">
                        <small class="text-muted white-text"><?=$user['nama_lengkap'];?></small>
                    </div>
                </div>
                </a>
            </div>
            <!-- Selesai Proses -->
            <div class="col-6 col-md-6">
                <a href="<?=BASE_URL;?>/member/opl/selesai">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">                          
                        <?=$this->core()->call->db->from('tracker')
                            ->where('member = :etm', array(':etm' => $user_member['id_user']))
                            ->where('
                                o_editor_1 = :e1 AND jam_mulai_opl_1 is not null AND o_time_1 is not null OR
                                o_editor_2 = :e2 AND jam_mulai_opl_2 is not null AND o_time_2 is not null OR
                                o_editor_3 = :e3 AND jam_mulai_opl_3 is not null AND o_time_3 is not null OR
                                o_editor_4 = :e4 AND jam_mulai_opl_4 is not null AND o_time_4 is not null OR 
                                o_editor_5 = :e5 AND jam_mulai_opl_5 is not null AND o_time_5 is not null',
                                array(
                                    ':e1'   => $_SESSION['leveluser'],
                                    ':e2'   => $_SESSION['leveluser'],
                                    ':e3'   => $_SESSION['leveluser'],
                                    ':e4'   => $_SESSION['leveluser'],
                                    ':e5'   => $_SESSION['leveluser']
                                ))
                            ->where('date = :d OR status = :s', array(':d' => date("Y-m-d"), ':s'=>'N'))
                            ->where('member = :etm', array(':etm' => $user_member['id_user']))
                            ->where('
                                o_editor_1 = :e1 AND jam_mulai_opl_1 is not null AND o_time_1 is not null OR
                                o_editor_2 = :e2 AND jam_mulai_opl_2 is not null AND o_time_2 is not null OR
                                o_editor_3 = :e3 AND jam_mulai_opl_3 is not null AND o_time_3 is not null OR
                                o_editor_4 = :e4 AND jam_mulai_opl_4 is not null AND o_time_4 is not null OR 
                                o_editor_5 = :e5 AND jam_mulai_opl_5 is not null AND o_time_5 is not null',
                                array(
                                    ':e1'   => $_SESSION['leveluser'],
                                    ':e2'   => $_SESSION['leveluser'],
                                    ':e3'   => $_SESSION['leveluser'],
                                    ':e4'   => $_SESSION['leveluser'],
                                    ':e5'   => $_SESSION['leveluser']
                                ))
                            ->count();?>
                        </h5>
                        <p class="card-text">Selesai Proses</p>
                    </div>
                    <div class="card-footer success-color">
                        <small class="text-muted white-text"><?=$user['nama_lengkap'];?></small>
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