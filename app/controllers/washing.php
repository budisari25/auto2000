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
	$router->get('/washing(/\w+)?', function($title = null) use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level washing
		if ($_SESSION['leveluser'] != 4) {
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
		echo $templates->render('member::washing_view', compact('title'));
	});
	
	/**
	 * Read Gallery
	 */
	$router->post('/w/datatable', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level Washing
		if ($_SESSION['leveluser'] != 4) {
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
					if($track['w_status']=='Y') {
						return "<div class='badge badge-success'>Good Job</div>\n";
					} elseif ($track['w_time'] == null) {
						return "<a id='".$d."' data-toggle='tooltip' class='btn btn-sm btn-info mulaicuci' title='Mulai Cuci'>Mulai Cuci</a>
						<a href='".BASE_URL."/member/t/detail/".$d."' data-toggle='tooltip' class='btn btn-sm btn-success' title='Lihat Detail'>Detail</a>";
					} elseif($track['jam_selesai_cuci'] == null) {
						return "<a id='".$d."' data-toggle='tooltip' class='btn btn-sm btn-warning setselesai' title='Selesai'>Selesai</a>\n
						<a href='".BASE_URL."/member/t/detail/".$d."' data-toggle='tooltip' class='btn btn-sm btn-success' title='Lihat Detail'>Detail</a>";
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

        switch ($_POST['view']) {
            case 'tunggu':
                $extrawhere = "p.washing = 'Y'
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.w_status = 'N'
                AND p.date = '".date("Y-m-d")."'
                OR p.status = 'N'
                AND p.washing = 'Y'
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.w_status = 'N'";
                break;

            case 'selesai':
                $extrawhere = "p.w_status = 'Y'
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.w_editor = '".$_SESSION['iduser']."' 
                AND p.date = '".date("Y-m-d")."'
                OR p.status = 'N'
                AND p.w_status = 'Y'
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.w_editor = '".$_SESSION['iduser']."' ";
                break;
            
            default:
                $extrawhere = "p.washing = 'Y' 
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.date = '".date("Y-m-d")."'
                OR p.status = 'N'
                AND p.washing = 'Y' 
                AND p.member = '".$_SESSION['iduser_member']."'";
                break;
        }
		
		echo json_encode(Racik\Ssp::complex($_POST, $core->connect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	});

	/**
	 * Mulai cuci
	 */
	$router->post('/w/mulaicuci', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level Washing
		if ($_SESSION['leveluser'] != 4) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}     
		// Track ID 
		$post = array(
			'w_time' => date('H:i'),
			'w_editor' => $_SESSION['iduser']
		);
		$query_post = $core->db->update('tracker')
			->set($post)
			->where('id', $core->string->valid($_POST['id'], 'sql'));
		$query_post->execute();
	});

	// Set selesai
	$router->post('/w/setselesai', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level Washing
		if ($_SESSION['leveluser'] != 4) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}     
		// Track ID 
		$post = array(
			'w_status' => $core->string->valid($_POST['washing'], 'xss'),
			'jam_selesai_cuci' => date('H:i'),
			'w_editor' => $_SESSION['iduser']
		);
		$query_post = $core->db->update('tracker')
			->set($post)
			->where('id', $core->string->valid($_POST['id'], 'sql'));
		$query_post->execute();
	});
});