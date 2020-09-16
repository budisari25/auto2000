<!-- Layout -->
<?=$this->layout('member::layout')?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="page-header">
            <h3><i class="fa fa-pencil"></i>Tambah Tracker  </h3>
        </div>

        <!-- End Page Header -->
        <div class="member-content">
            <?=$this->form()->formStart(array('method' => 'POST', 'action' => BASE_URL.'/member/t/addnew', 'autocomplete' => 'off'));?>
            <div class="row">
                <div class="col-md-6">
                    <?=$this->form()->inputText(array('type' => 'text', 'label' => 'No Pol', 'name' => 'nobk', 'id' => 'nobk', 'mandatory' => true, 'options' => 'required'));?>
                </div>
                <div class="col-md-6">
                    <?php
                        $item = array();
                        $menus = $this->core()->call->db->from('tipe_mobil')->orderBy('id_tipe ASC')->fetchAll();
                        $item[] = array('value' => '', 'title' => 'Pilih Jenis Mobil');
                        foreach($menus as $menu) {

                            $item[] = array('value' => $menu['id_tipe'], 'title' => $menu['nama_tipe']);
                        }
                    ?>
                    <?=$this->form()->inputSelect(array('id' => 'jenis', 'label' => 'Tipe Mobil', 'name' => 'tipe_mobil', 'mandatory' => true), $item);?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?=$this->form()->inputSelect(array('id' => 'service_berkala', 'label' => 'Service Berkala', 'name' => 'id_service_berkala', 'mandatory' => true), null);?>
                </div>

                <div class="col-md-6">
                    <?php
                        $item = array();
                        $menus = $this->core()->call->db->from('service_lain')->where('is_opl', false)->orderBy('id ASC')->fetchAll();
                    ?>
                    <div class="md-form form-group">
                        <select class="mdb-select" id="id_keluhan_tambahan" name="id_keluhan_tambahan" >
                            <option value="0" data-leadtime-keluhan="0">Kosong</option>
                            <?php
                                foreach($menus as $menu) {
                                    echo "<option value='" . $menu['id'] . "' data-leadtime-keluhan='" . $menu['leadtime'] ."'>" . $menu['nama'] . "</option>";
                                }
                            ?>
                        </select>
                        <label for="id_keluhan_tambahan">Keluhan Tambahan</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $item = array();
                    $menus = $this->core()->call->db->from('service_lain')->where('is_opl', true)->orderBy('id ASC')->fetchAll();
                ?>
                <div class="col-md-6">
                    <select class="mdb-select" id="opl1" name="opl1" >
                        <option value="0" data-leadtime-opl1="0">Kosong</option>
                        <?php
                            foreach($menus as $menu) {
                                echo "<option value='" . $menu['id'] . "' data-leadtime-opl1='" . $menu['leadtime'] ."'>" . $menu['nama'] . "</option>";
                            }
                        ?>
                    </select>
                    <label for="opl1">OPL 1</label>
                </div>

                <div class="col-md-6">
                    <select class="mdb-select" id="opl2" name="opl2" >
                        <option value="0" data-leadtime-opl2="0">Kosong</option>
                        <?php
                            foreach($menus as $menu) {
                                echo "<option value='" . $menu['id'] . "' data-leadtime-opl2='" . $menu['leadtime'] ."'>" . $menu['nama'] . "</option>";
                            }
                        ?>
                    </select>
                    <label for="opl2">OPL 2</label>
                </div>

                <div class="col-md-6">
                    <select class="mdb-select" id="opl3" name="opl3" >
                        <option value="0" data-leadtime-opl3="0">Kosong</option>
                        <?php
                            foreach($menus as $menu) {
                                echo "<option value='" . $menu['id'] . "' data-leadtime-opl3='" . $menu['leadtime'] ."'>" . $menu['nama'] . "</option>";
                            }
                        ?>
                    </select>
                    <label for="opl3">OPL 3</label>
                </div>

                <div class="col-md-6">
                    <select class="mdb-select" id="opl4" name="opl4" >
                        <option value="0" data-leadtime-opl4="0">Kosong</option>
                        <?php
                            foreach($menus as $menu) {
                                echo "<option value='" . $menu['id'] . "' data-leadtime-opl4='" . $menu['leadtime'] ."'>" . $menu['nama'] . "</option>";
                            }
                        ?>
                    </select>
                    <label for="opl4">OPL 4</label>
                </div>

                <div class="col-md-6">
                    <select class="mdb-select" id="opl5" name="opl5" >
                        <option value="0" data-leadtime-opl5="0">Kosong</option>
                        <?php
                            foreach($menus as $menu) {
                                echo "<option value='" . $menu['id'] . "' data-leadtime-opl5='" . $menu['leadtime'] ."'>" . $menu['nama'] . "</option>";
                            }
                        ?>
                    </select>
                    <label for="opl5">OPL 3</label>
                </div>

                <div class="col-md-6">
                    <select class="mdb-select" id="opl6" name="opl6" >
                        <option value="0" data-leadtime-opl6="0">Kosong</option>
                        <?php
                            foreach($menus as $menu) {
                                echo "<option value='" . $menu['id'] . "' data-leadtime-opl6='" . $menu['leadtime'] ."'>" . $menu['nama'] . "</option>";
                            }
                        ?>
                    </select>
                    <label for="opl6">OPL 6</label>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Total Leadtime', 'id' => 'total_leadtime', 'value' => '0', 'options' => 'readonly'));?>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Tanggal Masuk', 'value' => date('Y-m-d'), 'options' => 'readonly'));?>
                    <?=$this->form()->inputHidden(array('name' => 'publishdate', 'value' => date('Y-m-d')));?>
                </div>
                <div class="col-6">
                    <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Jam Masuk', 'value' => date('H:i'), 'options' => 'readonly'));?>
                    <?=$this->form()->inputHidden(array('name' => 'publishtime', 'value' => date('H:i')));?>
                </div>
                <div class="col-6">
                    <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Estimasi Waktu Cuci', 'name' => 'estimasi_waktu_cuci', 'value' => date('H:i'), 'id' => 'pickatime2', 'mandatory' => true, 'options' => 'readonly'));?>
                </div>
                <div class="col-6">
                    <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Estimasi Penyerahan', 'name' => 'estimasiselesai', 'value' => '00:00', 'id' => 'pickatime', 'mandatory' => true, 'options' => 'readonly'));?>
                </div>
            </div>

            <?=$this->form()->formAction();?>
            <?=$this->form()->formEnd();?>
            </div>

        </div>
        <!-- End Member content -->
    </div>
    <!-- End col-md-10 -->
</div>


<!-- Add script -->
<?php $this->push('scripts') ?>
    <script type="text/javascript">
        $('#jenis').change(function() {
            let id = $(this).val();
            $.ajax({
                type: "GET",
                url: BASE_URL + '/member/t/get-service-berkala/' + id,
                dataType: 'JSON',
                success: function(data){

                    $("#service_berkala").empty();

                    $("#service_berkala").append(`<option value=''>Pilih Service Berkala</option>`);

                    $.each(data, function(index, val) {
                        $("#service_berkala").append(`<option value='${val.id}' data-leadtime-service-berkala='${val.leadtime}'>${val.nama}</option>`);
                    });

                    $('#service_berkala').material_select();

                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        function time_convert(num)
        { 
            let hours = Math.floor(num / 60);  
            let minutes = num % 60;

            if(minutes < 10) {
                minutes = `0${minutes}`;
            }

            return `${hours}:${minutes}`;         
        }

        let leadtime_service_berkala = 0,
        leadtime_keluhan = 0,
        opl1 = 0,
        opl2 = 0,
        opl3 = 0,
        opl4 = 0,
        opl5 = 0,
        opl6 = 0,
        total = 0;

        let format_leadtime = '';
        let format_estimasi_cuci = '';
        let format_estimasi_penyerahan = '';

        let total_leadtime = $('#total_leadtime');
        let estimasi_waktu_cuci = $('[name=estimasi_waktu_cuci]');
        let estimasi_penyerahan = $('[name=estimasiselesai]');
        let publishtime = $('[name=publishtime]');

        let pisah_publish = publishtime.val().split(':');
        let jam_publish = parseInt(pisah_publish[0] * 60);
        let menit_publish = parseInt(pisah_publish[1]);

        // Jika service_berkala change
        $('#service_berkala').change(function(event) {
            leadtime_service_berkala = $(this).find(':selected').data("leadtime-service-berkala");

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6;

            format_leadtime = time_convert(total);
            total_leadtime.val(format_leadtime);

            // Estimasi Waktu Cuci
            format_estimasi_cuci = total + jam_publish + menit_publish;
            format_estimasi_cuci = time_convert(format_estimasi_cuci);
            estimasi_waktu_cuci.val(format_estimasi_cuci);

            // Estimasi Penyerahan
            format_estimasi_penyerahan = total + jam_publish + menit_publish + 15;
            format_estimasi_penyerahan = time_convert(format_estimasi_penyerahan);
            estimasi_penyerahan.val(format_estimasi_penyerahan);
        });

        // Jika id_keluhan_tambahan change
        $('#id_keluhan_tambahan').change(function(event) {
            leadtime_keluhan = $(this).find(':selected').data("leadtime-keluhan");

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6;

            format_leadtime = time_convert(total);
            total_leadtime.val(format_leadtime);

            // Estimasi Waktu Cuci
            format_estimasi_cuci = total + jam_publish + menit_publish;
            format_estimasi_cuci = time_convert(format_estimasi_cuci);
            estimasi_waktu_cuci.val(format_estimasi_cuci);

            // Estimasi Penyerahan
            format_estimasi_penyerahan = total + jam_publish + menit_publish + 15;
            format_estimasi_penyerahan = time_convert(format_estimasi_penyerahan);
            estimasi_penyerahan.val(format_estimasi_penyerahan);
        });

        // Jika opl1 change
        $('#opl1').change(function(event) {
            opl1 = $(this).find(':selected').data("leadtime-opl1");

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6;

            format_leadtime = time_convert(total);
            total_leadtime.val(format_leadtime);

            // Estimasi Waktu Cuci
            format_estimasi_cuci = total + jam_publish + menit_publish;
            format_estimasi_cuci = time_convert(format_estimasi_cuci);
            estimasi_waktu_cuci.val(format_estimasi_cuci);

            // Estimasi Penyerahan
            format_estimasi_penyerahan = total + jam_publish + menit_publish + 15;
            format_estimasi_penyerahan = time_convert(format_estimasi_penyerahan);
            estimasi_penyerahan.val(format_estimasi_penyerahan);
        });

        // Jika opl2 change
        $('#opl2').change(function(event) {
            opl2 = $(this).find(':selected').data("leadtime-opl2");

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6;

            format_leadtime = time_convert(total);
            total_leadtime.val(format_leadtime);

            // Estimasi Waktu Cuci
            format_estimasi_cuci = total + jam_publish + menit_publish;
            format_estimasi_cuci = time_convert(format_estimasi_cuci);
            estimasi_waktu_cuci.val(format_estimasi_cuci);

            // Estimasi Penyerahan
            format_estimasi_penyerahan = total + jam_publish + menit_publish + 15;
            format_estimasi_penyerahan = time_convert(format_estimasi_penyerahan);
            estimasi_penyerahan.val(format_estimasi_penyerahan);
        });

        // Jika opl3 change
        $('#opl3').change(function(event) {
            opl3 = $(this).find(':selected').data("leadtime-opl3");

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6;

            format_leadtime = time_convert(total);
            total_leadtime.val(format_leadtime);

            // Estimasi Waktu Cuci
            format_estimasi_cuci = total + jam_publish + menit_publish;
            format_estimasi_cuci = time_convert(format_estimasi_cuci);
            estimasi_waktu_cuci.val(format_estimasi_cuci);

            // Estimasi Penyerahan
            format_estimasi_penyerahan = total + jam_publish + menit_publish + 15;
            format_estimasi_penyerahan = time_convert(format_estimasi_penyerahan);
            estimasi_penyerahan.val(format_estimasi_penyerahan);
        });

        // Jika opl4 change
        $('#opl4').change(function(event) {
            opl4 = $(this).find(':selected').data("leadtime-opl4");

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6;

            format_leadtime = time_convert(total);
            total_leadtime.val(format_leadtime);

            // Estimasi Waktu Cuci
            format_estimasi_cuci = total + jam_publish + menit_publish;
            format_estimasi_cuci = time_convert(format_estimasi_cuci);
            estimasi_waktu_cuci.val(format_estimasi_cuci);

            // Estimasi Penyerahan
            format_estimasi_penyerahan = total + jam_publish + menit_publish + 15;
            format_estimasi_penyerahan = time_convert(format_estimasi_penyerahan);
            estimasi_penyerahan.val(format_estimasi_penyerahan);
        });

        // Jika opl5 change
        $('#opl5').change(function(event) {
            opl5 = $(this).find(':selected').data("leadtime-opl5");

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6;

            format_leadtime = time_convert(total);
            total_leadtime.val(format_leadtime);

            // Estimasi Waktu Cuci
            format_estimasi_cuci = total + jam_publish + menit_publish;
            format_estimasi_cuci = time_convert(format_estimasi_cuci);
            estimasi_waktu_cuci.val(format_estimasi_cuci);

            // Estimasi Penyerahan
            format_estimasi_penyerahan = total + jam_publish + menit_publish + 15;
            format_estimasi_penyerahan = time_convert(format_estimasi_penyerahan);
            estimasi_penyerahan.val(format_estimasi_penyerahan);
        });

        // Jika opl6 change
        $('#opl6').change(function(event) {
            opl6 = $(this).find(':selected').data("leadtime-opl6");

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6;

            format_leadtime = time_convert(total);
            total_leadtime.val(format_leadtime);

            // Estimasi Waktu Cuci
            format_estimasi_cuci = total + jam_publish + menit_publish;
            format_estimasi_cuci = time_convert(format_estimasi_cuci);
            estimasi_waktu_cuci.val(format_estimasi_cuci);

            // Estimasi Penyerahan
            format_estimasi_penyerahan = total + jam_publish + menit_publish + 15;
            format_estimasi_penyerahan = time_convert(format_estimasi_penyerahan);
            estimasi_penyerahan.val(format_estimasi_penyerahan);
        });
        
    </script>
<?php $this->end() ?>