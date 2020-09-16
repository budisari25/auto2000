<?php
/**
 * CRUD member Gallery
 * @author Asamint
 */
$router->mount('/member', function() use ($router, $templates, $core) 
{	
	/**
	 * Call Gallery
	 */
	$router->get('/foreman(/\w+)?', function($title = null) use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level SA
		if ($_SESSION['leveluser'] != 3) {
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
		echo $templates->render('member::foreman_view', compact('title', 'user', 'user_member'));
	});
	
	/**
	 * Read Gallery
	 */
	$router->post('/f/datatable', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level SA
		if ($_SESSION['leveluser'] != 3) {
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
					if($track['f_status']=='Y') {
						return "<div class='badge badge-success'>Good Job</div>\n";
					}elseif($track['forman']=='Y') {
						return "<a id='".$d."' data-toggle='tooltip' class='btn btn-sm btn-warning setselesai' title='Selesai'>Selesai</a>\n";
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
			),
			array('db' => 'p.'.$primarykey, 		'dt' => 'aksi', 
				'formatter' => function ($d, $row) {
					$track = $GLOBALS['core']->db->from('tracker t')
                        ->select(array('forman','f_kelompok'))
						->where('id', $d)
                        ->fetch();

                    return "<a href='".BASE_URL."/member/t/detail/".$d."' data-toggle='tooltip' class='btn btn-sm btn-success' title='Lihat Detail'>Detail</a>";
				}
			),
		);
        $joinquery = "FROM tracker AS p JOIN users AS u ON (u.id_user = p.editor_sa)";

        switch ($_POST['view']) {
            case 'service':
                $extrawhere = "p.f_kelompok = '".$_SESSION['iduser']."'
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.forman = 'Y' 
                AND p.f_status = 'N' 
                AND p.date = '".date("Y-m-d")."' 
                OR p.status = 'N'
                AND p.f_status = 'N'
                AND p.forman = 'Y'
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.f_kelompok = '".$_SESSION['iduser']."'"; 
                break;

            case 'selesai':
                $extrawhere = "p.f_kelompok = '".$_SESSION['iduser']."'
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.forman = 'Y' 
                AND p.f_status = 'Y' 
                AND p.date = '".date("Y-m-d")."'
                OR p.status = 'N'
                AND p.forman = 'Y' 
                AND p.f_status = 'Y' 
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.f_kelompok = '".$_SESSION['iduser']."'"; 
                break;
            
            default:
                $extrawhere = "p.f_kelompok = '".$_SESSION['iduser']."' 
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.date = '".date("Y-m-d")."' 
                OR p.status = 'N'
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.f_kelompok = '".$_SESSION['iduser']."'"; 
                break;
        }
		
		echo json_encode(Racik\Ssp::complex($_POST, $core->connect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	});
	
	/**
	 * Read Gallery
	 */
	$router->post('/f/setselesai', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level SA
		if ($_SESSION['leveluser'] != 3) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}     
		
		$query_track = $core->db->from('tracker')
			->where('member', $_SESSION['iduser_member'])
			->where('id', $core->string->valid($_POST['id'], 'sql'))
			->where('washing_use', 'Y');
		$count_track = $query_track->count();
		if ($count_track > 0) {
			// Track ID 
			$track = array(
				'f_status' => $core->string->valid($_POST['forman'], 'xss'),
				'f_time' => date('H:i'),
				'washing' => $core->string->valid($_POST['forman'], 'xss')
			);
		} else {
			// Track ID 
			$track = array(
				'f_status' => $core->string->valid($_POST['forman'], 'xss'),
				'f_time' => date('H:i')
			);
		}
		$query_post = $core->db->update('tracker')
			->set($track)
			->where('id', $core->string->valid($_POST['id'], 'sql'));
		$query_post->execute();

		// Data berhasil diinput
		$core->flash->success('Mobil berhasil diselesaikan', BASE_URL.'/member', true);
	});

	/**
	 * Create Tracker
	 */
	$router->match('GET|POST', '/f/addnew', function() use($core, $templates) 
	{
		$core->flash->success('Berhasil menambahkan foto', BASE_URL.'/member/foreman/service', true);
	});
});