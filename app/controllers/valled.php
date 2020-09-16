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
    $router->get('/valled(/\w+)?', function($title = null) use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level SA
		if ($_SESSION['leveluser'] != 16) {
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
		echo $templates->render('member::valled_view', compact('title', 'user', 'user_member'));
	});

	/**
	 * Read Tracker
	 */
	$router->post('/v/datatable', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level SA
		if ($_SESSION['leveluser'] != 16) {
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
			array('db' => 'p.jam_selesai_cuci', 		'dt' => 'jam_selesai_cuci',
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

					if($track['time_out'] == null) {
						return "<a id='".$d."' data-toggle='tooltip' class='btn btn-sm btn-info setselesai' title='Selesai' style='margin-bottom:10px;'>Selesai</a>\n";
					} else {
						return "<a id='".$d."' data-toggle='tooltip' class='btn btn-sm btn-success' title='OK' style='margin-bottom:10px;'>OK</a>";
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
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.date = '".date("Y-m-d")."'
				AND p.f_status = 'Y'
				AND p.status = 'Y'";
                break;

            default:
				$extrawhere = "p.w_status = 'Y'
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.date = '".date("Y-m-d")."'
				AND p.jam_selesai_cuci is not null
				AND p.f_status = 'Y'
				AND p.status = 'N'"; 
                break;
		}
		
		echo json_encode(Racik\Ssp::complex($_POST, $core->connect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	});

	$router->post('/v/setselesai', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level SA
		if ($_SESSION['leveluser'] != 16) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}     
		// Track ID  
		$track = $core->db->from('tracker')
			->where('id',  $core->string->valid($_POST['id'], 'sql'))
			->fetch();

		$jam_sekarang = date('H:i');

		if($track['estimasiselesai'] > $jam_sekarang) {
			$track = $core->datetime->beda_waktu($track['estimasiselesai'] , $jam_sekarang);
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
				'date_out' => date("Y-m-d"),
				'time_out' => $jam_sekarang,
				'trace' => $timer
			);
		}

		$query_post = $core->db->update('tracker')
			->set($post)
			->where('id', $core->string->valid($_POST['id'], 'sql'));
		$query_post->execute();

		return $core->flash->success('Berhasil memproses data', BASE_URL.'/member', true);
	});
});