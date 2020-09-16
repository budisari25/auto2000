<!-- Layout -->
<?=$this->layout('member::layout')?>

<div id="alertmsg"></div>

<div class="row">
    <div class="col-md-12">
        <div class="page-header d-flex">
            <h3 class="mr-auto"><i class="fa fa-pencil"></i>Tracker</h3>
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
                                    <th >No.Pol</th>
                                    <th >Proses</th>
                                    <th class="no-sort">Status</th>
                                    <th >Aksi</th>
                                    <th >Tipe</th>
                                    <th >Date</th>
                                    <th >Mobil Masuk</th>
                                    <th >Est.Selesai</th>
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
                        "data": 'proses'
                    },
                    {
                        'targets': 2,
                        "data": 'status'
                    },
                    {
                        'targets': 3,
                        "data": 'aksi'
                    },
                    {
                        'targets': 4,
                        "data": 'nama_tipe'
                    },
                    {
                        'targets': 5,
                        "data": 'date_in'
                    },
                    {
                        'targets': 6,
                        "data": 'time'
                    },
                    {
                        'targets': 7,
                        "data": 'estimasiselesai'
                    }
                ],
                "order": [[4, 'desc'], [5, 'desc']],
                "serverSide": true,
                "processing": true,
                "ajax": {
                    'type': 'post',
                    'url': BASE_URL + '/member/t/datatable',
                    'data': {
                        'view': view
                    }
                },
                "drawCallback": function(settings) {
                    $('.setHappy').click(function(){
                        var id = $(this).attr("id");
                        $(".setHappy"+id).html("Waiting...");
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + '/member/t/setselesai',
                            data: 'id='+ id +'&status=Y',
                            cache: false,
                            success: function(data){
                                location.reload(true);
                                // console.log(data);
                            }
                        });
                    });
                    $('.setSad').click(function(){
                        var id = $(this).attr("id");
                        $(".setSad"+id).html("Waiting...");
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + '/member/t/setselesai',
                            data: 'id='+ id +'&status=S',
                            cache: false,
                            success: function(data){
                                location.reload(true);
                                // console.log(data);
                            }
                        });
                    });
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
            
            $('#table_wrapper').find('label').each(function () {
                $(this).parent().append($(this).children());
            });
            $('#table_wrapper .dataTables_filter').addClass('md-form');
        });     
    </script>
<?php $this->end() ?>