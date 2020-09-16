<?=$this->layout('opl::layout');?>
<style type="text/css" media="screen">
    table thead th { text-align: center; vertical-align: middle!important;}
</style>
<div class="container-fluid p-0">
    <div class="table-responsive">
        
        <table class="table mb-0 table-hover">
            <thead style="background:#fff;">
                <tr>
                    <th scope="col" rowspan="2">Nama SA</th>
                    <th scope="col" rowspan="2">No.Pol</th>
                    <th scope="col" rowspan="2">Tipe</th>
                    <th scope="col" colspan="10">Progress OPL</th>
                    <th scope="col">Progress Washing</th>
                    <th scope="col" rowspan="2">Lokasi Kendaraan</th>
                </tr>
                <tr>
                    <th>OPL 1</th>
                    <th>Status</th>
                    <th>OPL 2</th>
                    <th>Status</th>
                    <th>OPL 3</th>
                    <th>Status</th>
                    <th>OPL 4</th>
                    <th>Status</th>
                    <th>OPL 5</th>
                    <th>Status</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="pagination_data"></tbody>
        </table>
    </div>
    <?php
    $record_per_page = 10;
    $total_records = $this->core()->call->db->from('tracker m')
        ->select(array(
            "d.jenis",
            "d.estimasi_pengerjaan",
            "t.nama_tipe"))
        ->leftJoin('tipe_mobil t ON m.tipe_id = t.id_tipe')
        ->where('member = :etm', array(':etm' =>$user_member['id_user']))
        ->where('status = :de OR date = :da', array(':de' => 'N', ':da' => date("Y-m-d")))
        ->where('member = :etma', array(':etma' =>$user_member['id_user']))
        ->orderBy('m.status DESC, m.w_status ASC')
        ->count();
    $total_pages = ceil($total_records/$record_per_page);
    $output = "<div id='pagination' class='d-flex mt-2'>";
    for($i=1; $i<=$total_pages; $i++)
    {  
        $output .= "<span class='pagination_link badge badge-default ml-1' id='".$i."'>".$i."</span>";  
    }  
    $output .= "</div>";
    echo $output;
    ?>
</div>