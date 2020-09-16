<!-- Layout -->
<?=$this->layout('member::layout')?>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="page-header">
            <h3><i class="fa fa-pencil"></i>Booking</h3>
        </div>
        <!-- End Page Header -->
        <div class="member-content">
            <?=$this->form()->formStart(array('method' => 'POST', 'action' => BASE_URL.'/member/m/edit/'.$booking['id'], 'autocomplete' => 'off'));?>
                <?=$this->form()->inputHidden(array('name' => 'id', 'value' => $booking['id']));?>
                <div class="row">
                    <div class="col-12">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'No BK', 'name' => 'nobk', 'value'=> $booking['nobk'], 'mandatory' => true, 'options' => ''));?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?php
                            $item = array();
                            $melin = $this->core()->call->db->from('kerusakan')->where('id_kerusakan', $booking['id_kerusakan'])->fetch();
                            $item[] = array('value' => $booking['id_kerusakan'], 'title' => $melin['jenis'].' - (<b>'.date('H:i', strtotime($melin['estimasi_pengerjaan'])).'</b> Jam)');
                            $menus = $this->core()->call->db->from('kerusakan')->orderBy('id_kerusakan ASC')->fetchAll();
                            foreach($menus as $menu){
                                $item[] = array('value' => $menu['id_kerusakan'], 'title' => $menu['jenis'].' - (<b>'.date('H:i', strtotime($menu['estimasi_pengerjaan'])).'</b> Jam)');
                            }
                        ?>
                        <?=$this->form()->inputSelect(array('id' => 'jenis', 'name' => 'jenis_kerusakan', 'label' => 'Jenis Kerusakan', 'options'=>''), $item);?>
                    </div>
                    <div class="col-6">
                        <?php
                            $item = array();
                            $tipe = $this->core()->call->db->from('tipe_mobil')->where('id_tipe', $booking['id_tipe'])->fetch();
                            $item[] = array('value' => $booking['id_tipe'], 'title' => $tipe['nama_tipe']);
                            $menus = $this->core()->call->db->from('tipe_mobil')->orderBy('id_tipe ASC')->fetchAll();
                            foreach($menus as $menu){
                                $item[] = array('value' => $menu['id_tipe'], 'title' => $menu['nama_tipe']);
                            }
                        ?>
                        <?=$this->form()->inputSelect(array('id' => 'jenis', 'label' => 'Tipe Mobil', 'name' => 'tipe_mobil', 'options'=>'', 'mandatory' => true), $item);?>
                    </div>
                </div>
                <?php if($_SESSION['leveluser']=='8' OR $_SESSION['leveluser']=='9') { ?>                     
                    <div class="row">
                        <div class="col-6">
                            <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Time', 'name' => 'time', 'id' => 'pickatime', 'value' => $booking['time'], 'mandatory' => true, 'options' => 'required'));?>
                        </div>
                        <div class="col-6">
                            <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Booking', 'name' => 'booking', 'id' => 'pickadate', 'value' => $booking['booking'], 'mandatory' => true, 'options' => 'required'));?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-6">
                            <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Waktu Show', 'value' => date('H:i'), 'options' => 'disabled'));?>
                            <?=$this->form()->inputHidden(array('type' => 'text','name' => 'publishtime', 'value'=> date('H:i')));?>
                        </div>
                        <div class="col-6">
                            <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Tanggal Show', 'value' => date('Y-m-d'), 'options' => 'disabled'));?>
                            <?=$this->form()->inputHidden(array('type' => 'text','name' => 'publishdate', 'value'=> date('Y-m-d')));?>
                        </div>
                        <div class="col-6">
                            <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Est.Waktu Selesai', 'name' => 'estimasiselesai', 'id' => 'pickatime', 'value' => date('H:i'), 'mandatory' => true, 'options' => 'required'));?>
                        </div>
                        <div class="col-6">
                            <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Est.Tanggal Selesai', 'name' => 'dateout', 'id' => 'pickadate', 'value' => date('Y-m-d'), 'mandatory' => true, 'options' => 'required'));?>
                        </div>
                    </div>
                <?php } ?>
                    <?=$this->form()->inputHidden(array('name' => 'level_user', 'value' => $_SESSION['leveluser']));?>
                    <?= $this->form()->inputHidden(array('name' => 'gallery_publish', 'value' => date('Y-m-d'))); ?>
                    <?php if ($_SESSION['leveluser'] == 5) { ?>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="block-header">
                                    <h4>Tambah Visual Keadaan Mobil</h4>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h5 class="text-danger"><small>* Hanya bisa mengupload 8 gambar</small></h5>
                                <div id="postgallery" class="dropzone dz-clickable"></div>
                                <?=$this->form()->inputTextarea(array('label' => 'Keterangan', 'name' => 'keterangan', 'id' => 'keterangan', 'value' => $booking['komentar']));?>
                            </div>
                        </div>
                <?php }?>
                <?=$this->form()->formAction();?>
            <?=$this->form()->formEnd();?>
        </div>
        <!-- End Member content -->
    </div>
    <!-- End col-10 -->
</div>

<!-- Add script -->
<?php $this->push('scripts') ?>
    <script type="text/javascript">
        Dropzone.options.postgallery = {
            acceptedFiles:"image/*",
            capture:"camera",
            autoProcessQueue: true,
            uploadMultiple: false,
            parallelUploads: 24,
            maxFiles: 8,
            addRemoveLinks: false,
            dictRemoveFile: "Remove",
            dictCancelUpload: "Cancel",
            dictDefaultMessage: "Drop images files here",
            url: "<?=BASE_URL?>/member/t/addgallery",
            sending: function(file, xhr, formData) {
                formData.append('nobk', ''+$("[name=nobk]").val()+'');
                formData.append('level_user', ''+$("[name=level_user]").val()+'');
                formData.append('gallery_publish', ''+$("[name=gallery_publish]").val()+'');
            }
        };
    </script>
<?php $this->end() ?>