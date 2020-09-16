<!-- Layout -->
<?=$this->layout('member::layout')?>
<style type="text/css" media="screen">
    table thead th { text-align: center; vertical-align: middle!important;}
</style>

<div id="alertmsg"></div>

<div class="row">
    <div class="col-md-12">
        <div class="page-header d-flex">
            <h3 class="mr-auto"><i class="fa fa-pencil"></i>Washing</h3>
            <a href="<?=BASE_URL?>/member" class="btn btn-outline-default btn-rounded waves-effect ml-auto btn-sm"><i class="fa fa-arrow-left"></i> Dashboard</a>
        </div>
        <!-- End Page Header -->
        <div class="member-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped" cellpadding="0" cellspacing="0" border="0" width="100%">
                            <thead>
                                <tr>
                                    <th rowspan="2">No.Pol</th>
                                    <th rowspan="2">Nama SA</th>
                                    <th colspan="2">Stall Tunggu</th>
                                    <th colspan="2">Stall Proses</th>
                                    <th rowspan="2">Delivery</th>
                                </tr>
                                <tr>
                                    <th>Jam Tiba</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Tiba</th>
                                    <th>Jam Selesai</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Member content -->
    </div>
    <!-- End col-md-10 -->
</div>

<!-- Add script -->
<?php $this->push('scripts') ?>
    <script>        
        $(document).ready(function() {
            var view = '<?=isset($title) ? $title : ''?>';
            var mytable = $('#table').DataTable({
                "language": {
                    "paginate": {
                        "previous": "Prev"
                    },
                    "infoEmpty": "No entries",
                    "search": "",
                    "sSearchPlaceholder": "Search...",
                    "lengthMenu": '',
                    "infoFiltered": ""
                },
                "autoWidth": false,
                "responsive" : true,
                "columnDefs": [
                    {
                        'targets': 0,
                        "data": 'nobk'
                    },
                    {
                        'targets': 1,
                        "data": 'nama_lengkap'
                    },
                    {
                        'targets': 2,
                        "data": 'f_time'
                    },
                    {
                        'targets': 3,
                        "data": 'w_time'
                    },
                    {
                        'targets': 4,
                        "data": 'w_time'
                    },
                    {
                        'targets': 5,
                        "data": 'jam_selesai_cuci'
                    },
                    {
                        'targets': 6,
                        "data": 'status'
                    }
                ],
                "serverSide": true,
                "processing": true,
                "ajax": {
                    'type': 'post',
                    'url': BASE_URL + '/member/w/datatable',
                    'data': {
                        'view': view
                    }
                },
                "drawCallback": function(settings) {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });

            $(document).on('click','.setselesai',function(){
                var id = $(this).attr("id");
                var dataheadline = "Y";
                $(this).html("Waiting...");
                $.ajax({
                    type: "POST",
                    url: BASE_URL + '/member/w/setselesai',
                    data: 'id='+ id + '&washing='+ dataheadline,
                    success: function(){
                        location.reload(true);
                    }
                });
            });

            $(document).on('click','.approvetiba',function() {
                var id = $(this).attr("id");
                $(this).html("Waiting...");
                $.ajax({
                    type: "POST",
                    url: BASE_URL + '/member/w/approvetiba',
                    data: 'id='+ id,
                    success: function(){
                        location.reload(true);
                    }
                });
            });


            $(document).on('click','.mulaicuci',function() {
                var id = $(this).attr("id");
                var dataheadline = "Y";
                $(this).html("Waiting...");
                $.ajax({
                    type: "POST",
                    url: BASE_URL + '/member/w/mulaicuci',
                    data: 'id='+ id + '&washing='+ dataheadline,
                    success: function(){
                        location.reload(true);
                    }
                });
            });
            
            $('#table_wrapper').find('label').each(function () {
                $(this).parent().append($(this).children());
            });
            $('#table_wrapper .dataTables_filter').addClass('md-form');
        });     
    </script>
<?php $this->end() ?>