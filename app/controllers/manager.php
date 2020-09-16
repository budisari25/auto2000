<?php
// Will result member
$router->mount('/member', function() use ($router, $templates, $core) 
{	
	$router->get('/manager(/\d+)?', function($title = null) use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level manager_view
		if ($_SESSION['leveluser'] != 6) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}    
		$info = array(
			'page_title'	=> $core->setting->site('web_name'),
			'page_desc'		=> $core->setting->site('web_meta'),
			'page_key' 		=> $core->setting->site('web_keyword'),
			'page_owner' 	=> $core->setting->site('web_owner')
		);
		$adddata = array_merge($info);
		$templates->addData(
			$adddata
		);
		echo $templates->render('member::manager_view', compact('title'));
	});	

	$router->get('/manager/resume-washing', function($title = null) use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level manager_view
		if ($_SESSION['leveluser'] != 6) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}    
		$info = array(
			'page_title'	=> $core->setting->site('web_name'),
			'page_desc'		=> $core->setting->site('web_meta'),
			'page_key' 		=> $core->setting->site('web_keyword'),
			'page_owner' 	=> $core->setting->site('web_owner')
		);
		$adddata = array_merge($info);
		$templates->addData(
			$adddata
		);
		echo $templates->render('member::manager_resume_washing', compact('title'));
	});

	// Manager Resume Datatable
	$router->post('/manager/datatable', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}

		$table = 'tracker';
		$primarykey = 'id';
		$GLOBALS['core'] = $core;
		$columns = array(
			array('db' => 'p.nobk', 				'dt' => 'nobk'),
			array('db' => 'u.nama_lengkap', 		'dt' => 'nama_lengkap'),
			array('db' => 'p.date_in', 				'dt' => 'date_in',
				'formatter' => function($d, $row){
					$date = $GLOBALS['core']->datetime->tgl_indo($d);
					return $date;
				}
			),
			array('db' => 'TIMEDIFF(w_time, f_time)', 					'dt' => 'tunggu',
				'formatter' => function($d, $row){
                    return date('H:i', strtotime($d));
				}
			),
			array('db' => 'TIMEDIFF(jam_selesai_cuci, w_time)', 		'dt' => 'process',
				'formatter' => function($d, $row){
                    return date('H:i', strtotime($d));
				}
			),
			array('db' => 'ADDTIME(TIMEDIFF(w_time, f_time), TIMEDIFF(jam_selesai_cuci, w_time))', 		'dt' => 'leadtime',
				'formatter' => function($d, $row){
                    return date('H:i', strtotime($d));
				}
			),
		);
		
		$joinquery = "FROM tracker AS p JOIN users AS u ON (u.id_user = p.editor_sa)";
		
		$extrawhere = "p.member = '".$_SESSION['iduser_member']."'
					AND p.time_out is not null
					AND p.date BETWEEN '" . $_POST['startOfMonth'] . "' AND '" . $_POST['endOfMonth'] . "'";

		echo json_encode(Racik\Ssp::complex($_POST, $core->connect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	});

	$router->match('GET|POST', '/mana/export-resume-washing', function() use ($templates, $core) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level Manager
		if ($_SESSION['leveluser'] != 6) {
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}     
		
		// Fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");	
		// Mendefinisikan nama file ekspor "hasil-export.xls"
		header("Content-Disposition: attachment; filename=export-resume-leadtime-service-plus-".date("Y-m-d").".xls");
		?>
		<table class="table mb-0">
			<thead>
				<tr>
					<h2>Laporan Resume Leadtime Service Plus</h2>
					<h4>E-Monitoring Services Auto2000</h4>
					<h4><?=$core->datetime->today;?>, <?=$core->datetime->tgl_indo(date("Y-m-d"));?></h4>
				</tr>
				<tr>
					<th scope="col">Plat Kendaraan</th>
					<th scope="col">SA</th>
					<th scope="col">Date In</th>
					<th scope="col">Waiting</th>
					<th scope="col">Process</th>
					<th scope="col">Total Leadtime</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$result = '';
				$trackers = $core->db->from('tracker')
					->select(array('TIMEDIFF(w_time, f_time) as tunggu', 'TIMEDIFF(jam_selesai_cuci, w_time) as process', 'ADDTIME(TIMEDIFF(w_time, f_time), TIMEDIFF(jam_selesai_cuci, w_time)) as leadtime'))
					->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
					->where('time_out is not null');

				if (isset($_POST['awal']) && isset($_POST['akhir'])) {
					$trackers = $trackers->where('date BETWEEN :d AND :da', array(':d' => $_POST['awal'], ':da' => $_POST['akhir']));
				}
				
				$trackers = $trackers->fetchAll();
				
				foreach($trackers as $tracker){
					$user = $core->db->from('users')
						->select(array("nama_lengkap"))
						->where('id_user', $tracker['editor_sa'])
						->where('level', 5)
						->fetch();
					$result .= '
					<tr>
						<td>'.$tracker['nobk'].'</td>
						<td>'.$user['nama_lengkap'].'</td>
						<td>'.$tracker['date_in'].'</td>
						<td>'.$tracker['tunggu'].'</td>
						<td>'.$tracker['process'].'</td>
						<td>'.$tracker['leadtime'].'</td>
					</tr>';
				}
				echo $result;
			?>
			</tbody>
		</table>
		<?php
	});

	$router->get('/manager/resume-opl', function($title = null) use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level manager_view
		if ($_SESSION['leveluser'] != 6) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}    
		$info = array(
			'page_title'	=> $core->setting->site('web_name'),
			'page_desc'		=> $core->setting->site('web_meta'),
			'page_key' 		=> $core->setting->site('web_keyword'),
			'page_owner' 	=> $core->setting->site('web_owner')
		);
		$adddata = array_merge($info);
		$templates->addData(
			$adddata
		);
		echo $templates->render('member::manager_resume_opl', compact('title'));
	});	
	$router->post('/manager/opl/datatable', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level Manager
		if ($_SESSION['leveluser'] != 6) {
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
		$result = '';    
		// OPL 1   
		$trackers = $core->db->from('tracker')
			->select(array('TIMEDIFF(o_time_1, jam_mulai_opl_1) as leadtime'))
			->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
			->where('time_out is not null')
			->where('jenis_service_opl_1 is not null')
			->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']))
			->groupBy('jenis_service_opl_1')
			->fetchAll();
		foreach($trackers as $tracker){
			$opl = $core->db->from('service_lain')
				->where('id', $tracker['jenis_service_opl_1'])
				->fetch();

			$oplcount = $core->db->from('tracker')
				->where('jenis_service_opl_1', $tracker['jenis_service_opl_1'])
				->count();

			$result .= '
			<tr>
				<td>'.$opl['nama'].'</td>
				<td>'.$oplcount.'</td>
				<td>'.$tracker['leadtime'].'</td>
			</tr>';
		}

		// OPL 2
		$trackers = $core->db->from('tracker')
			->select(array('TIMEDIFF(o_time_2, jam_mulai_opl_2) as leadtime'))
			->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
			->where('time_out is not null')
			->where('jenis_service_opl_2 is not null')
			->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']))
			->groupBy('jenis_service_opl_2')
			->fetchAll();
		foreach($trackers as $tracker){
			$opl = $core->db->from('service_lain')
				->where('id', $tracker['jenis_service_opl_2'])
				->fetch();

			$oplcount = $core->db->from('tracker')
				->where('jenis_service_opl_2', $tracker['jenis_service_opl_2'])
				->count();

			$result .= '
			<tr>
				<td>'.$opl['nama'].'</td>
				<td>'.$oplcount.'</td>
				<td>'.$tracker['leadtime'].'</td>
			</tr>';
		}

		// OPL 3
		$trackers = $core->db->from('tracker')
			->select(array('TIMEDIFF(o_time_3, jam_mulai_opl_3) as leadtime'))
			->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
			->where('time_out is not null')
			->where('jenis_service_opl_3 is not null')
			->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']))
			->groupBy('jenis_service_opl_3')
			->fetchAll();
		foreach($trackers as $tracker){
			$opl = $core->db->from('service_lain')
				->where('id', $tracker['jenis_service_opl_3'])
				->fetch();

			$oplcount = $core->db->from('tracker')
				->where('jenis_service_opl_3', $tracker['jenis_service_opl_3'])
				->count();

			$result .= '
			<tr>
				<td>'.$opl['nama'].'</td>
				<td>'.$oplcount.'</td>
				<td>'.$tracker['leadtime'].'</td>
			</tr>';
		}

		// OPL 4 
		$trackers = $core->db->from('tracker')
			->select(array('TIMEDIFF(o_time_4, jam_mulai_opl_4) as leadtime'))
			->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
			->where('time_out is not null')
			->where('jenis_service_opl_4 is not null')
			->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']))
			->groupBy('jenis_service_opl_4')
			->fetchAll();
		foreach($trackers as $tracker){
			$opl = $core->db->from('service_lain')
				->where('id', $tracker['jenis_service_opl_4'])
				->fetch();

			$oplcount = $core->db->from('tracker')
				->where('jenis_service_opl_4', $tracker['jenis_service_opl_4'])
				->count();

			$result .= '
			<tr>
				<td>'.$opl['nama'].'</td>
				<td>'.$oplcount.'</td>
				<td>'.$tracker['leadtime'].'</td>
			</tr>';
		}

		// OPL 5
		$trackers = $core->db->from('tracker')
			->select(array('TIMEDIFF(o_time_5, jam_mulai_opl_5) as leadtime'))
			->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
			->where('time_out is not null')
			->where('jenis_service_opl_5 is not null')
			->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']))
			->groupBy('jenis_service_opl_5')
			->fetchAll();
		foreach($trackers as $tracker){
			$opl = $core->db->from('service_lain')
				->where('id', $tracker['jenis_service_opl_5'])
				->fetch();

			$oplcount = $core->db->from('tracker')
				->where('jenis_service_opl_5', $tracker['jenis_service_opl_5'])
				->count();

			$result .= '
			<tr>
				<td>'.$opl['nama'].'</td>
				<td>'.$oplcount.'</td>
				<td>'.$tracker['leadtime'].'</td>
			</tr>';
		}
		
		echo json_encode([
			'opl' => $result
		]);
	});

	$router->match('GET|POST', '/mana/export-resume-opl', function() use ($templates, $core) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level Manager
		if ($_SESSION['leveluser'] != 6) {
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}     
		
		// Fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");	
		// Mendefinisikan nama file ekspor "hasil-export.xls"
		header("Content-Disposition: attachment; filename=export-resume-opl-".date("Y-m-d").".xls");
		?>
		<table class="table mb-0">
			<thead>
				<tr>
					<h2>Laporan Resume OPL</h2>
					<h4>E-Monitoring Services Auto2000</h4>
					<h4><?=$core->datetime->today;?>, <?=$core->datetime->tgl_indo(date("Y-m-d"));?></h4>
				</tr>
				<tr>
					<th scope="col">Pekerjaan OPL</th>
					<th scope="col">Jumlah Order</th>
					<th scope="col">Total Leadtime</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$result = '';    
					// OPL 1   
					$trackers = $core->db->from('tracker')
						->select(array('TIMEDIFF(o_time_1, jam_mulai_opl_1) as leadtime'))
						->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
						->where('time_out is not null')
						->where('jenis_service_opl_1 is not null');

					if (isset($_POST['startOfMonth']) && isset($_POST['endOfMonth'])) {
						$trackers = $trackers->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']));
					}
					
					$trackers = $trackers->groupBy('jenis_service_opl_1')
						->fetchAll();
					foreach($trackers as $tracker){
						$opl = $core->db->from('service_lain')
							->where('id', $tracker['jenis_service_opl_1'])
							->fetch();

						$oplcount = $core->db->from('tracker')
							->where('jenis_service_opl_1', $tracker['jenis_service_opl_1'])
							->count();

						$result .= '
						<tr>
							<td>'.$opl['nama'].'</td>
							<td>'.$oplcount.'</td>
							<td>'.$tracker['leadtime'].'</td>
						</tr>';
					}

					// OPL 2
					$trackers = $core->db->from('tracker')
						->select(array('TIMEDIFF(o_time_2, jam_mulai_opl_2) as leadtime'))
						->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
						->where('time_out is not null')
						->where('jenis_service_opl_2 is not null');

					if (isset($_POST['startOfMonth']) && isset($_POST['endOfMonth'])) {
						$trackers = $trackers->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']));
					}
					
					$trackers = $trackers->groupBy('jenis_service_opl_2')
						->fetchAll();
					foreach($trackers as $tracker){
						$opl = $core->db->from('service_lain')
							->where('id', $tracker['jenis_service_opl_2'])
							->fetch();

						$oplcount = $core->db->from('tracker')
							->where('jenis_service_opl_2', $tracker['jenis_service_opl_2'])
							->count();

						$result .= '
						<tr>
							<td>'.$opl['nama'].'</td>
							<td>'.$oplcount.'</td>
							<td>'.$tracker['leadtime'].'</td>
						</tr>';
					}

					// OPL 3
					$trackers = $core->db->from('tracker')
						->select(array('TIMEDIFF(o_time_3, jam_mulai_opl_3) as leadtime'))
						->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
						->where('time_out is not null')
						->where('jenis_service_opl_3 is not null');

					if (isset($_POST['startOfMonth']) && isset($_POST['endOfMonth'])) {
						$trackers = $trackers->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']));
					}
					
					$trackers = $trackers->groupBy('jenis_service_opl_3')
						->fetchAll();
					foreach($trackers as $tracker){
						$opl = $core->db->from('service_lain')
							->where('id', $tracker['jenis_service_opl_3'])
							->fetch();

						$oplcount = $core->db->from('tracker')
							->where('jenis_service_opl_3', $tracker['jenis_service_opl_3'])
							->count();

						$result .= '
						<tr>
							<td>'.$opl['nama'].'</td>
							<td>'.$oplcount.'</td>
							<td>'.$tracker['leadtime'].'</td>
						</tr>';
					}

					// OPL 4 
					$trackers = $core->db->from('tracker')
						->select(array('TIMEDIFF(o_time_4, jam_mulai_opl_4) as leadtime'))
						->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
						->where('time_out is not null')
						->where('jenis_service_opl_4 is not null');

					if (isset($_POST['startOfMonth']) && isset($_POST['endOfMonth'])) {
						$trackers = $trackers->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']));
					}
					
					$trackers = $trackers->groupBy('jenis_service_opl_4')
						->fetchAll();
					foreach($trackers as $tracker){
						$opl = $core->db->from('service_lain')
							->where('id', $tracker['jenis_service_opl_4'])
							->fetch();

						$oplcount = $core->db->from('tracker')
							->where('jenis_service_opl_4', $tracker['jenis_service_opl_4'])
							->count();

						$result .= '
						<tr>
							<td>'.$opl['nama'].'</td>
							<td>'.$oplcount.'</td>
							<td>'.$tracker['leadtime'].'</td>
						</tr>';
					}

					// OPL 5
					$trackers = $core->db->from('tracker')
						->select(array('TIMEDIFF(o_time_5, jam_mulai_opl_5) as leadtime'))
						->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
						->where('time_out is not null')
						->where('jenis_service_opl_5 is not null');

					if (isset($_POST['startOfMonth']) && isset($_POST['endOfMonth'])) {
						$trackers = $trackers->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']));
					}
					
					$trackers = $trackers->groupBy('jenis_service_opl_5')
						->fetchAll();
					foreach($trackers as $tracker){
						$opl = $core->db->from('service_lain')
							->where('id', $tracker['jenis_service_opl_5'])
							->fetch();

						$oplcount = $core->db->from('tracker')
							->where('jenis_service_opl_5', $tracker['jenis_service_opl_5'])
							->count();

						$result .= '
						<tr>
							<td>'.$opl['nama'].'</td>
							<td>'.$oplcount.'</td>
							<td>'.$tracker['leadtime'].'</td>
						</tr>';
					}
				echo $result;
			?>
			</tbody>
		</table>
		<?php
	});

	$router->match('GET|POST', '/mana/export', function() use ($templates, $core) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level Manager
		if ($_SESSION['leveluser'] != 6) {
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}     
		
		// Fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");	
		// Mendefinisikan nama file ekspor "hasil-export.xls"
		header("Content-Disposition: attachment; filename=export-monitoring-".date("Y-m-d").".xls");
		?>
		<table class="table mb-0">
			<thead>
				<tr>
					<h2>Laporan Harian</h2>
					<h4>E-Monitoring Services Auto2000</h4>
					<h4><?=$core->datetime->today;?>, <?=$core->datetime->tgl_indo(date("Y-m-d"));?></h4>
				</tr>
				<tr>
					<th scope="col">No. BK</th>
					<th scope="col">Tipe</th>
					<th scope="col">Tanggal Masuk</th>
					<th scope="col">Tanggal Selesai</th>
					<th scope="col">Waktu Mulai</th>
					<th scope="col">Estimasi Waktu Selesai</th>
					<th scope="col">Waktu Selesai</th>
					<th scope="col">Status</th>
					<th scope="col">SA</th>
					<th scope="col">SA_waktu</th>
					<th scope="col">PTM</th>
					<th scope="col">PTM_waktu_mulai</th>
					<th scope="col">PTM_waktu_selesai</th>
					<th scope="col">Forman</th>
					<th scope="col">Forman_waktu_mulai</th>
					<th scope="col">Forman_waktu_selesai</th>
					<th scope="col">Washing</th>
					<th scope="col">Washing_waktu_mulai</th>
					<th scope="col">Washing_waktu_selesai</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$trackers = $core->db->from('tracker m')
					->select(array(
						"t.nama_tipe"))
					->leftJoin('tipe_mobil t ON m.tipe_id = t.id_tipe')
					->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
					->where('status = :de OR date = :da', array(':de' => 'N', ':da' => date("Y-m-d")))
					->where('member = :et', array(':et' =>$_SESSION['iduser_member']))
					->orderBy('m.status DESC, m.w_status ASC, m.f_status ASC, m.opl ASC')
					->fetchAll();
				foreach($trackers as $tracker){
					$user = $core->db->from('users')
						->select(array("nama_lengkap"))
						->where('id_user', $tracker['editor_sa'])
						->where('level', 5)
						->fetch();
					$opl = $core->db->from('users')
						->select(array("nama_lengkap"))
						->where('id_user', $tracker['o_editor'])
						->where('level', 2)
						->fetch();
					$forman = $core->db->from('users')
						->select(array("nama_lengkap"))
						->where('id_user', $tracker['f_kelompok'])
						->where('level', 3)
						->fetch();
					$washing = $core->db->from('users')
						->select(array("nama_lengkap"))
						->where('id_user', $tracker['w_editor'])
						->where('level', 4)
						->fetch();
				?>
				<tr <?php if($tracker['date'] < date("Y-m-d")){ 
						echo "style='background: yellow'";
					}elseif($tracker['status'] == 'Y' || $tracker['status'] == 'S'){ 
						echo "style='background: green'";
					}
					?>>
					<td><strong><?=$tracker['nobk'];?></strong></td>
					<td><?=$tracker['nama_tipe'];?></td>
					<td style="text-align: left"><?=$core->datetime->tgl_indo($tracker['date_in']);?></td>
					<td style="text-align: left">                    
						<?php if($tracker['status'] == "Y" || $tracker['status'] == 'S') { ?>
						<?=$core->datetime->tgl_indo($tracker['date']);?>
						<?php }else{ ?>
						-
						<?php } ?>
					</td>
					<td style="text-align: left"><?=$tracker['time'];?></td>
					<td style="text-align: left"><?=$tracker['estimasiselesai'];?></td>
					<td style="text-align: left">                    
						<?php if($tracker['status'] == "Y" || $tracker['status'] == 'S') {
							echo $tracker['time_out'];
						}else{
							echo "-";
						} ?>
					</td>
					<?php
					if($tracker['status'] == "Y" || $tracker['status'] == 'S'){
						if($tracker['time_out'] != NULL) {
							if($tracker['estimasiselesai'] > $tracker['time_out']) {
								$time = $core->datetime->beda_waktu($tracker['estimasiselesai'] , $tracker['time_out']);
								if($time['h']=='0' AND $time['i']<=30){
									echo "<td style='background: green'>On-Time</td>";
								}else{
									echo "<td style='background: blue'>Early</td>";
								}
							}else {
								echo "<td style='background: orange'>Late</td>";
							}
						}else{
							echo "<td>-</td>";
						}
					}else{
						echo "<td>-</td>";
					} ?>
					<td><strong><?=$user['nama_lengkap'];?></strong></td>
					<td style="text-align: left"><?=$tracker['time'];?></td>
					<!-- PTM -->
					<td>
						<?php if($tracker['opl'] == "Y") { ?>					
						<strong><?=$opl['nama_lengkap'];?></strong>
						<?php }else{ ?>
						-
						<?php } ?>
					</td>
					<td style="text-align: left">
						<?php if($tracker['opl'] == "Y") { ?>		
						<div class="badge badge-danger"><?=$tracker['time'];?></div>
						<?php }else{ ?>
						-
						<?php } ?>
					</td>
					<td style="text-align: left">
						<?php if($tracker['opl'] == "Y") { ?>		
						<div class="badge badge-success"><?=$tracker['o_time'];?></div>
						<?php }else{ ?>
						-
						<?php } ?>
					</td>
					<!-- Forman -->
					<td>
						<?php if($tracker['forman'] == "Y") { ?>		
						<strong><?=$forman['nama_lengkap'];?></strong>
						<?php }else{ ?>
						-
						<?php } ?>
					</td>
					<td style="text-align: left">
						<?php if($tracker['forman'] == "Y") { ?>		
						<div class="badge badge-danger"><?=$tracker['o_time'];?></div>
						<?php }else{ ?>
						-
						<?php } ?>
					</td>
					<td style="text-align: left">
						<?php if($tracker['f_status'] == "Y") { ?>		
						<div class="badge badge-success"><?=$tracker['f_time'];?></div>
						<?php }else{ ?>
						-
						<?php } ?>
					</td>
					<!-- Washing -->
					<td>
						<?php if($tracker['w_status'] == "Y") { ?>	
						<strong><?=$washing['nama_lengkap'];?></strong>
						<?php }else{ ?>
						-
						<?php } ?>
					</td>
					<td style="text-align: left">
						<?php if($tracker['f_status'] == "Y") { ?>	
						<div class="badge badge-danger"><?=$tracker['f_time'];?></div>
						<?php }else{ ?>
						-
						<?php } ?>
					</td>
					<td style="text-align: left">
						<?php if($tracker['w_status'] == "Y") { ?>	
						<div class="badge badge-success"><?=$tracker['w_time'];?></div>
						<?php }else{ ?>
						-
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<table>
			<thead>
				<tr></tr>
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
			<tbody>
				<?php
				$result = '';       
				$query = $core->db->from('users u')
					->leftJoin('tracker t ON t.f_kelompok = u.id_user')
					->where('u.level', 5)
					->where('u.company', $_SESSION['iduser_member'])
					->group('u.id_user')
					->order('u.username ASC');
				$users = $query->fetchAll();
				foreach ($users as $user) 
				{                         
					$query_tracker = $core->db->from('tracker')
						->where('date', date('Y-m-d'))
						->where('editor_sa', $user['id_user'])
						->where('member', $_SESSION['iduser_member']);
						
					$tracker = $query_tracker
						->count();             
					$done = $query_tracker
						->where('status', 'Y')
						->count();         
					$time = $query_tracker
						->orderBy('time_out DESC')
						->limit(1)
						->fetch();
					$ontime = $query_tracker
						->where('status', 'Y')
						->where('trace', 1)
						->count();
					$early = $query_tracker
						->where('status', 'Y')
						->where('trace', 2)
						->count();
					$late = $query_tracker
						->where('status', 'Y')
						->where('trace', 3)
						->count();
					$totals = ($ontime!=0) ? round(($ontime/$tracker) * 100, 0) : 0;
					$result .= '
					<tr>
						<td>'.$user['nama_lengkap'].'</td>
						<td>'.$tracker.'</td>
						<td>'.$done.'</td>
						<td>'.$ontime.'</td>
						<td>'.$early.'</td>
						<td>'.$late.'</td>
						<td>'.$time['time_out'].'</td>
						<td>'.$totals.' %</td>
					</tr>';
				}
				echo $result;
				?>
			</tbody>
		</table>

		<table>
			<thead>
				<tr></tr>
				<tr style='background: #eee'>
					<th scope="col">Today</th>
					<th scope="col">Finish</th>
					<th scope="col">Pending</th>
					<th scope="col">Total SA</th>
					<th scope="col">Total PTM</th>
					<th scope="col">Total Forman</th>
					<th scope="col">Total Washing</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>          
						<div class="badge badge-primary">
							<?=$core->db->from('tracker')
							->where('date', date("Y-m-d"))
							->where('member', array($_SESSION['iduser_member']))
							->count();?>
						</div>
					</td>
					<td style='background: green'>          
						<div class="badge badge-success">
							<?=$core->db->from('tracker')
							->where('status', 'Y')
							->where('date', date("Y-m-d"))
							->where('member', array($_SESSION['iduser_member']))
							->count();?>
						</div>
					</td>
					<td style='background: yellow'>          
						<div class="badge badge-warning">
							<?=$core->db->from('tracker')
							->where('status', 'N')
							->where('date < ?', date('Y-m-d'))
							->where('member', array($_SESSION['iduser_member']))
							->count();?>
						</div>
					</td>
					<td>          
						<div class="badge badge-primary">
							<?=$core->db->from('tracker')    
							->where('member = :etma', array(':etma' =>$_SESSION['iduser_member']))       
							->where('date = :da', array(':da' => date("Y-m-d"))) 
							->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
							->count();?>
						</div> 
					</td>
					<td>          
						<div class="badge badge-primary">
							<?=$core->db->from('tracker')
							->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
							->where('opl = :ws', array(':ws' => 'Y'))
							->where('date = :da', array(':da' => date("Y-m-d")))
							->where('opl = :w', array(':w' => 'Y'))
							->where('member = :etma', array(':etma' =>$_SESSION['iduser_member']))
							->count();?>
						</div> 
					</td>
					<td>
						<strong></strong> 
						<div class="badge badge-primary">
							<?=$core->db->from('tracker')
							->where('forman = :ws', array(':ws' => 'Y'))
							->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
							->where('date = :da', array(':da' => date("Y-m-d")))
							->where('member = :etma', array(':etma' =>$_SESSION['iduser_member']))
							->where('forman = :w', array(':w' => 'Y'))
							->count();?>
						</div>
					</td>
					<td>          
						<div class="badge badge-primary">
							<?=$core->db->from('tracker')
							->where('washing = :ws', array(':ws' => 'Y'))
							->where('member = :etm', array(':etm' =>$_SESSION['iduser_member']))
							->where('date = :da', array(':da' => date("Y-m-d")))
							->where('member = :etma', array(':etma' =>$_SESSION['iduser_member']))
							->where('washing = :w', array(':w' => 'Y'))
							->count();?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	});

	// Export data users
	$router->match('GET|POST', '/mana/export/all-users', function() use ($templates, $core) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level Manager
		if ($_SESSION['leveluser'] != 6) {
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}     
		
		// Fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");	
		// Mendefinisikan nama file ekspor "hasil-export.xls"
		header("Content-Disposition: attachment; filename=export-".date("Y-m-d").".xls");
		?>
		<table class="table mb-0">
			<thead>
				<tr>
					<h2>Data Pengguna</h2>
					<h4>E-Reminder Auto2000</h4>
					<h4><?=$core->datetime->today;?>, <?=$core->datetime->tgl_indo(date("Y-m-d"));?></h4>
				</tr>
				<tr>
					<th >FullName</th>
					<th >Level</th>
					<th >Daftar </th>
					<th >Block </th>
				</tr>
			</thead>
			<tbody>
			<?php
				$result = '';  
				$query = $core->db->from('users u')
					->leftJoin('user_level AS ul ON (ul.id_level = u.level)')
					->where("u.level IN ('2', '3', '4', '5', '6', '7', '9', '8', '10') AND u.company = '".$_SESSION['iduser_member']."'");
				$users = $query->fetchAll();
				foreach ($users as $user) 
				{                         
					$level = $core->db->from('user_level')
						->where('id_level = :id', array(':id' => $user['level']))
						->fetch();   

					$result .= '
					<tr>
						<td>'.$user['nama_lengkap'].'</td>
						<td>'.$level['title'].'</td>
						<td>'.$core->datetime->tgl_indo($user['tgl_daftar']).'</td>
						<td>'.$user['block'].'</td>
					</tr>';
				}
				echo $result;
			?>
			</tbody>
		</table>
		
		<?php
	});

	// Date range a month
	$router->match('GET|POST', '/mana/foreman', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level Manager
		if ($_SESSION['leveluser'] != 6) {
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
		$result = '';       
		$query = $core->db->from('users u')
			->leftJoin('tracker t ON t.f_kelompok = u.id_user')
			->where('u.level', 3)
			->where('u.company', $_SESSION['iduser_member'])
			->group('u.id_user');
		$users = $query->fetchAll();
		foreach ($users as $user) 
		{                         
			$tracker = $core->db->from('tracker t')
				->where('t.date', date('Y-m-d'))
				->where('t.f_kelompok', $user['id_user'])
				->where('member', $_SESSION['iduser_member'])
				->count();
			$tracker_done = $core->db->from('tracker t')
				->where('t.date', date('Y-m-d'))
				->where('t.f_status', 'Y')
				->where('t.f_kelompok', $user['id_user'])
				->where('member', $_SESSION['iduser_member'])
				->count();             
			$result .= '
			<tr>
				<td>'.$user['nama_lengkap'].'</td>
				<td>'.$tracker.'</td>
				<td>'.$tracker_done.'</td>
			</tr>';
		}
		echo $result;
	});

	// Date range a month
	$router->match('GET|POST', '/mana/foreman/month', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level Manager
		if ($_SESSION['leveluser'] != 6) {
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
		$result = '';       
		$query = $core->db->from('users u')
			->leftJoin('tracker t ON t.f_kelompok = u.id_user')
			->where('u.level', 3)
			->where('u.company', $_SESSION['iduser_member'])
			->group('u.id_user');
		$users = $query->fetchAll();
		foreach ($users as $user) 
		{                         
			$tracker = $core->db->from('tracker')
				->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']))
				->where('f_kelompok = :s', array(':s' => $user['id_user']))
				->where('member = :ss', array(':ss' => $_SESSION['iduser_member']))
				->count();
			$tracker_done = $core->db->from('tracker')
				->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']))
				->where('f_kelompok = :s', array(':s' => $user['id_user']))
				->where('f_status = :st', array(':st' => 'Y'))
				->where('member = :ss', array(':ss' => $_SESSION['iduser_member']))
				->count();             
			$result .= '
			<tr>
				<td>'.$user['nama_lengkap'].'</td>
				<td>'.$tracker.'</td>
				<td>'.$tracker_done.'</td>
			</tr>';
		}
		echo $result;
	});

	// Date range a month
	$router->match('GET|POST', '/mana/sa', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level Manager
		if ($_SESSION['leveluser'] != 6) {
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
		$result = '';       
		$query = $core->db->from('users u')
			->leftJoin('tracker t ON t.f_kelompok = u.id_user')
			->where('u.level', 5)
			->where('u.company', $_SESSION['iduser_member'])
			->group('u.id_user')
			->order('u.username ASC');
		$users = $query->fetchAll();
		foreach ($users as $user) 
		{                         
			$query_tracker = $core->db->from('tracker')
				->where('date', date('Y-m-d'))
				->where('editor_sa', $user['id_user'])
				->where('member', $_SESSION['iduser_member']);
				
			$tracker = $query_tracker
				->count();             
			$done = $query_tracker
				->where('status', 'Y')
				->count();         
			$time = $query_tracker
				->orderBy('time_out DESC')
				->limit(1)
				->fetch();
			$ontime = $query_tracker
				->where('status', 'Y')
				->where('trace', 1)
				->count();
			$early = $query_tracker
				->where('status', 'Y')
				->where('trace', 2)
				->count();
			$late = $query_tracker
				->where('status', 'Y')
				->where('trace', 3)
				->count();
			$totals = ($ontime!=0) ? round(($ontime/$tracker) * 100, 0) : 0;
			$result .= '
			<tr>
				<td>'.$user['nama_lengkap'].'</td>
				<td>'.$tracker.'</td>
				<td>'.$done.'</td>
				<td>'.$ontime.'</td>
				<td>'.$early.'</td>
				<td>'.$late.'</td>
				<td>'.$time['time_out'].'</td>
				<td>'.$totals.' %</td>
			</tr>';
		}
		echo $result;
	});

	// Date range a month
	$router->match('GET|POST', '/mana/sa/month', function() use($core, $templates) 
	{
		echo json_encode($_POST);
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level Manager
		if ($_SESSION['leveluser'] != 6) {
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
		
		$result = '';       
		$query = $core->db->from('users u')
			->leftJoin('tracker t ON t.f_kelompok = u.id_user')
			->where('u.level', 5)
			->where('u.company', $_SESSION['iduser_member'])
			->group('u.id_user')
			->order('u.username ASC');
		$users = $query->fetchAll();
		foreach ($users as $user) 
		{                         
			$query_tracker = $core->db->from('tracker')
				->where('date BETWEEN :d AND :da', array(':d' => $_POST['startOfMonth'], ':da' => $_POST['endOfMonth']))
				->where('member = :m', array(':m' => $_SESSION['iduser_member']))
				->where('editor_sa = :sa', array(':sa' => $user['id_user']));
				
			$tracker = $query_tracker
				->count();             
			$done = $query_tracker
				->where('status = :sat', array(':sat' => 'Y'))
				->count();         
			$time = $query_tracker
				->orderBy('time_out DESC')
				->limit(1)
				->fetch();
			$ontime = $query_tracker
				->where('status = :sat', array(':sat' => 'Y'))
				->where('trace = :t', array(':t' => 1))
				->count();
			$early = $query_tracker
				->where('status = :sat', array(':sat' => 'Y'))
				->where('trace = :t', array(':t' => 2))
				->count();
			$late = $query_tracker
				->where('status = :sat', array(':sat' => 'Y'))
				->where('trace = :t', array(':t' => 3))
				->count();
			$totals = ($ontime!=0) ? round(($ontime/$tracker) * 100, 0) : 0;
			$result .= '
			<tr>
				<td>'.$user['nama_lengkap'].'</td>
				<td>'.$tracker.'</td>
				<td>'.$done.'</td>
				<td>'.$ontime.'</td>
				<td>'.$early.'</td>
				<td>'.$late.'</td>
				<td>'.$totals.' %</td>
			</tr>';
		}
		echo $result;
	});
	

	// export booking
	$router->match('GET|POST', '/mana/manager/export(/\d+)?', function($title = null) use($core, $templates)
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level Manager
		if ($_SESSION['leveluser'] != 6) {
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}

		if($title == 5) {
			// Fungsi header dengan mengirimkan raw data excel
			header("Content-type: application/vnd-ms-excel");	
			// Mendefinisikan nama file ekspor "hasil-export.xls"
			header("Content-Disposition: attachment; filename=export-manager-sa-".date("Y-m-d").".xls");
			?>
			<table class="table mb-0">
				<thead>
					<tr>
						<h2>SA</h2>
						<h4>E-Reminder Auto2000</h4>
						<h4><?=$core->datetime->tgl_indo($_POST['awal']);?> / <?=$core->datetime->tgl_indo($_POST['akhir']);?></h4>
					</tr>
					<tr>
						<th >UserID</th>
						<th >Service</th>
						<th >Selesai</th>
						<th >OnTime</th>
						<th >Early</th>
						<th >Late</th>
						<th >Persentase</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$result = '';       
					$query = $core->db->from('users u')
						->leftJoin('tracker t ON t.f_kelompok = u.id_user')
						->where('u.level', 5)
						->where('u.company', $_SESSION['iduser_member'])
						->group('u.id_user')
						->order('u.username ASC');
					$users = $query->fetchAll();
					foreach ($users as $user) 
					{                         
						$query_tracker = $core->db->from('tracker')
							->where('date BETWEEN :d AND :da', array(':d' => $_POST['awal'], ':da' => $_POST['akhir']))
							->where('member = :m', array(':m' => $_SESSION['iduser_member']))
							->where('editor_sa = :sa', array(':sa' => $user['id_user']));
							
						$tracker = $query_tracker
							->count();             
						$done = $query_tracker
							->where('status = :sat', array(':sat' => 'Y'))
							->count();         
						$time = $query_tracker
							->orderBy('time_out DESC')
							->limit(1)
							->fetch();
						$ontime = $query_tracker
							->where('status = :sat', array(':sat' => 'Y'))
							->where('trace = :t', array(':t' => 1))
							->count();
						$early = $query_tracker
							->where('status = :sat', array(':sat' => 'Y'))
							->where('trace = :t', array(':t' => 2))
							->count();
						$late = $query_tracker
							->where('status = :sat', array(':sat' => 'Y'))
							->where('trace = :t', array(':t' => 3))
							->count();
						$totals = ($ontime!=0) ? round(($ontime/$tracker) * 100, 0) : 0;
						$result .= '
						<tr>
							<td>'.$user['nama_lengkap'].'</td>
							<td>'.$tracker.'</td>
							<td>'.$done.'</td>
							<td>'.$ontime.'</td>
							<td>'.$early.'</td>
							<td>'.$late.'</td>
							<td>'.$totals.' %</td>
						</tr>';
					}
					echo $result;
				?>
				</tbody>
			</table>
		<?php
		} elseif($title == 3) {
			// Fungsi header dengan mengirimkan raw data excel
			header("Content-type: application/vnd-ms-excel");	
			// Mendefinisikan nama file ekspor "hasil-export.xls"
			header("Content-Disposition: attachment; filename=export-manager-foreman-".date("Y-m-d").".xls");
			?>
			<table class="table mb-0">
				<thead>
					<tr>
						<h2>Foreman</h2>
						<h4>E-Reminder Auto2000</h4>
						<h4><?=$core->datetime->tgl_indo($_POST['awal']);?> / <?=$core->datetime->tgl_indo($_POST['akhir']);?></h4>
					</tr>
					<tr>
						<th >UserID</th>
						<th >Service</th>
						<th >Selesai</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$result = '';       
					$query = $core->db->from('users u')
						->leftJoin('tracker t ON t.f_kelompok = u.id_user')
						->where('u.level', 3)
						->where('u.company', $_SESSION['iduser_member'])
						->group('u.id_user');
					$users = $query->fetchAll();
					foreach ($users as $user) 
					{                         
						$tracker = $core->db->from('tracker')
							->where('date BETWEEN :d AND :da', array(':d' => $_POST['awal'], ':da' => $_POST['akhir']))
							->where('f_kelompok = :s', array(':s' => $user['id_user']))
							->where('member = :ss', array(':ss' => $_SESSION['iduser_member']))
							->count();
						$tracker_done = $core->db->from('tracker')
							->where('date BETWEEN :d AND :da', array(':d' => $_POST['awal'], ':da' => $_POST['akhir']))
							->where('f_kelompok = :s', array(':s' => $user['id_user']))
							->where('f_status = :st', array(':st' => 'Y'))
							->where('member = :ss', array(':ss' => $_SESSION['iduser_member']))
							->count();             
						$result .= '
						<tr>
							<td>'.$user['nama_lengkap'].'</td>
							<td>'.$tracker.'</td>
							<td>'.$tracker_done.'</td>
						</tr>';
					}
					echo $result;
				?>
				</tbody>
			</table>
		<?php
		} else {
			// Fungsi header dengan mengirimkan raw data excel
			header("Content-type: application/vnd-ms-excel");	
			// Mendefinisikan nama file ekspor "hasil-export.xls"
			header("Content-Disposition: attachment; filename=export-manager-booking-".date("Y-m-d").".xls");
			?>
			<table class="table mb-0">
				<thead>
					<tr>
						<h2>Booking</h2>
						<h4>E-Reminder Auto2000</h4>
						<h4><?=$core->datetime->tgl_indo($_POST['awal']);?> / <?=$core->datetime->tgl_indo($_POST['akhir']);?></h4>
					</tr>
					<tr>
						<th >UserID</th>
						<th >Total</th>
						<th >Show</th>
						<th >Persentase</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$result = '';       
					$query = $core->db->from('users u')
						->where('u.level', array('5','9','8'))
						->where('u.company', $_SESSION['iduser_member'])
						->group('u.nama_lengkap')
						->order('u.nama_lengkap ASC');
					$users = $query->fetchAll();
					foreach ($users as $user) 
					{          	
						$sumber_space = str_replace(' ', '', strtolower(trim($user['nama_lengkap'])));
						$sumber = str_replace('.', '', $sumber_space);
						
						$query_book = $core->db->from('booking')
							->where('sumber = :sa', array(':sa' => $sumber))
							->where('booking BETWEEN :d AND :da', array(':d' => $_POST['awal'], ':da' => $_POST['akhir']))
							->where('member = :m', array(':m' => $_SESSION['iduser_member']));

						$tracker = $query_book->count();             
						$done = $query_book->where('status = :st', array(':st' => 'Y'))->count();  
						$totals = ($done!=0) ? round(($done/$tracker) * 100, 0) : 0;  
						
						$exuser = explode('-',$user['nama_lengkap']);

						$result .= '
						<tr data-filter='.$exuser[0].'>
							<td>'.$user['nama_lengkap'].'</td>
							<td>'.$tracker.'</td>
							<td>'.$done.'</td>
							<td>'.$totals.' %</td>
						</tr>';
					}
					echo $result;  

					$query_books = $core->db->from('booking')
						->where('booking BETWEEN :d AND :da', array(':d' => $_POST['awal'], ':da' => $_POST['akhir']))
						->where('member = :m', array(':m' => $_SESSION['iduser_member']));
					$trackers = $query_books
						->count();        
					$dones = $query_books
						->where('status = :st', array(':st' => 'Y'))
						->count();			
					$totalsx = ($dones!=0) ? round(($dones/$trackers) * 100, 0) : 0;  
					echo '<tr style="background:#ccc">
						<td>Sub Total</td>
						<td>'.$trackers.'</td>
						<td>'.$dones.'</td>
						<td>'.$totalsx.' %</td>
					</tr>';
				?>
				</tbody>
			</table>
		<?php
		}
	});
});