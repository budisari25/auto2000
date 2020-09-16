<!-- Layout -->
<?=$this->layout('member::layout')?>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="page-header d-flex">
            <h3 class="mr-auto"><i class="fa fa-pencil"></i>Booking</h3>
        </div>
        <!-- End Page Header -->
        <div class="member-content pt-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="single-tab" data-toggle="tab" href="#single" role="tab" aria-controls="single" aria-selected="true">Add Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="import-tab" data-toggle="tab" href="#import" role="tab" aria-controls="import" aria-selected="false">Import Data</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Add Data -->
                <div class="tab-pane fade show active" id="single" role="tabpanel" aria-labelledby="single-tab">
                    <?=$this->form()->formStart(array('method' => 'POST', 'action' => BASE_URL.'/member/m/addnew', 'autocomplete' => 'off'));?>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <?=$this->form()->inputText(array('type' => 'text', 'label' => 'No BK', 'name' => 'nobk', 'id' => 'nobk', 'mandatory' => true, 'options' => 'required'));?>
                            </div>
                            <div class="col-12 col-md-6">
                                <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Sumber', 'name' => 'sumber', 'id' => 'sumber', 'mandatory' => true, 'options' => 'required'));?>
                                <div id="sumberList"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="md-form form-group">
                                    <select class="mdb-select" id="ket" name="ket">
                                        <option value="sales">Sales</option>
                                        <option value="sa">SA</option>
                                        <option value="mra">MRA</option>
                                    </select>
                                    <label for="jenis">Devisi <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <?php
                                    $item = array();
                                    $menus = $this->core()->call->db->from('tipe_mobil')->orderBy('id_tipe ASC')->fetchAll();
                                    foreach($menus as $menu){
                                        $item[] = array('value' => $menu['id_tipe'], 'title' => $menu['nama_tipe']);
                                    }
                                ?>
                                <?=$this->form()->inputSelect(array('id' => 'jenis', 'label' => 'Tipe Mobil', 'name' => 'tipe_mobil', 'mandatory' => true), $item);?>
                            </div>
                            <div class="col-12">
                                <?php
                                    $item = array();
                                    $menus = $this->core()->call->db->from('kerusakan')->orderBy('id_kerusakan ASC')->fetchAll();
                                    foreach($menus as $menu){
                                        $item[] = array('value' => $menu['id_kerusakan'], 'title' => $menu['jenis'].' - (<b>'.date('H:i', strtotime($menu['estimasi_pengerjaan'])).'</b> Jam)');
                                    }
                                ?>
                                <?=$this->form()->inputSelect(array('id' => 'jenis', 'label' => 'Jenis Kerusakan', 'name' => 'jenis_kerusakan', 'mandatory' => true), $item);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Time Booking', 'name' => 'time', 'id' => 'pickatime', 'value' => date('H:i'), 'mandatory' => true, 'options' => 'required'));?>
                            </div>
                            <div class="col-6">
                                <?php
                                $date = date_create(date('Y-m-d'));
                                date_add($date, date_interval_create_from_date_string('1 days'));
                                ?>
                                <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Date Booking', 'name' => 'booking', 'id' => 'pickadate', 'value' => date_format($date, 'Y-m-d'), 'mandatory' => true, 'options' => 'required'));?>
                            </div>      
                        </div>
                        <?=$this->form()->formAction();?>
                    <?=$this->form()->formEnd();?>
                </div>
                <!-- Import Data -->
                <div class="tab-pane fade" id="import" role="tabpanel" aria-labelledby="import-tab">
                    <form enctype="multipart/form-data" method="post" id="upload_csv" action="<?=BASE_URL?>/member/m/import">
                        <div class="md-form">
                            <ul>
                                <li><a href="<?=BASE_URL?>/res/excel/format-import-booking.xlsx">Download format (.xlsx)</a></li>
                                <li><a href="<?=BASE_URL?>/res/excel/format-import-booking.xls">Download format (.xls)</a></li>
                            </ul>
                        </div>
                        <div class="md-form">
                            <div class="file-field">
                                <div class="btn btn-primary btn-sm float-left">
                                    <span>Choose file:</span>
                                    <input type="file" name="excel" id="excel" accept=".xls,.xlsx"/>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Upload your file">
                                </div>
                            </div>
                        </div>
                        <div class="md-form">
                            <button type="submit" class="btn btn-outline-primary btn-rounded btn-sm waves-effect">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Member content -->
    </div>
    <!-- End col-10 -->
</div>


<!-- Add script -->
<?php $this->push('scripts') ?>
    <script>
        $(document).ready(function() {
            $('#sumber').keyup(function(){
                var query = $(this).val();
                if(query != '') {
                    $.ajax({
                        url: BASE_URL + '/member/m/sumber',
                        method: "POST",
                        data: {query:query},
                        success: function(data) {
                            $('#sumberList').fadeIn();
                            $('#sumberList').html(data);
                        }
                    });
                }
            });
            $('#sumber').focusout(function(){
                $('#sumberList').fadeOut();
            });
            $(document).on('click', 'span', function(){
                $('#sumber').val($(this).text());
                $('#sumberList').fadeOut();
            });
        });
    </script>
<?php $this->end() ?>