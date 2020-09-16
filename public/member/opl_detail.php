<!-- Layout -->
<?=$this->layout('member::layout')?>
<style>
    .nav-tabs {
        background-color: #e0e0e0;
    }
    .nav-tabs .nav-item .nav-link {
        color: #000;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-2">
        <div class="page-header">
            <h3><i class="fa fa-pencil"></i> Detail <?=$detail['nobk']?></h3>
        </div>

        <div class="member-content">
            <a class="btn btn-outline-dark btn-block btn-primary" style="margin-bottom: 5px;"><?=$mobil['nama_tipe']?></a>
        </div>
    </div>

    <div class="col-md-6">
        <div class="page-header">
            <h3>Layanan</h3>
        </div>

        <div class="member-content">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="service-berkala" data-toggle="tab" href="#service" role="tab" aria-controls="service" aria-selected="true">Service Berkala</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="keluhan-tambahan" data-toggle="tab" href="#keluhan" role="tab" aria-controls="keluhan" aria-selected="false">Keluhan Tambahan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="opl-1" data-toggle="tab" href="#service-opl-1" role="tab" aria-controls="service-opl-1" aria-selected="false">OPL 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="opl-2" data-toggle="tab" href="#service-opl-2" role="tab" aria-controls="service-opl-2" aria-selected="false">OPL 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="opl-3" data-toggle="tab" href="#service-opl-3" role="tab" aria-controls="service-opl-3" aria-selected="false">OPL 3</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="opl-4" data-toggle="tab" href="#service-opl-4" role="tab" aria-controls="service-opl-4" aria-selected="false">OPL 4</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="opl-5" data-toggle="tab" href="#service-opl-5" role="tab" aria-controls="service-opl-5" aria-selected="false">OPL 5</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="service" role="tabpanel" aria-labelledby="service-berkala">
                    <a class="btn btn-outline-dark btn-block btn-primary" style="margin-bottom: 5px;"><?=$service_berkala['nama']?> KM</a>
                </div>
                <div class="tab-pane fade" id="keluhan" role="tabpanel" aria-labelledby="keluhan-tambahan">
                    <?php
                        if ($keluhan_tambahan) {
                    ?>
                        <a class="btn btn-outline-dark btn-block btn-primary" style="margin-bottom: 5px;"><?=$keluhan_tambahan['nama']?></a>
                    <?php
                        }
                    ?>
                </div>

                <div class="tab-pane fade" id="service-opl-1" role="tabpanel" aria-labelledby="opl-1">
                    <?php
                        if ($opl1) {
                    ?>
                        <a class="btn btn-outline-dark btn-block btn-primary" style="margin-bottom: 5px;"><?=$opl1['nama']?></a>
                    <?php
                        }
                    ?>
                </div>
                <div class="tab-pane fade" id="service-opl-2" role="tabpanel" aria-labelledby="opl-2">
                    <?php
                        if ($opl2) {
                    ?>
                        <a class="btn btn-outline-dark btn-block btn-primary" style="margin-bottom: 5px;"><?=$opl2['nama']?></a>
                    <?php
                        }
                    ?>
                </div>
                <div class="tab-pane fade" id="service-opl-3" role="tabpanel" aria-labelledby="opl-3">
                    <?php
                        if ($opl3) {
                    ?>
                        <a class="btn btn-outline-dark btn-block btn-primary" style="margin-bottom: 5px;"><?=$opl3['nama']?></a>
                    <?php
                        }
                    ?>
                </div>
                <div class="tab-pane fade" id="service-opl-4" role="tabpanel" aria-labelledby="opl-4">
                    <?php
                        if ($opl4) {
                    ?>
                        <a class="btn btn-outline-dark btn-block btn-primary" style="margin-bottom: 5px;"><?=$opl4['nama']?></a>
                    <?php
                        }
                    ?>
                </div>
                <div class="tab-pane fade" id="service-opl-5" role="tabpanel" aria-labelledby="opl-5">
                    <?php
                        if ($opl5) {
                    ?>
                        <a class="btn btn-outline-dark btn-block btn-primary" style="margin-bottom: 5px;"><?=$opl5['nama']?></a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="page-header">
            <h3>Total</h3>
        </div>

        <div class="member-content">
            <?=$this->form()->formStart(array('method' => 'POST', 'action' => BASE_URL.'/member/t/addnew', 'autocomplete' => 'off'));?>
                <div class="row">
                    <div class="col-md-12">
                        <?=$this->form()->inputText(array('type' => 'text', 'value' => $detail['nobk'], 'label' => 'No Pol', 'name' => 'nobk', 'id' => 'nobk', 'mandatory' => true, 'options' => 'required'));?>
                    </div>

                    <div class="col-12">
                        <div id="service_selected">

                        </div>

                        <div id="keluhan_tambahan_selected">

                        </div>

                        <div id="opl1_selected">

                        </div>

                        <div id="opl2_selected">

                        </div>

                        <div id="opl3_selected">

                        </div>

                        <div id="opl4_selected">

                        </div>

                        <div id="opl5_selected">

                        </div>

                        <!-- Tipe mobil -->
                        <?=$this->form()->inputHidden(array('name' => 'tipe_mobil'));?>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Tanggal Masuk', 'value' => date('Y-m-d'), 'options' => 'readonly'));?>
                        <?=$this->form()->inputHidden(array('name' => 'publishdate', 'value' => $detail['date_in']));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Jam Masuk', 'value' => $detail['time'], 'name' => 'publishtime', 'id' => 'pickatime'));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Estimasi Waktu Cuci', 'name' => 'estimasi_waktu_cuci', 'value' => $detail['estimasi_waktu_cuci'], 'id' => 'pickatime2', 'mandatory' => true, 'options' => 'readonly'));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Estimasi Penyerahan', 'name' => 'estimasiselesai', 'value' => $detail['estimasiselesai'], 'mandatory' => true, 'options' => 'readonly'));?>
                    </div>
                </div>

                <?=$this->form()->formAction();?>
                <?=$this->form()->formEnd();?>
            </div>
        </div>
    </div>
</div>


<!-- Add script -->
<?php $this->push('scripts') ?>
    <script type="text/javascript">
        $(document).ready(function() {

        });

        function keluhan_tambahan(id, leadtime, nama) {
            $('#keluhan_tambahan_selected').html('');
            
            let keluhan = `
                <div id="muncul_keluhan_tambahan_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_keluhan_tambahan(${id})">
                        ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="id_keluhan_tambahan" value="${id}">
                </div>`;
            $('#keluhan_tambahan_selected').html(keluhan);

            leadtime_keluhan = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function hapus_keluhan_tambahan(id) {
            $(`#muncul_keluhan_tambahan_${id}`).remove();
            $('.keluhan_tambahan').removeClass('btn-primary');

            leadtime_keluhan = 0;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function opl_1(id, leadtime, nama) {
            $('#opl1_selected').html('');
            
            let opl = `
                <div id="muncul_opl1_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_opl1(${id})">
                        OPL 1 : ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="opl1" value="${id}">
                </div>`;
            $('#opl1_selected').html(opl);

            opl1 = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function hapus_opl1(id) {
            $(`#muncul_opl1_${id}`).remove();
            $('.opl_1').removeClass('btn-primary');

            opl1 = 0;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function opl_2(id, leadtime, nama) {
            $('#opl2_selected').html('');
            
            let opl = `
                <div id="muncul_opl2_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_opl2(${id})">
                        OPL 2 : ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="opl2" value="${id}">
                </div>`;
            $('#opl2_selected').html(opl);

            opl2 = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function hapus_opl2(id) {
            $(`#muncul_opl2_${id}`).remove();
            $('.opl_2').removeClass('btn-primary');

            opl2 = 0;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function opl_3(id, leadtime, nama) {
            $('#opl3_selected').html('');
            
            let opl = `
                <div id="muncul_opl3_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_opl3(${id})">
                        OPL 3 : ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="opl3" value="${id}">
                </div>`;
            $('#opl3_selected').html(opl);

            opl3 = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function hapus_opl3(id) {
            $(`#muncul_opl3_${id}`).remove();
            $('.opl_3').removeClass('btn-primary');

            opl3 = 0;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function opl_4(id, leadtime, nama) {
            $('#opl4_selected').html('');
            
            let opl = `
                <div id="muncul_opl4_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_opl4(${id})">
                        OPL 4 : ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="opl4" value="${id}">
                </div>`;
            $('#opl4_selected').html(opl);

            opl4 = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function hapus_opl4(id) {
            $(`#muncul_opl4_${id}`).remove();
            $('.opl_4').removeClass('btn-primary');

            opl4 = 0;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function opl_5(id, leadtime, nama) {
            $('#opl5_selected').html('');
            
            let opl = `
                <div id="muncul_opl5_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_opl5(${id})">
                        OPL 5 : ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="opl5" value="${id}">
                </div>`;
            $('#opl5_selected').html(opl);

            opl5 = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        function hapus_opl5(id) {
            $(`#muncul_opl5_${id}`).remove();
            $('.opl_5').removeClass('btn-primary');

            opl5 = 0;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5 + opl6 + opl7 + opl8;

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
        }

        $('.keluhan_tambahan').click(function(e) {
            $('.keluhan_tambahan').removeClass('btn-primary');
            $(this).addClass('btn-primary');
        });

        $('.opl_1').click(function(e) {
            $('.opl_1').removeClass('btn-primary');
            $(this).addClass('btn-primary');
        });

        $('.opl_2').click(function(e) {
            $('.opl_2').removeClass('btn-primary');
            $(this).addClass('btn-primary');
        });

        $('.opl_3').click(function(e) {
            $('.opl_3').removeClass('btn-primary');
            $(this).addClass('btn-primary');
        });

        $('.opl_4').click(function(e) {
            $('.opl_4').removeClass('btn-primary');
            $(this).addClass('btn-primary');
        });

        $('.opl_5').click(function(e) {
            $('.opl_5').removeClass('btn-primary');
            $(this).addClass('btn-primary');
        });

        $(document).on('click','.service_berkala',function(){
            $('.service_berkala').removeClass('btn-primary');
            $(this).addClass('btn-primary');
        });

    </script>
<?php $this->end() ?>