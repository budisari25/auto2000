<!-- Layout -->
<?=$this->layout('member::layout')?>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="page-header d-flex">
            <h3 class="mr-auto">Resume OPL</h3>
            <a href="<?=BASE_URL?>/member" class="btn btn-outline-default btn-rounded waves-effect ml-auto btn-sm"><i class="fa fa-arrow-left"></i> Dashboard</a>
        </div>
        <!-- End Page Header -->
        <div class="member-content pt-5">
            <form class="row" id="sorting_data" method="POST" action="<?=BASE_URL?>/member/mana/export-resume-opl">
                <div class="col-md-4">
                    <select name="tanggal" class="mdb-select">
                      <option value="0">-- Pilih Tanggal --</option>
                      <option value="1">Hari Ini</option>
                      <option value="2">7 Hari</option>
                      <option value="3">30 Hari</option>
                      <option value="4">3 Bulan</option>
                    </select>

                    <input type="hidden" id="awal" name="awal" value="1970-01-01">
                    <input type="hidden" id="akhir" name="akhir" value="2030-01-01">
                </div>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-success btn-rounded waves-effect"><i class="fa fa-cloud-download"></i> Export</button>
                </div>
            </form>
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped" cellpadding="0" cellspacing="0" border="0" width="100%">
                            <thead>
                                <tr>
                                    <th >Pekerjaan OPL</th>
                                    <th >Jumlah Order</th>
                                    <th >Total Leadtime</th>
                                </tr>
                            </thead>
                            <tbody id="tableOpl"></tbody>
                        </table>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add script -->
<?php $this->push('scripts') ?>
    <script>        
        $(document).ready(function() {
            const todayAwal     = "<?php echo date('Y-m-d') ?>";
            const todayAkhir    = "<?php echo date('Y-m-d') ?>";

            const _7Awal        = "<?php echo date('Y-m-d', strtotime('-7 days')) ?>";
            const _7Akhir       = "<?php echo date('Y-m-d') ?>";

            const _30Awal       = "<?php echo date('Y-m-d', strtotime('-30 days')) ?>";
            const _30Akhir      = "<?php echo date('Y-m-d') ?>";

            const _3blnAwal     = "<?php echo date('Y-m-d', strtotime('-90 days')) ?>";
            const _3blnAkhir    = "<?php echo date('Y-m-d') ?>"; 

            const lain          = "<?php echo date('Y-m-d') ?>";

            const title = "<?=$title;?>";

            var awal = '1970-01-01';
            var akhir   = '2030-01-01';

            $('[name=tanggal]').change(function(){
                if ($('[name=tanggal]').val() == 1) { //if user choose hari ini
                    $('#awal').val(todayAwal);
                    $('#akhir').val(todayAkhir);
                }else if($('[name=tanggal]').val() == 2){ //if user choose 7 hari
                    $('#awal').val(_7Awal);
                    $('#akhir').val(_7Akhir);
                }else if($('[name=tanggal]').val() == 3){ //if user choose 30 hari
                    $('#awal').val(_30Awal);
                    $('#akhir').val(_30Akhir);
                }else if($('[name=tanggal]').val() == 4){ // if user choose custom
                    $('#awal').val(_3blnAwal);
                    $('#akhir').val(_3blnAkhir);
                }else{
                    $('#awal').val("1970-01-01");
                    $('#akhir').val(lain); 
                }

                awal = $('#awal').val();
                akhir = $('#akhir').val();

                $.ajax({  
                    url: BASE_URL + "/member/manager/opl/datatable",  
                    method:"POST",  
                    data:{
                        startOfMonth: awal,
                        endOfMonth: akhir
                    },  
                    success:function(data){ 
                        let hasil = JSON.parse(data);
                        $("#tableOpl").html(hasil.opl).fadeIn(500);
                    }  
                });
            });

            function load_data(){
                $.ajax({  
                    url: BASE_URL + "/member/manager/opl/datatable",  
                    method:"POST",  
                    data:{
                        startOfMonth: awal,
                        endOfMonth: akhir
                    },  
                    success:function(data){ 
                        let hasil = JSON.parse(data);
                        $("#tableOpl").html(hasil.opl).fadeIn(500);
                    }  
                });
            }
            load_data();

            // Filter
            var tablebooking = function(item) {
                // Get the value of the select box
                var val = item.val();            
                // Show all the rows
                $('tbody tr').show();            
                // If there is a value hide all the rows except the ones with a data-year of that value
                if(val) {
                    $('tbody tr').not($('tbody tr[data-filter="' + val + '"]')).hide();
                }
            }
            $('select').on('change', function(e){
                // On change fire function
                tablebooking($(this));
            });
            tablebooking($('select'));
        });     
    </script>
<?php $this->end() ?>