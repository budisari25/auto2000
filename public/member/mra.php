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
            <!-- Booking Today -->
            <div class="col-6">
                <a href="<?=BASE_URL;?>/member/mra/totalday">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">                                
                        <?=$this->core()->call->db->from('booking')
                        ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                        ->where('booking = :d', array(':d' => date("Y-m-d")))
                        ->count();?>
                        </h5>
                        <p class="card-text">Booking</p>
                    </div>
                    <div class="card-footer warning-color">
                        <small class="text-muted white-text">Today</small>
                    </div>
                </div>
                </a>
            </div>
            <!-- Tommorrow Booking -->
            <div class="col-6">
                <a href="<?=BASE_URL;?>/member/mra/besok">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">                                
                        <?=$this->core()->call->db->from('booking')
                        ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                        ->where('booking > :d', array(':d' => date("Y-m-d")))
                        ->count();?>
                        </h5>
                        <p class="card-text">Booking</p>
                    </div>
                    <div class="card-footer success-color">
                        <small class="text-muted white-text">Tomorrow</small>
                    </div>
                </div>
                </a>
            </div>
            <!-- Booking Show -->
            <div class="col-6">
                <a href="<?=BASE_URL;?>/member/mra/noshow">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">                                
                        <?=$this->core()->call->db->from('booking')
                        ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                        ->where('booking = :d AND status = :s', array(':d' => date("Y-m-d"), ':s'=>'N'))
                        ->count();?>
                        </h5>
                        <p class="card-text">Booking</p>
                    </div>
                    <div class="card-footer warning-color">
                        <small class="text-muted white-text">No Show</small>
                    </div>
                </div>
                </a>
            </div>
            <!-- Booking Show -->
            <div class="col-6">
                <a href="<?=BASE_URL;?>/member/mra/show">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">                                
                        <?=$this->core()->call->db->from('booking')
                        ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                        ->where('booking = :d AND status = :s', array(':d' => date("Y-m-d"), ':s'=>'Y'))
                        ->count();?>
                        </h5>
                        <p class="card-text">Booking</p>
                    </div>
                    <div class="card-footer warning-color">
                        <small class="text-muted white-text">Show</small>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>