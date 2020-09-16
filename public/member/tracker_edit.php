<!-- Layout -->
<?=$this->layout('member::layout')?>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="page-header">
            <h3><i class="fa fa-pencil"></i>Edit Tracker</h3>
        </div>
        <!-- End Page Header -->
        <div class="member-content">
            <?=$this->form()->formStart(array('method' => 'POST', 'action' => BASE_URL.'/member/t/edit/'.$tracker['id'], 'autocomplete' => 'off'));?>
                <?=$this->form()->inputHidden(array('name' => 'id', 'value' => $tracker['id']));?>
                <div class="row">
                    <div class="col-12">
                        <?=$this->form()->inputHidden(array('type' => 'text','name' => 'nobk', 'id' => 'nobk', 'value'=> $tracker['nobk']));?>
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'No BK', 'id' => 'nobk', 'value'=> $tracker['nobk'], 'mandatory' => true, 'options' => 'disabled'));?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Whatsapp', 'name' => 'whatsapp', 'id' => 'whatsapp', 'value'=> $tracker['whatsapp'], 'options' => 'disabled'));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Email', 'name' => 'email', 'id' => 'email', 'value'=> $tracker['email'], 'options' => 'disabled'));?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?php
                            $item = array();
                            $melin = $this->core()->call->db->from('kerusakan')->orderBy('id_kerusakan ASC')->fetch();
                            $item[] = array('value' => $tracker['kerusakan_id'], 'title' => $melin['jenis'].' - (<b>'.date('H:i', strtotime($melin['estimasi_pengerjaan'])).'</b> Jam)');
                            $menus = $this->core()->call->db->from('kerusakan')->orderBy('id_kerusakan ASC')->fetchAll();
                            foreach($menus as $menu){
                                $item[] = array('value' => $menu['id_kerusakan'], 'title' => $menu['jenis'].' - (<b>'.date('H:i', strtotime($menu['estimasi_pengerjaan'])).'</b> Jam)');
                            }
                        ?>
                        <?=$this->form()->inputSelect(array('id' => 'jenis', 'label' => 'Jenis Kerusakan', 'options'=>'disabled'), $item);?>
                        <?=$this->form()->inputHidden(array('type' => 'text','name' => 'jenis_kerusakan', 'value'=> $tracker['kerusakan_id']));?>
                    </div>
                    <div class="col-6">
                        <?php
                            $item = array();
                            $tipe = $this->core()->call->db->from('tipe_mobil')->orderBy('id_tipe ASC')->fetch();
                            $item[] = array('value' => $tracker['tipe_id'], 'title' => $tipe['nama_tipe']);
                            $menus = $this->core()->call->db->from('tipe_mobil')->orderBy('id_tipe ASC')->fetchAll();
                            foreach($menus as $menu){
                                $item[] = array('value' => $menu['id_tipe'], 'title' => $menu['nama_tipe']);
                            }
                        ?>
                        <?=$this->form()->inputSelect(array('id' => 'jenis', 'label' => 'Tipe Mobil', 'options'=>'disabled', 'mandatory' => true), $item);?>
                        <?=$this->form()->inputHidden(array('type' => 'text','name' => 'tipe_mobil', 'value'=> $tracker['tipe_id']));?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Jam Masuk', 'value' => date('H:i'), 'options' => 'disabled'));?>
                        <?=$this->form()->inputHidden(array('type' => 'text','name' => 'publishtime', 'value'=> date('H:i')));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Tanggal Masuk', 'value' => date('Y-m-d'), 'options' => 'disabled'));?>
                        <?=$this->form()->inputHidden(array('type' => 'text','name' => 'publishdate', 'value'=> date('Y-m-d')));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Est.Waktu Selesai', 'name' => 'estimasiselesai', 'id' => 'pickatime', 'value' => $tracker['estimasiselesai'], 'mandatory' => true, 'options' => 'required'));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Est.Tanggal Selesai', 'name' => 'dateout', 'id' => 'pickadate', 'value' => $tracker['date_out'], 'mandatory' => true, 'options' => 'required'));?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="washing_use">Washing Use</label>
                        <?php
                        if ($tracker['washing_use'] == 'N') { ?>                    
                            <!-- Default checked -->
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="washing_use" name="washing_use" value="Y">
                                <label class="custom-control-label" for="washing_use">Use</label>
                            </div>
                            <!-- Default checked -->
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="washing_use1" name="washing_use" value="N" checked>
                                <label class="custom-control-label" for="washing_use1">No</label>
                            </div>
                        <?php } else { ?>                        
                            <!-- Default checked -->
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="washing_use" name="washing_use" value="Y" checked>
                                <label class="custom-control-label" for="washing_use">Use</label>
                            </div>
                            <!-- Default checked -->
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="washing_use1" name="washing_use" value="N">
                                <label class="custom-control-label" for="washing_use1">No</label>
                            </div>
                        <?php } ?>
                    </div>
                </div>   
                
                <div class="row mt-4">
                    <?php
                    $gallerys = $this->core()->call->db->from('tracker_gallery')
                                ->where('nobk', $tracker['nobk'])
                                ->where('gallery_publish', $tracker['date_gallery'])
                                ->orderBy('id_tracker_gallery DESC')
                                ->fetchAll();
                    $count_gallerys = $this->core()->call->db->from('tracker_gallery')
                                ->where('nobk', $tracker['nobk'])
                                ->where('gallery_publish', $tracker['date_gallery'])
                                ->orderBy('id_tracker_gallery DESC')
                                ->count();
                    if ($count_gallerys > 0) {
                    ?>
                    <div class="col-md-12">
                        <div class="row">
                        <?php foreach($gallerys as $gallery){ ?>
                            <?=$this->form()->inputHidden(array('type' => 'text','name' => 'gambar', 'id'=>'gambar', 'value'=> $gallery['picture']));?>
                            <div class="col-md-3" id="col-gal-<?=$gallery['id_tracker_gallery'];?>">
                                <div class="widget">
                                    <div class="theme_box" style="background-image:url('<?=BASE_URL?>/res/uploads/medium/medium_<?=$gallery['picture'];?>');">
                                        <ul>
                                            <li><a href="<?=BASE_URL?>/res/uploads/<?=$gallery['picture'];?>" data-toggle="tooltip" title="View" target="_blank"><i class="fa fa-search bg-warning"></i></a></li>
                                            <li><a href="javascript:void(0)" class="btn-remove-gal" id="<?=$gallery['id_tracker_gallery'];?>" data-toggle="tooltip" title="Hapus"><i class="fa fa-times bg-danger"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col" id="ketgallery">
                        <?=$this->form()->inputTextarea(array('label' => 'Keterangan', 'name' => 'keterangan', 'id' => 'keterangan', 'value' => $tracker['keterangan']));?>
                    </div>
                    <?php } ?>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="block-header">
                            <h4>Visual Keadaan Mobil</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h5 class="text-danger"><small>* Max file upload 4MB<br> ** Hanya bisa mengupload 8 gambar</small></h5>
                        <div id="postgallery" class="dropzone dz-clickable"></div>
                        <?=$this->form()->inputHidden(array('name' => 'level_user', 'value' => $_SESSION['leveluser']));?>

                        <?=$this->form()->inputHidden(array('name' => 'gallery_publish', 'value' => $tracker['date']));?>
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


<!-- Add script -->
<?php $this->push('scripts') ?>
<script>
	$('.btn-remove-gal').click(function () {
        var id = $(this).attr("id");
        var gbr = $('input[name=gambar]').val();
        
		$.ajax({
			type: "POST",
			url: "<?=BASE_URL?>/member/t/deletegallery",
			data: {id: id, gbr: gbr},
			cache: false,
			success: function(){
				$('#col-gal-'+id).remove();
			}
		});
		return false;
	});
      
    Dropzone.options.postgallery = {
        acceptedFiles:"image/*",
        capture:"camera",
        autoProcessQueue: true,
        uploadMultiple: false,
        parallelUploads: 24,
        maxFiles: 8,
        maxFilesize:4,//MB
        addRemoveLinks: false,
        dictRemoveFile: "Remove",
        dictCancelUpload: "Cancel",
        dictDefaultMessage: "Drop images files here",
        url: "<?=BASE_URL?>/member/t/addgallery",
        sending: function(file, xhr, formData) {
            formData.append('nobk', ''+$("#nobk").val()+'');
            formData.append('level_user', ''+$("[name=level_user]").val()+'');
            formData.append('gallery_publish', ''+$("[name=gallery_publish]").val()+'');
        }
    };
</script>
<?php $this->end() ?>