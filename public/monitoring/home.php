<?=$this->layout('monitoring::layout');?>

<div class="container-fluid p-0">
    <div class="table-responsive">
        
        <table class="table mb-0 table-hover">
            <thead style="background:#fff;">
                <tr>
                    <th scope="col">No.Pol</th>
                    <th scope="col">Tipe</th>
                    <th scope="col" class="date">Est.Waktu Cuci</th>
                    <th scope="col" class="date">Est.Selesai</th>
                    <th scope="col" class="date">SA</th>
                    <th scope="col">OPL</th>
                    <th scope="col">FO</th>
                    <th scope="col">Wash</th>
                    <th scope="col">Proses</th>
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