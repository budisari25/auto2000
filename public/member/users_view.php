<!-- Layout -->
<?=$this->layout('member::layout')?>

<div id="alertmsg"></div>

<div class="row">
    <div class="col-md-12">
        <div class="page-header d-flex">
            <h3 class="mr-auto"><i class="fa fa-pencil"></i>Users</h3>
            <a href="<?=BASE_URL?>/member" class="btn btn-outline-default btn-rounded waves-effect ml-auto btn-sm"><i class="fa fa-arrow-left"></i> Dashboard</a>
        </div>
        <!-- End Page Header -->
        <div class="member-content">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?=BASE_URL?>/member/mana/export/all-users" class="btn btn-success btn-rounded waves-effect"><i class="fa fa-cloud-download"></i> Export</a>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped" cellpadding="0" cellspacing="0" border="0" width="100%">
                            <thead>
                                <tr>
                                    <th >FullName</th>
                                    <th >Level</th>
                                    <th >Daftar</th>
                                    <th >Block</th>
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

<!-- Modal dialog delete -->
<?=$this->core()->call->html->dialogDelete('user');?>

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
                        "data": 'level'
                    },
                    {
                        'targets': 2,
                        "data": 'daftar'
                    },
                    {
                        'targets': 3,
                        "data": 'block'
                    },
                    {
                        'targets': 4,
                        "data": 'aksi',
                        'width': '10px'
                    }
                ],
                "order": [[1, 'desc']],
                "serverSide": true,
                "processing": true,
                "ajax": {
                    'type': 'post',
                    'url': BASE_URL + '/member/mana/user/datatable'
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
        });     
    </script>
<?php $this->end() ?>