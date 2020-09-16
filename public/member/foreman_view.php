<!-- Layout -->
<?=$this->layout('member::layout')?>

<div id="alertmsg"></div>

<div class="row">
    <div class="col-md-12">
        <div class="page-header d-flex">
            <h3 class="mr-auto"><i class="fa fa-pencil"></i>Foreman</h3>
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
                                    <th >Nama SA</th>
                                    <th >No.Pol</th>
                                    <th >Jam Masuk</th>
                                    <th >Est.Cuci</th>
                                    <th >Est.Penyerahan</th>
                                    <th >Status</th>
                                    <th >Aksi</th>
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
                        "data": 'nama_lengkap'
                    },
                    {
                        'targets': 1,
                        "data": 'nobk'
                    },
                    {
                        'targets': 2,
                        "data": 'time'
                    },
                    {
                        'targets': 3,
                        "data": 'estimasi_waktu_cuci'
                    },
                    {
                        'targets': 4,
                        "data": 'estimasiselesai'
                    },
                    {
                        'targets': 5,
                        "data": 'status'
                    },
                    {
                        'targets': 6,
                        "data": 'aksi'
                    }
                ],
                "serverSide": true,
                "processing": true,
                "ajax": {
                    'type': 'post',
                    'url': BASE_URL + '/member/f/datatable',
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
                    url: BASE_URL + '/member/f/setselesai',
                    data: 'id='+ id + '&forman='+ dataheadline,
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