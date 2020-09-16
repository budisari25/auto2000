<!-- Layout -->
<?=$this->layout('member::layout')?>

<div id="alertmsg"></div>

<div class="row">
    <div class="col-md-12">
        <div class="page-header d-flex">
            <h3 class="mr-auto"><i class="fa fa-pencil"></i>Rating</h3>
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
                                    <th >No Pol</th>
                                    <th >Pelayanan SA</th>
                                    <th >Hasil Service</th>
                                    <th >Waktu Service</th>
                                    <th >Janji Penyerahan</th>
                                    <th >Bersedia Rekomendasi</th>
                                    <th >Rata-Rata</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Member content -->
        <div class="col-sm-12 col-sm-offset-3 text-center">
           <label class="btn btn-sm btn-success">Survey Kepuasan Pelanggan</label>
            <div id="hero-pie" class="graph"></div>
        </div>
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
                        "data": 'pelayanan_sa'
                    },
                    {
                        'targets': 2,
                        "data": 'hasil_service'
                    },
                    {
                        'targets': 3,
                        "data": 'waktu_service'
                    },
                    {
                        'targets': 4,
                        "data": 'penyerahan'
                    },
                    {
                        'targets': 5,
                        "data": 'rekomendasi'
                    },
                    {
                        'targets': 6,
                        "data": 'rate'
                    }
                ],
                "order": [[6, 'desc']],
                "serverSide": true,
                "processing": true,
                "ajax": {
                    'type': 'post',
                    'url': BASE_URL + '/member/rating/datatable'
                },
                "drawCallback": function(settings) {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
            // Event delete by ID
            mytable.on('click','.alertdel', function () {
                var id = $(this).attr("id");
                $('#alertdel').modal('show');
                $('#delid').val(id);
            });
            
            $('#table_wrapper').find('label').each(function () {
                $(this).parent().append($(this).children());
            });
            $('#table_wrapper .dataTables_filter').addClass('md-form');

            Morris.Donut({
              element: 'hero-pie',
              data: [<?=$this->chart()->pie_rate();?>],
            });
        });     
    </script>
<?php $this->end() ?>