<!-- Layout -->
<?=$this->layout('member::layout')?>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="page-header">
            <h3><i class="fa fa-pencil"></i>Approve</h3>
        </div>
        <!-- End Page Header -->
        <div class="member-content">
            <?=$this->form()->formStart(array('method' => 'POST', 'action' => BASE_URL.'/member/t/approve/'.$reminder['id'], 'autocomplete' => 'off'));?>
                <?=$this->form()->inputHidden(array('name' => 'id', 'value' => $reminder['id']));?>
                <?=$this->form()->inputHidden(array('name' => 'no_pol', 'value' => $reminder['no_pol']));?>
                <?=$this->form()->inputHidden(array('name' => 'tipe_mobil', 'value' => $reminder['tipe_mobil']));?>
                <div class="row">
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Tanggal Booking', 'name' => 'date', 'id' => 'pickadate', 'value' => date('Y-m-d'), 'mandatory' => true, 'options' => 'required'));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Waktu Booking', 'name' => 'time', 'id' => 'pickatime', 'value' => date('H:m:s'), 'mandatory' => true, 'options' => 'required'));?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <?php
                        $item = array();
                        $menus = $this->core()->call->db->from('kerusakan')->orderBy('id_kerusakan ASC')->fetchAll();
                        foreach($menus as $menu){
                            $item[] = array('value' => $menu['id_kerusakan'], 'title' => $menu['jenis'].' - (<b>'.date('H:i', strtotime($menu['estimasi_pengerjaan'])).'</b> Menit)');
                        }
                    ?>
                    <?=$this->form()->inputSelect(array('id' => 'jenis', 'label' => 'Jenis Kerusakan', 'name' => 'jenis_kerusakan', 'mandatory' => true), $item);?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?=$this->form()->inputTextarea(array('label' => 'Komentar', 'name' => 'komentar', 'id' => 'komentar'));?>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-12">
                        <?=$this->form()->formAction();?>
                    </div>
                </div>
            <?=$this->form()->formEnd();?>
        </div>
        <!-- End Member content -->
    </div>
    <!-- End col-10 -->
</div>
