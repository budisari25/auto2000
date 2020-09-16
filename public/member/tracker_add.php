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
            <h3>Jenis Mobil</h3>
        </div>

        <div class="member-content">
            <?php
                foreach ($mobil as $row) {
            ?>
                <a class="btn btn-outline-dark btn-block list_mobil" data-id-list-mobil="<?=$row['id_tipe']?>" style="margin-bottom: 5px;"><?=$row['nama_tipe']?></a>
            <?php
                }
            ?>
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

                </div>
                <div class="tab-pane fade" id="keluhan" role="tabpanel" aria-labelledby="keluhan-tambahan">
                    <?php
                        $menus = $this->core()->call->db->from('service_lain')->where('is_opl', false)->orderBy('id ASC')->fetchAll();
                        
                        foreach($menus as $menu) {
                    ?>
                        <a class="btn btn-outline-dark btn-block keluhan_tambahan" style="margin-bottom: 5px;" onclick="keluhan_tambahan(<?=$menu['id']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                    <?php
                        }
                    ?>
                </div>

                <div class="tab-pane fade" id="service-opl-1" role="tabpanel" aria-labelledby="opl-1">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="opl-spooring" data-toggle="tab" href="#service-opl-spooring" role="tab" aria-controls="service-opl-spooring" aria-selected="false">OPL Spooring</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-salon" data-toggle="tab" href="#service-opl-salon" role="tab" aria-controls="service-opl-salon" aria-selected="false">OPL Salon</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-ac" data-toggle="tab" href="#service-opl-ac" role="tab" aria-controls="service-opl-ac" aria-selected="false">OPL AC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-flushing" data-toggle="tab" href="#service-opl-flushing" role="tab" aria-controls="service-opl-flushing" aria-selected="false">OPL Flushing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-rematching" data-toggle="tab" href="#service-opl-rematching" role="tab" aria-controls="service-opl-rematching" aria-selected="false">OPL Rematching</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="service-opl-spooring" role="tabpanel" aria-labelledby="opl-spooring">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 11)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_1" style="margin-bottom: 5px;" onclick="opl_1(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-salon" role="tabpanel" aria-labelledby="opl-salon">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 12)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_1" style="margin-bottom: 5px;" onclick="opl_1(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-ac" role="tabpanel" aria-labelledby="opl-ac">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 13)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_1" style="margin-bottom: 5px;" onclick="opl_1(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-flushing" role="tabpanel" aria-labelledby="opl-flushing">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 14)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_1" style="margin-bottom: 5px;" onclick="opl_1(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-rematching" role="tabpanel" aria-labelledby="opl-rematching">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 15)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_1" style="margin-bottom: 5px;" onclick="opl_1(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                    </div>
                    
                </div>
                <div class="tab-pane fade" id="service-opl-2" role="tabpanel" aria-labelledby="opl-2">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="opl-spooring-2" data-toggle="tab" href="#service-opl-spooring-2" role="tab" aria-controls="service-opl-spooring" aria-selected="false">OPL Spooring</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-salon-2" data-toggle="tab" href="#service-opl-salon-2" role="tab" aria-controls="service-opl-salon" aria-selected="false">OPL Salon</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-ac-2" data-toggle="tab" href="#service-opl-ac-2" role="tab" aria-controls="service-opl-ac" aria-selected="false">OPL AC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-flushing-2" data-toggle="tab" href="#service-opl-flushing-2" role="tab" aria-controls="service-opl-flushing" aria-selected="false">OPL Flushing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-rematching-2" data-toggle="tab" href="#service-opl-rematching-2" role="tab" aria-controls="service-opl-rematching" aria-selected="false">OPL Rematching</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="service-opl-spooring-2" role="tabpanel" aria-labelledby="opl-spooring">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 11)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_2" style="margin-bottom: 5px;" onclick="opl_2(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-salon-2" role="tabpanel" aria-labelledby="opl-salon">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 12)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_2" style="margin-bottom: 5px;" onclick="opl_2(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-ac-2" role="tabpanel" aria-labelledby="opl-ac">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 13)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_2" style="margin-bottom: 5px;" onclick="opl_2(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-flushing-2" role="tabpanel" aria-labelledby="opl-flushing">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 14)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_2" style="margin-bottom: 5px;" onclick="opl_2(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-rematching-2" role="tabpanel" aria-labelledby="opl-rematching">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 15)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_2" style="margin-bottom: 5px;" onclick="opl_2(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="service-opl-3" role="tabpanel" aria-labelledby="opl-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="opl-spooring-3" data-toggle="tab" href="#service-opl-spooring-3" role="tab" aria-controls="service-opl-spooring" aria-selected="false">OPL Spooring</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-salon-3" data-toggle="tab" href="#service-opl-salon-3" role="tab" aria-controls="service-opl-salon" aria-selected="false">OPL Salon</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-ac-3" data-toggle="tab" href="#service-opl-ac-3" role="tab" aria-controls="service-opl-ac" aria-selected="false">OPL AC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-flushing-3" data-toggle="tab" href="#service-opl-flushing-3" role="tab" aria-controls="service-opl-flushing" aria-selected="false">OPL Flushing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-rematching-3" data-toggle="tab" href="#service-opl-rematching-3" role="tab" aria-controls="service-opl-rematching" aria-selected="false">OPL Rematching</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="service-opl-spooring-3" role="tabpanel" aria-labelledby="opl-spooring">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 11)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_3" style="margin-bottom: 5px;" onclick="opl_3(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-salon-3" role="tabpanel" aria-labelledby="opl-salon">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 12)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_3" style="margin-bottom: 5px;" onclick="opl_3(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-ac-3" role="tabpanel" aria-labelledby="opl-ac">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 13)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_3" style="margin-bottom: 5px;" onclick="opl_3(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-flushing-3" role="tabpanel" aria-labelledby="opl-flushing">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 14)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_3" style="margin-bottom: 5px;" onclick="opl_3(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-rematching-3" role="tabpanel" aria-labelledby="opl-rematching">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 15)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_3" style="margin-bottom: 5px;" onclick="opl_3(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="service-opl-4" role="tabpanel" aria-labelledby="opl-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="opl-spooring-4" data-toggle="tab" href="#service-opl-spooring-4" role="tab" aria-controls="service-opl-spooring" aria-selected="false">OPL Spooring</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-salon-4" data-toggle="tab" href="#service-opl-salon-4" role="tab" aria-controls="service-opl-salon" aria-selected="false">OPL Salon</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-ac-4" data-toggle="tab" href="#service-opl-ac-4" role="tab" aria-controls="service-opl-ac" aria-selected="false">OPL AC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-flushing-4" data-toggle="tab" href="#service-opl-flushing-4" role="tab" aria-controls="service-opl-flushing" aria-selected="false">OPL Flushing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-rematching-4" data-toggle="tab" href="#service-opl-rematching-4" role="tab" aria-controls="service-opl-rematching" aria-selected="false">OPL Rematching</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="service-opl-spooring-4" role="tabpanel" aria-labelledby="opl-spooring">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 11)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_4" style="margin-bottom: 5px;" onclick="opl_4(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-salon-4" role="tabpanel" aria-labelledby="opl-salon">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 12)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_4" style="margin-bottom: 5px;" onclick="opl_4(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-ac-4" role="tabpanel" aria-labelledby="opl-ac">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 13)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_4" style="margin-bottom: 5px;" onclick="opl_4(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-flushing-4" role="tabpanel" aria-labelledby="opl-flushing">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 14)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_4" style="margin-bottom: 5px;" onclick="opl_4(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-rematching-4" role="tabpanel" aria-labelledby="opl-rematching">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 15)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_4" style="margin-bottom: 5px;" onclick="opl_4(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="service-opl-5" role="tabpanel" aria-labelledby="opl-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="opl-spooring-5" data-toggle="tab" href="#service-opl-spooring-5" role="tab" aria-controls="service-opl-spooring" aria-selected="false">OPL Spooring</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-salon-5" data-toggle="tab" href="#service-opl-salon-5" role="tab" aria-controls="service-opl-salon" aria-selected="false">OPL Salon</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-ac-5" data-toggle="tab" href="#service-opl-ac-5" role="tab" aria-controls="service-opl-ac" aria-selected="false">OPL AC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-flushing-5" data-toggle="tab" href="#service-opl-flushing-5" role="tab" aria-controls="service-opl-flushing" aria-selected="false">OPL Flushing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="opl-rematching-5" data-toggle="tab" href="#service-opl-rematching-5" role="tab" aria-controls="service-opl-rematching" aria-selected="false">OPL Rematching</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="service-opl-spooring-5" role="tabpanel" aria-labelledby="opl-spooring">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 11)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_5" style="margin-bottom: 5px;" onclick="opl_5(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-salon-5" role="tabpanel" aria-labelledby="opl-salon">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 12)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_5" style="margin-bottom: 5px;" onclick="opl_5(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-ac-5" role="tabpanel" aria-labelledby="opl-ac">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 13)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_5" style="margin-bottom: 5px;" onclick="opl_5(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-flushing-5" role="tabpanel" aria-labelledby="opl-flushing">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 14)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_5" style="margin-bottom: 5px;" onclick="opl_5(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="service-opl-rematching-5" role="tabpanel" aria-labelledby="opl-rematching">
                            <?php
                                $opl = $this->core()->call->db->from('service_lain')->where('is_opl', true)->where('opl_level', 15)->orderBy('nama ASC')->fetchAll();
                                foreach($opl as $menu) {
                            ?>
                                <a class="btn btn-outline-dark btn-block opl_5" style="margin-bottom: 5px;" onclick="opl_5(<?=$menu['id']?>, <?=$menu['opl_level']?>, <?=$menu['leadtime']?>, '<?=$menu['nama']?>')"><?=$menu['nama']?></a>
                            <?php
                                }
                            ?>
                        </div>

                    </div>
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
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'No Pol', 'name' => 'nobk', 'id' => 'nobk', 'mandatory' => true, 'options' => 'required'));?>
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
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Jam Masuk', 'value' => date('H:i'), 'name' => 'publishtime', 'id' => 'pickatime'));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Estimasi Waktu Cuci', 'name' => 'estimasi_waktu_cuci', 'value' => date('H:i'), 'id' => 'pickatime2', 'mandatory' => true, 'options' => 'readonly'));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Estimasi Penyerahan', 'name' => 'estimasiselesai', 'value' => '00:00', 'mandatory' => true, 'options' => 'readonly'));?>
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

        function time_convert(num) { 
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

        $('.list_mobil').click(function(e) {
            let id = $(this).data("id-list-mobil");
            $('.list_mobil').removeClass('btn-primary');
            $(this).addClass('btn-primary');

            $('[name=tipe_mobil]').val(id);
            $.ajax({
                type: "GET",
                url: BASE_URL + '/member/t/get-service-berkala/' + id,
                dataType: 'JSON',
                success: function(data){
                    $("#service").html('');

                    $.each(data, function(index, val) {
                        $("#service").append(`<a class="btn btn-outline-dark btn-block service_berkala" style="margin-bottom: 5px;" onclick="service_berkala(${val.id}, ${val.leadtime}, ${val.nama})">${val.nama} KM</a>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $('[name=publishtime]').change(function(e) {
            publishtime = $(this);

            pisah_publish = publishtime.val().split(':');
            jam_publish = parseInt(pisah_publish[0] * 60);
            menit_publish = parseInt(pisah_publish[1]);

            // Estimasi Waktu Cuci
            format_estimasi_cuci = total + jam_publish + menit_publish;
            format_estimasi_cuci = time_convert(format_estimasi_cuci);
            estimasi_waktu_cuci.val(format_estimasi_cuci);

            // Estimasi Penyerahan
            format_estimasi_penyerahan = total + jam_publish + menit_publish + 15;
            format_estimasi_penyerahan = time_convert(format_estimasi_penyerahan);
            estimasi_penyerahan.val(format_estimasi_penyerahan);
        });

        function service_berkala(id, leadtime, nama) {
            $('#service_selected').html('');
            
            let service = `
                <div id="muncul_service_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_service_berkala(${id})">
                        ${nama} KM <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="id_service_berkala" value="${id}">
                </div>`;
            $('#service_selected').html(service);

            leadtime_service_berkala = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

        function hapus_service_berkala(id) {
            $(`#muncul_service_${id}`).remove();

            leadtime_service_berkala = 0;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

        function opl_1(id, opl_level, leadtime, nama) {
            $('#opl1_selected').html('');
            
            let opl = `
                <div id="muncul_opl1_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_opl1(${id})">
                        OPL 1 : ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="jenis_service_opl_1" value="${id}">
                    <input type="hidden" name="opl1" value="${opl_level}">
                </div>`;
            $('#opl1_selected').html(opl);

            opl1 = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

        function opl_2(id, opl_level, leadtime, nama) {
            $('#opl2_selected').html('');
            
            let opl = `
                <div id="muncul_opl2_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_opl2(${id})">
                        OPL 2 : ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="jenis_service_opl_2" value="${id}">
                    <input type="hidden" name="opl2" value="${opl_level}">
                </div>`;
            $('#opl2_selected').html(opl);

            opl2 = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

        function opl_3(id, opl_level, leadtime, nama) {
            $('#opl3_selected').html('');
            
            let opl = `
                <div id="muncul_opl3_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_opl3(${id})">
                        OPL 3 : ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="jenis_service_opl_3" value="${id}">
                    <input type="hidden" name="opl3" value="${opl_level}">
                </div>`;
            $('#opl3_selected').html(opl);

            opl3 = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

        function opl_4(id, opl_level, leadtime, nama) {
            $('#opl4_selected').html('');
            
            let opl = `
                <div id="muncul_opl4_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_opl4(${id})">
                        OPL 4 : ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="jenis_service_opl_4" value="${id}">
                    <input type="hidden" name="opl4" value="${opl_level}">
                </div>`;
            $('#opl4_selected').html(opl);

            opl4 = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

        function opl_5(id, opl_level, leadtime, nama) {
            $('#opl5_selected').html('');
            
            let opl = `
                <div id="muncul_opl5_${id}">
                    <a class="btn btn-outline-dark btn-block" style="margin-bottom: 5px;" onclick="hapus_opl5(${id})">
                        OPL 5 : ${nama} <i class="fa fa-trash"></i>
                    </a>
                    <input type="hidden" name="jenis_service_opl_5" value="${id}">
                    <input type="hidden" name="opl5" value="${opl_level}">
                </div>`;
            $('#opl5_selected').html(opl);

            opl5 = leadtime;

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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

            total = leadtime_service_berkala + leadtime_keluhan + opl1 + opl2 + opl3 + opl4 + opl5;

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