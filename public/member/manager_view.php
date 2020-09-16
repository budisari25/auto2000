<!-- Layout -->
<?=$this->layout('member::layout')?>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="page-header d-flex">
            <h3 class="mr-auto"><i class="fa fa-pencil"></i><?php if($title == 3){ echo "Foreman";} elseif($title==5) { echo "SA";} elseif($title == 6){ echo "Reminder";} else{ echo "Booking";}?></h3>
            <a href="<?=BASE_URL?>/member" class="btn btn-outline-default btn-rounded waves-effect ml-auto btn-sm"><i class="fa fa-arrow-left"></i> Dashboard</a>
        </div>
        <!-- End Page Header -->
        <div class="member-content pt-5">
            <form class="row" id="sorting_data" method="POST" action="<?=BASE_URL?>/member/mana/manager/export/<?=$title?>">
                <div class="col-md-4">
                    <select name="tanggal" class="mdb-select">
                      <option value="0">-- Pilih Tanggal --</option>
                      <option value="1">Hari Ini</option>
                      <option value="2">7 Hari</option>
                      <option value="3">30 Hari</option>
                      <option value="4">3 Bulan</option>
                    </select>

                    <input type="hidden" id="awal" name="awal">
                    <input type="hidden" id="akhir" name="akhir">
                </div>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-success btn-rounded waves-effect"><i class="fa fa-cloud-download"></i> Export</button>
                </div>
            </form>
            <?php if($title == 5) { ?>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card-text time"></div>
                        <div class="table-responsive">
                            <table class="table table-striped" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <thead>
                                    <tr>
                                        <th >UserID</th>
                                        <th >Service</th>
                                        <th >Selesai </th>
                                        <th >OnTime </th>
                                        <th >Early </th>
                                        <th >Late </th>
                                        <th >Persentase</th>
                                    </tr>
                                </thead>
                                <tbody id="tableSa"></tbody>
                            </table>
                        </div>     
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-text times"></div>
                        <div class="table-responsive">
                            <table class="table table-striped" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <thead>
                                    <tr>
                                        <th >UserID</th>
                                        <th >Service</th>
                                        <th >Selesai </th>
                                        <th >OnTime </th>
                                        <th >Early </th>
                                        <th >Late </th>
                                        <th >Persentase</th>
                                    </tr>
                                </thead>
                                <tbody id="tableSaMonth"></tbody>
                            </table>
                        </div>     
                    </div>
                </div>
            <?php } elseif($title == 6) { ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card-text time"></div>
                        <div class="table-responsive">
                            <table class="table table-striped" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <thead>
                                    <tr>
                                        <th >UserID</th>
                                        <th >Approve</th>
                                        <th >Cencel </th>
                                        <th >No Follow </th>
                                        <th >Total </th>
                                    </tr>
                                </thead>
                                <tbody id="tableReminder"></tbody>
                            </table>
                        </div>     
                    </div>
                </div>
            <?php } elseif($title == 3) { ?>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card-text time"></div>
                        <div class="table-responsive">
                            <table class="table table-striped tablemana" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <thead>
                                    <tr>
                                        <th >UserID</th>
                                        <th >Service</th>
                                        <th >Selesai </th>
                                    </tr>
                                </thead>
                                <tbody id="tableforeman"></tbody>
                            </table>
                        </div>     
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-text times"></div>
                        <div class="table-responsive">
                            <table class="table table-striped tablemana" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <thead>
                                    <tr>
                                        <th >UserID</th>
                                        <th >Service</th>
                                        <th >Selesai </th>
                                    </tr>
                                </thead>
                                <tbody id="tableforemanMount"></tbody>
                            </table>
                        </div>     
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-12 col-md-6">                    
                        <div class="card-text time"></div>
                        <div class="table-responsive">
                            <select class="mdb-select">
                                <option value="" selected>All</option>
                                <option>MRA</option>
                                <option>SA</option>
                                <option>BR</option>
                                <option>GY</option>
                                <option>GH</option>
                                <option>RY</option>
                            </select>
                            <table class="table table-striped tablemana" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <thead>
                                    <tr>
                                        <th >UserID</th>
                                        <th >Total</th>
                                        <th >Show</th>
                                        <th >Persentase</th>
                                    </tr>
                                </thead>
                                <tbody id="tablebooking"></tbody>
                            </table>
                        </div>   
                    </div>
                    <div class="col-12 col-md-6">                    
                        <div class="card-text times"></div>
                        <div class="table-responsive">
                            <select class="mdb-select">
                                <option value="" selected>All</option>
                                <option>MRA</option>
                                <option>SA</option>
                                <option>BR</option>
                                <option>GY</option>
                                <option>GH</option>
                                <option>RY</option>
                            </select>
                            <table class="table table-striped tablemana" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <thead>
                                    <tr>
                                        <th >UserID</th>
                                        <th >Total</th>
                                        <th >Show</th>
                                        <th >Persentase</th>
                                    </tr>
                                </thead>
                                <tbody id="tablebookingMonth"></tbody>
                            </table>
                        </div>   
                    </div>
                </div>
            <?php } ?>
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

                var awal = $('#awal').val();
                var akhir = $('#akhir').val();

                if(title == 5) {
                    // SA per month
                    $.ajax({  
                        url: BASE_URL + "/member/mana/sa/month",  
                        method:"POST",  
                        data:{
                            startOfMonth: awal,
                            endOfMonth: akhir
                        },  
                        success:function(data){  
                            $("#tableSa").html(data).fadeIn(500);
                            $("#tableSaMonth").html(data).fadeIn(500);
                            $('.card-text.times').html(moment(awal).format("dddd, MMM Do YYYY") + ' / ' + moment(akhir).format("dddd, MMM Do YYYY"));
                        }  
                    });
                } else if(title == 3) {
                    // Foreman per month
                    $.ajax({  
                        url: BASE_URL + "/member/mana/foreman/month",  
                        method:"POST",  
                        data:{
                            startOfMonth: awal,
                            endOfMonth: akhir
                        },  
                        success:function(data){  
                            $("#tableforeman").html(data).fadeIn(500);
                            $("#tableforemanMount").html(data).fadeIn(500);
                            $('.card-text.times').html(moment(awal).format("dddd, MMM Do YYYY") + ' / ' + moment(akhir).format("dddd, MMM Do YYYY"));
                        }  
                    });
                } else {
                    $.ajax({  
                        url: BASE_URL + "/member/mana/booking/month",  
                        method:"POST",  
                        data:{
                            startOfMonth: awal,
                            endOfMonth: akhir
                        },  
                        success:function(data){  
                            $("#tablebooking").html(data).fadeIn(500);
                            $("#tablebookingMonth").html(data).fadeIn(500);
                            $('.card-text.times').html(moment(awal).format("dddd, MMM Do YYYY") + ' / ' + moment(akhir).format("dddd, MMM Do YYYY"));
                        }  
                    });
                }
            });

            var start   = moment().startOf('month').format("dddd, MMM Do YYYY");
            var today   = moment().format("dddd, MMM Do YYYY");  
                       
            $('.card-text.time').html(today);
            $('.card-text.times').html(start + ' / ' +today);

            // Cek ajax date range
            var form = $('#awal').val();
            var to = $('#akhir').val();


            if(false)
            {
                var startOfMonth = form;
                var endOfMonth   = to;
            }
            else
            {
                var startOfMonth = moment().startOf('month').format('YYYY-MM-DD');
                var endOfMonth   = moment().endOf('month').format('YYYY-MM-DD');
            }

            // function load data Ajax
            function load_data(){  
                if(title == 5) {
                    // SA
                    $.ajax({  
                        url: BASE_URL + "/member/mana/sa",  
                        method:"POST",  
                        success:function(data){  
                            $("#tableSa").html(data).fadeIn(500);
                        }  
                    });
                    // SA per month
                    $.ajax({  
                        url: BASE_URL + "/member/mana/sa/month",  
                        method:"POST",  
                        data:{
                            startOfMonth: startOfMonth,
                            endOfMonth: endOfMonth
                        },  
                        success:function(data){  
                            $("#tableSaMonth").html(data).fadeIn(500);
                        }  
                    });
                } else if(title == 3) {
                    // Foreman
                    $.ajax({  
                        url: BASE_URL + "/member/mana/foreman",  
                        method:"POST",  
                        success:function(data){  
                            $("#tableforeman").html(data).fadeIn(500);
                        }  
                    });
                    // Foreman per month
                    $.ajax({  
                        url: BASE_URL + "/member/mana/foreman/month",  
                        method:"POST",  
                        data:{
                            startOfMonth: startOfMonth,
                            endOfMonth: endOfMonth
                        },  
                        success:function(data){  
                            $("#tableforemanMount").html(data).fadeIn(500);
                        }  
                    });
                } else {            
                    // booking
                    $.ajax({  
                        url: BASE_URL + "/member/mana/booking",  
                        method:"POST",  
                        success:function(data){  
                            $("#tablebooking").html(data).fadeIn(500);
                        }  
                    });

                    var frm = $('#sorting_data');

                    // booking per month
                    $.ajax({  
                        url: BASE_URL + "/member/mana/booking/month",  
                        method:"POST",  
                        data:{
                            startOfMonth: startOfMonth,
                            endOfMonth: endOfMonth
                        },  
                        success:function(data){  
                            $("#tablebookingMonth").html(data).fadeIn(500);
                        }  
                    });
                }
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