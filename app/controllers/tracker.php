<?php
/**
 * CRUD member Tracker
 * @author Asamint
 */
$router->mount('/member', function() use ($router, $templates, $core) 
{	
	/**
	 * Call Tracker
	 */
    $router->get('/tracker(/\w+)?', function($title = null) use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level SA
		if ($_SESSION['leveluser'] != 5) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
		// Data user berdasarkan session
		$user = $core->db->from('users')
			->where('id_user', $_SESSION['iduser'])
			->limit(1)->fetch();
		$user_member = $core->db->from('users')
			->where('id_user', $_SESSION['iduser_member'])
			->limit(1)->fetch();
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
		echo $templates->render('member::tracker_view', compact('title', 'user', 'user_member'));
	});

	// Jenis Mobil
	$router->get('/t/get-jenis-mobil', function() use($core, $templates) {
		// Data user berdasarkan session
		$service = $core->db->from('tipe_mobil')
			->fetchAll();

		$isi_option = [];

		foreach ($service as $data) {
			$isi_option[] = "<option value='" . $data['id'] . "' data-leadtime='" . $data['leadtime'] . "'>". $data['nama'] . "</option>";
		}


		echo json_encode($service);
	});

	// GET Service Berkala
	$router->get('/t/get-service-berkala/(\d+)', function($id = null) use($core, $templates) {
		// Data user berdasarkan session
		$service = $core->db->from('service_berkala')
			->where('id_mobil', $id)
			->orderBy('nama ASC')
			->fetchAll();

		$status = true;
		$isi_option = [];

		foreach ($service as $data) {
			$isi_option[] = "<option value='" . $data['id'] . "' data-leadtime='" . $data['leadtime'] . "'>". $data['nama'] . "</option>";
		}

		echo json_encode($service);
	});

	// Get tracker
	$router->get('/t/get-tracker/(\d+)', function($id = null) use($core, $templates) {
		$table = 'tracker';
		$primarykey = 'id';
		$GLOBALS['core'] = $core;
		$columns = array(
			array('db' => 'p.nobk', 				'dt' => 'nobk'),
			array('db' => 't.nama_tipe', 			'dt' => 'nama_tipe'),
			array('db' => 'p.date_in', 				'dt' => 'date_in',
				'formatter' => function($d, $row){
					$date = $GLOBALS['core']->datetime->tgl_indo($d);
					return $date;
				}
			),
			array('db' => 'p.time', 				'dt' => 'time',
				'formatter' => function($d, $row){
                    return date('H:i', strtotime($d)).' WIB';
				}
			),
			array('db' => 'p.estimasi_waktu_cuci', 		'dt' => 'estimasi_waktu_cuci',
				'formatter' => function($d, $row) {
                    return date('H:i', strtotime($d)).' WIB';
				}
			),
			array('db' => 'p.estimasiselesai', 		'dt' => 'estimasiselesai',
				'formatter' => function($d, $row) {
                    return date('H:i', strtotime($d)).' WIB';
				}
			)
		);
		$joinquery = "FROM tracker AS p JOIN tipe_mobil AS t ON (t.id_tipe = p.tipe_id)";

		$extrawhere = "p.id = '" . $id . "'";
		
		echo json_encode(Racik\Ssp::complex($_GET, $core->connect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	});

	/**
	 * Read Tracker
	 */
	$router->post('/t/datatable', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level SA
		if ($_SESSION['leveluser'] != 5) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
		$table = 'tracker';
		$primarykey = 'id';
		$GLOBALS['core'] = $core;
		$columns = array(
			array('db' => 'p.'.$primarykey, 		'dt' => 'status', 
				'formatter' => function ($d, $row) {
                    $track = $GLOBALS['core']->db->from('tracker')
                        ->select(array('w_status','editor_sa', 's.nama_lengkap'))
                        ->leftJoin('users s ON tracker.editor_sa = s.id_user')
                        ->where('id', $d)
                        ->fetch();
                                            
                    if($track['status']=='Y' || $track['status']=='S') {
                        return "<div class='badge badge-success'>Good Job</div>\n";
                    }elseif($track['w_status']=='Y') {
						return "<div class='badge badge-info'>Penyerahan</div>";
                    }elseif($track['washing_use']=='N' AND $track['f_status']=='Y') {
						return "<div class='badge badge-info'>Penyerahan <i class='fa fa-ship'></i></div>";
                    }elseif($track['opl_1'] =='N' && $track['o_editor_1'] != "0") {
						if($track['date_in'] < date('Y-m-d')) {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-warning'>Pending</div>";
						} else {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-info'>Process</div>";
						}
                    }elseif($track['opl_2'] =='N' && $track['o_editor_2'] != "0") {
						if($track['date_in'] < date('Y-m-d')) {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-warning'>Pending</div>";
						} else {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-info'>Process</div>";
						}
                    }elseif($track['opl_3'] =='N' && $track['o_editor_3'] != "0") {
						if($track['date_in'] < date('Y-m-d')) {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-warning'>Pending</div>";
						} else {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-info'>Process</div>";
						}
                    }elseif($track['opl_4'] =='N' && $track['o_editor_4'] != "0") {
						if($track['date_in'] < date('Y-m-d')) {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-warning'>Pending</div>";
						} else {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-info'>Process</div>";
						}
                    }elseif($track['opl_5'] =='N' && $track['o_editor_5'] != "0") {
						if($track['date_in'] < date('Y-m-d')) {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-warning'>Pending</div>";
						} else {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-info'>Process</div>";
						}
                    }elseif($track['f_status']=='N') {
						if($track['date_in'] < date('Y-m-d')) {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-warning'>Pending</div>";
						} else {
							return "<div class='badge badge-info'>Service</div>";
						}
                    }elseif($track['w_status']=='N') {
						if($track['date_in'] < date('Y-m-d')) {
							return "<a href='".BASE_URL."/member/t/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>\n
							<div class='badge badge-warning'>Pending</div>";
						} else {
							return "<div class='badge badge-info'>Washing</div>";
						}
					}
				}
			),
			array('db' => 'p.nobk', 				'dt' => 'nobk'),
			array('db' => 't.nama_tipe', 			'dt' => 'nama_tipe'),
			array('db' => 'p.date_in', 				'dt' => 'date_in',
				'formatter' => function($d, $row){
					$date = $GLOBALS['core']->datetime->tgl_indo($d);
					return $date;
				}
			),
			array('db' => 'p.time', 				'dt' => 'time',
				'formatter' => function($d, $row){
                    return date('H:i', strtotime($d)).' WIB';
				}
			),
			array('db' => 'p.estimasiselesai', 		'dt' => 'estimasiselesai',
				'formatter' => function($d, $row) {
                    return date('H:i', strtotime($d)).' WIB';
				}
			),
			array('db' => 'p.'.$primarykey, 		'dt' => 'proses',
				'formatter' => function($d, $row){                       
					$track = $GLOBALS['core']->db->from('tracker')
						->select(array('w_status','editor_sa', 's.username', 's.nama_lengkap'))
						->leftJoin('users s ON tracker.editor_sa = s.id_user')
						->where('id', $d)
						->fetch();

					if($track['status']=='Y' || $track['status']=='S') {
						$timer = "<small>".date("H:i",strtotime($track['time_out']))." WIB </small>";
						if ($track['trace'] == 1) {
							$timer .= "<div class='badge badge-success'>On-Time</div>";
						}elseif ($track['trace'] == 2){
							$timer .= "<div class='badge badge-info'>Early</div>";
						}else {
							$timer .= "<div class='badge badge-warning'>Late</div>";
						}
						return $timer;
					}elseif($track['w_status']=='Y') {
						return "<a id='".$d."' data-toggle='tooltip' class='btn btn-sm btn-success setHappy' title='Happy' style='margin-bottom:10px;'>Happy</a>\n
							<a id='".$d."' data-toggle='tooltip' class='btn btn-sm btn-warning setSad' title='Sad' style='margin-bottom:10px;'>Sad</a>";
					}elseif($track['opl_1'] =='N' && $track['o_editor_1'] != "0") {
						return "<div class='badge badge-info'>OPL 1</div>";
					}elseif($track['opl_2'] =='N' && $track['o_editor_2'] != "0") {
						return "<div class='badge badge-info'>OPL 2</div>";
					}elseif($track['opl_3'] =='N' && $track['o_editor_3'] != "0") {
						return "<div class='badge badge-info'>OPL 3</div>";
					}elseif($track['opl_4'] =='N' && $track['o_editor_4'] != "0") {
						return "<div class='badge badge-info'>OPL 4</div>";
					}elseif($track['opl_5'] =='N' && $track['o_editor_5'] != "0") {
						return "<div class='badge badge-info'>OPL 5</div>";
					}elseif($track['f_status']=='N') {
                        return "<div class='badge badge-info'>".$track['username']."</div>";
					}elseif($track['w_status']=='N') {
						return "<div class='badge badge-info'>Washing</div>";
					}else {
						return "<div class='badge badge-info'>Unknown</div>";
					}
				}
			),
			array('db' => 'p.'.$primarykey, 		'dt' => 'aksi', 
				'formatter' => function ($d, $row) {
					$track = $GLOBALS['core']->db->from('tracker t')
                        ->select(array('opl_1','opl_2','opl_3','opl_4','opl_5','forman','f_kelompok'))
						->where('id', $d)
                        ->fetch();

                    return "<a href='".BASE_URL."/member/t/detail/".$d."' data-toggle='tooltip' class='btn btn-sm btn-success' title='Lihat Detail'>Detail</a>";
				}
			),
		);
		$joinquery = "FROM tracker AS p JOIN users AS u ON (u.id_user = p.editor_sa) JOIN tipe_mobil AS t ON (t.id_tipe = p.tipe_id)";
				
        switch ($_POST['view']) {
            case 'selesai':
				$extrawhere = "p.w_status = 'Y'
				AND p.status = 'N'
				AND p.editor_sa = '".$_SESSION['iduser']."'
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.date = '".date("Y-m-d")."' OR p.status = 'N' 
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.editor_sa = '".$_SESSION['iduser']."'
				AND p.w_status = 'Y' OR p.washing_use = 'N'
				AND p.f_status = 'Y'
				AND p.status = 'N'"; 
                break;

            case 'done':
				$extrawhere = "p.editor_sa = '".$_SESSION['iduser']."'
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.date = '".date("Y-m-d")."' 
				AND p.status = 'Y' OR p.status = 'S'"; 
                break;

            case 'opl':
				$extrawhere = "p.opl = 'N'
				AND p.editor_sa = '".$_SESSION['iduser']."'
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.date = '".date("Y-m-d")."' OR p.status = 'N' 
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.editor_sa = '".$_SESSION['iduser']."'
				AND p.opl = 'N'"; 
                break;

            case 'forman':
                $extrawhere = "p.f_status = 'N'
                AND p.forman = 'Y'
                AND p.editor_sa = '".$_SESSION['iduser']."'
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.date = '".date("Y-m-d")."' OR p.status = 'N' 
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.editor_sa = '".$_SESSION['iduser']."'
                AND p.forman = 'Y'
                AND p.f_status = 'N'";
                break;

            case 'washing':
				$extrawhere = "p.w_status = 'N'
				AND p.washing = 'Y'
				AND p.editor_sa = '".$_SESSION['iduser']."'
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.date = '".date("Y-m-d")."' OR p.status = 'N' 
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.editor_sa = '".$_SESSION['iduser']."'
				AND p.washing = 'Y'
				AND p.w_status = 'N'";
                break;
            
            default:
				$extrawhere = "p.editor_sa = '".$_SESSION['iduser']."' 
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.date = '".date("Y-m-d")."' OR p.status = 'N' 
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.editor_sa = '".$_SESSION['iduser']."'";
                break;
		}
		
		echo json_encode(Racik\Ssp::complex($_POST, $core->connect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	});

	// Monitoring progress service plus
	$router->post('/t/monitoring/datatable', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level Washing
		if ($_SESSION['leveluser'] != 5) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}     
		$table = 'tracker';
		$primarykey = 'id';
		$GLOBALS['core'] = $core;
		$columns = array(
			array('db' => 'p.'.$primarykey, 		'dt' => 'status', 
				'formatter' => function ($d, $row) {
					$track = $GLOBALS['core']->db->from('tracker')
						->where('id', $d)
						->fetch();
					if($track['w_status'] == 'Y') {
						return "<div class='badge badge-success'>Selesai</div>\n";
					} elseif ($track['f_time'] != null) {
						return "<div class='badge badge-info'>Tiba</div>\n";
					} elseif ($track['w_time'] != null) {
						return "<div class='badge badge-info'>Sedang dicuci</div>\n";
					} elseif ($track['f_time'] != null) {
						return "<div class='badge badge-info'>Proses Foreman</div>\n";
					} else {
						return "<div class='badge badge-info'>Menunggu</div>\n";
					}
				}
			),
			array('db' => 'p.nobk', 				'dt' => 'nobk'),
			array('db' => 'u.nama_lengkap', 		'dt' => 'nama_lengkap'),
			array('db' => 'p.date_in', 				'dt' => 'date_in',
				'formatter' => function($d, $row){
					$date = $GLOBALS['core']->datetime->tgl_indo($d);
					return $date;
				}
			),
			array('db' => 'p.f_time', 				'dt' => 'f_time',
				'formatter' => function($d, $row) {
					if ($d == null) {
						return '-';
					}
                    return date('H:i', strtotime($d)).' WIB';
				}
			),
			array('db' => 'p.w_time', 				'dt' => 'w_time',
				'formatter' => function($d, $row) {
					if ($d == null) {
						return '-';
					}
                    return date('H:i', strtotime($d)).' WIB';
				}
			),
			array('db' => 'p.jam_selesai_cuci', 	'dt' => 'jam_selesai_cuci',
				'formatter' => function($d, $row) {
					if ($d == null) {
						return '-';
					}
                    return date('H:i', strtotime($d)).' WIB';
				}
			),
		);
		
        $joinquery = "FROM tracker AS p JOIN users AS u ON (u.id_user = p.editor_sa)";

        $extrawhere = "p.member = '".$_SESSION['iduser_member']."'
                AND p.date = '".date("Y-m-d")."'
                OR p.status = 'N'
                AND p.member = '".$_SESSION['iduser_member']."'";
		
		echo json_encode(Racik\Ssp::complex($_POST, $core->connect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	});
	
	/**
	 * Create Tracker
	 */
	$router->match('GET|POST', '/t/addnew', function() use($core, $templates) 
	{
		// echo "<pre>";
		// return var_dump($_POST);
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level SA
		if ($_SESSION['leveluser'] != 5) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
		// Event addnew
		if (!empty($_POST)) {
			// Cek no.polisi
			$nobk = str_replace(' ', '', strtoupper(trim($_POST['nobk'])));
			// Cek nopol di tracker			
			$tracksql = $core->db->from('tracker')
				->where('nobk', $nobk)
				->where('editor_sa', $_SESSION['iduser'])
				->where('date', date('Y-m-d'))
				->where('member', $_SESSION['iduser_member']);
			$rowNobk = $tracksql->fetch();
			$nobkCount = $tracksql->count();
			if ($nobkCount > 0) {
				$core->flash->info('Maaf, No.Pol <u><b>'.$rowNobk['nobk'].'</b></u> sudah ada dalam daftar tracking. <br>Harap periksa kembali daftar <u><b>tracking</b></u> anda', BASE_URL.'/member/tracker/index', true);
			}else {
				// Validasi
				$core->val->validation_rules(array(
					'nobk' 					=> 'required|max_len,10|min_len,3',
					'tipe_mobil' 			=> 'required',
					'publishdate' 			=> 'required',
					'publishtime' 			=> 'required',
					'estimasi_waktu_cuci' 	=> 'required',
					'estimasiselesai'		=> 'required',
				));
				$core->val->filter_rules(array(
					'nobk' 					=> 'trim',
					'tipe_mobil' 			=> 'trim',
					'id_service_berkala'	=> 'trim',
					'id_keluhan_tambahan'	=> 'trim',
					'jenis_service_opl_1'	=> 'trim',
					'jenis_service_opl_2'	=> 'trim',
					'jenis_service_opl_3'	=> 'trim',
					'jenis_service_opl_4'	=> 'trim',
					'jenis_service_opl_5'	=> 'trim',
					'opl1'					=> 'trim',
					'opl2'					=> 'trim',
					'opl3'					=> 'trim',
					'opl4'					=> 'trim',
					'opl5'					=> 'trim',
					'publishdate' 			=> 'trim',
					'publishtime' 			=> 'trim',
					'estimasi_waktu_cuci'	=> 'trim',
					'estimasiselesai' 		=> 'trim'
				));
				$_POST = $core->val->sanitize($_POST);
				$valid = $core->val->run($_POST);
				// Cek valid
				if ($valid === false) {
					// Notif error
					$core->flash->warning($core->val->get_readable_errors(true));
				} 
				else {
					// Ambil no id terakhir
					$id_tracker = $core->db->from('tracker')
						->select("id")
						->orderBy("id DESC")
						->limit(1)
						->fetch();

					$opl_1 = 'N';
					$opl_2 = 'N';
					$opl_3 = 'N';
					$opl_4 = 'N';
					$opl_5 = 'N';

					if (isset($_POST['opl1'])) {
						$opl_1 = 'Y';
					}

					if (isset($_POST['opl2'])) {
						$opl_2 = 'Y';
					}

					if (isset($_POST['opl3'])) {
						$opl_3 = 'Y';
					}

					if (isset($_POST['opl4'])) {
						$opl_4 = 'Y';
					}

					if (isset($_POST['opl5'])) {
						$opl_5 = 'Y';
					}

					$estimasi_waktu_cuci_sekarang = $valid['estimasi_waktu_cuci'];

					$estimasi_waktu_cuci_sekarang = explode(':', $estimasi_waktu_cuci_sekarang);

					$jam_est = $estimasi_waktu_cuci_sekarang[0];
					$menit_est_old = $estimasi_waktu_cuci_sekarang[1];
					$menit_est = '0';

					if ($menit_est_old < 15) {
						$menit_est = '00';
					} elseif ($menit_est_old < 30) {
						$menit_est = '15';
					} elseif ($menit_est_old < 45) {
						$menit_est = '30';
					} elseif ($menit_est_old < 59) {
						$menit_est = '45';
					}

					$estimasi_waktu_cuci_sekarang = date('h:i', strtotime($jam_est . ":" . $menit_est));

					$estimasi_waktu_cuci_15mnt = strtotime("+15 minutes", strtotime($estimasi_waktu_cuci_sekarang));
					$estimasi_waktu_cuci_15mnt = date('h:i', $estimasi_waktu_cuci_15mnt);

					// return var_dump($estimasi_waktu_cuci_sekarang);

					// Select antrian
					$tracker = $core->db->from('tracker')
						->where('date_in', date('Y-m-d'))
						->where('forman', 'N')
						->where('washing', 'N')
						->where('status', 'N')
						->where('estimasi_waktu_cuci >=	? ', $estimasi_waktu_cuci_sekarang)
						->where('estimasi_waktu_cuci <=	? ', $estimasi_waktu_cuci_15mnt)
						->orderBy('estimasiselesai DESC')
						->count();

					$estimasi_waktu_cuci = $valid['estimasi_waktu_cuci'];
					$estimasiselesai = $valid['estimasiselesai'];

					if ($tracker >= 5) {
						$estimasi_waktu_cuci = strtotime("+46 minutes", strtotime($estimasi_waktu_cuci_sekarang));
						$estimasi_waktu_cuci = date('h:i', $estimasi_waktu_cuci);

						// return var_dump($estimasi_waktu_cuci);

						$estimasiselesai = strtotime("+15 minutes", strtotime($estimasi_waktu_cuci));
						$estimasiselesai = date('h:i', $estimasiselesai);
					} elseif($tracker >= 3) {
						$estimasi_waktu_cuci = strtotime("+31 minutes", strtotime($estimasi_waktu_cuci_sekarang));
						$estimasi_waktu_cuci = date('h:i', $estimasi_waktu_cuci);


						$estimasiselesai = strtotime("+15 minutes", strtotime($estimasi_waktu_cuci));
						$estimasiselesai = date('h:i', $estimasiselesai);
					} elseif ($tracker >= 2) {
						$estimasi_waktu_cuci = strtotime("+16 minutes", strtotime($estimasi_waktu_cuci_sekarang));
						$estimasi_waktu_cuci = date('h:i', $estimasi_waktu_cuci);

						// return var_dump($estimasi_waktu_cuci);

						$estimasiselesai = strtotime("+15 minutes", strtotime($estimasi_waktu_cuci));
						$estimasiselesai = date('h:i', $estimasiselesai);
					}

					// return ;
		
					// Data yang akan diinput
					$data = array(
						'id' 				=> $id_tracker['id']+1,
						'nobk' 				=> str_replace(' ', '', strtoupper($valid['nobk'])),
						'id_service_berkala	'=> $valid['id_service_berkala'],
						'id_keluhan_tambahan'=> $valid['id_keluhan_tambahan'],
						'tipe_id' 			=> $core->string->valid($valid['tipe_mobil'], 'sql'),
						'date' 				=> $valid['publishdate'],
						'date_in' 			=> $valid['publishdate'],
						'time' 				=> $valid['publishtime'],
						'estimasi_waktu_cuci'=> $estimasi_waktu_cuci,
						'estimasiselesai' 	=> $estimasiselesai,
						'editor_sa' 		=> $_SESSION['iduser'],
						'member' 			=> $_SESSION['iduser_member'],
						'opl_1'				=> $opl_1,
						'opl_2'				=> $opl_2,
						'opl_3'				=> $opl_3,
						'opl_4'				=> $opl_4,
						'opl_5'				=> $opl_5,
						'jenis_service_opl_1'=> $valid['jenis_service_opl_1'],
						'jenis_service_opl_2'=> $valid['jenis_service_opl_2'],
						'jenis_service_opl_3'=> $valid['jenis_service_opl_3'],
						'jenis_service_opl_4'=> $valid['jenis_service_opl_4'],
						'jenis_service_opl_5'=> $valid['jenis_service_opl_5'],
						'o_editor_1'		=> $valid['opl1'],
						'o_editor_2'		=> $valid['opl2'],
						'o_editor_3'		=> $valid['opl3'],
						'o_editor_4'		=> $valid['opl4'],
						'o_editor_5'		=> $valid['opl5'],
						'trace' 			=> 1
					);
					$query = $core->db->insertInto('tracker')->values($data);
					$query->execute();
		
					// Data berhasil diinput
					$core->flash->success('Berhasil input data pelanggan', BASE_URL.'/member', true);
				}
			}
		}
		// List mobil
		$mobil = $core->db->from('tipe_mobil')
			->orderBy('nama_tipe', 'ASC')
			->fetchAll();

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
		echo $templates->render('member::tracker_add', compact('mobil'));
	});
	
	/**
	 * Read Tracker
	 */
	$router->post('/t/setselesai', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level SA
		if ($_SESSION['leveluser'] != 5) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}     
		// Track ID  
		$track = $core->db->from('tracker')
			->where('id',  $core->string->valid($_POST['id'], 'sql'))
			->fetch();

		if($track['estimasiselesai'] > $track['time_out']) {
			$track = $core->datetime->beda_waktu($track['estimasiselesai'] , $track['time_out']);
			if($track['h']=='0' AND $track['i']<=30){
				$timer = 1; //On-Time
			}else{
				$timer = 2; //Early
			}
		}else {
			$timer = 3; //Late
		}

		// Update tracker
		if ($_POST['status'] == 'Y')
		{
			$post = array(
				'status' => 'Y',
				'date' => date("Y-m-d"),
				'time_out' => date("H:i"),
				'trace' => $timer
			);
		}
		elseif($_POST['status'] == 'S')
		{
			$post = array(
				'status' => 'S',
				'date' => date("Y-m-d"),
				'time_out' => date("H:i"),
				'trace' => $timer
			);
		}

		$query_post = $core->db->update('tracker')
			->set($post)
			->where('id', $core->string->valid($_POST['id'], 'sql'));
		$query_post->execute();
	});

	/**
	 * Edit Tracker
	 */
    $router->match('GET|POST', '/t/edit/(\d+)', function($id) use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level SA
		if ($_SESSION['leveluser'] != 5) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
		// Event addnew
		if (!empty($_POST)) {
            $id_tracker = $core->db->from('tracker')
                ->select("id")
                ->orderBy("id DESC")
                ->limit(1)
				->fetch();
				
			$tracker = array(
				'id' => $id_tracker['id']+1,
				'nobk' => strtoupper($_POST['nobk']),
				'whatsapp' => $_POST['whatsapp'],
				'email' => $_POST['email'],
				'kerusakan_id' => $_POST['jenis_kerusakan'],
				'tipe_id' => $_POST['tipe_mobil'],
				'date' => $_POST['publishdate'],
				'date_in' => $_POST['publishdate'],
				'date_out' => $_POST['dateout'],
				'time' => $_POST['publishtime'],
				'washing_use' => $_POST['washing_use'],
				'estimasiselesai' => $_POST['estimasiselesai'],
				'editor_sa' => $_SESSION['iduser'],
				'member' => $_SESSION['iduser_member'],
				'keterangan'		=> $_POST['keterangan']
			);
			$query_post = $core->db->update('tracker')
				->set($tracker)
				->where('id', $core->string->valid($_POST['id'], 'sql'));
			$query_post->execute();

			// Data berhasil diinput
			$core->flash->success('Berhasil input data pelanggan', BASE_URL.'/member/tracker/index');
		}
		// Select users
		$tracker = $core->db->from('tracker')
			->where('id', $core->string->valid($id, 'sql'))
			->limit(1)->fetch();
			
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
		
		echo $templates->render('member::tracker_edit', compact('tracker'));
	});
	
	/**
	 * PTM Detail
	 */
    $router->match('GET|POST', '/t/detail/(\d+)', function($id) use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     

		// Select tracker
		$detail = $core->db->from('tracker')
			->where('id', $core->string->valid($id, 'sql'))
			->limit(1)->fetch();

		$mobil = $core->db->from('tipe_mobil')
			->where('id_tipe', $detail['tipe_id'])
			->limit(1)->fetch();

		$service_berkala = $core->db->from('service_berkala')
			->where('id', $detail['id_service_berkala'])
			->limit(1)->fetch();

		$keluhan_tambahan = $core->db->from('service_lain')
			->where('is_opl', false)
			->where('id', $detail['id_keluhan_tambahan'])
			->limit(1)->fetch();

		$opl1 = $core->db->from('service_lain')
			->where('is_opl', true)
			->where('id', $detail['o_editor_1'])
			->limit(1)->fetch();

		$opl2 = $core->db->from('service_lain')
			->where('is_opl', true)
			->where('id', $detail['o_editor_2'])
			->limit(1)->fetch();

		$opl3 = $core->db->from('service_lain')
			->where('is_opl', true)
			->where('id', $detail['o_editor_3'])
			->limit(1)->fetch();

		$opl4 = $core->db->from('service_lain')
			->where('is_opl', true)
			->where('id', $detail['o_editor_4'])
			->limit(1)->fetch();

		$opl5 = $core->db->from('service_lain')
			->where('is_opl', true)
			->where('id', $detail['o_editor_5'])
			->limit(1)->fetch();

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
		
		echo $templates->render('member::opl_detail', compact('mobil', 'detail', 'service_berkala', 'keluhan_tambahan', 'opl1', 'opl2', 'opl3', 'opl4', 'opl5'));
	});
});