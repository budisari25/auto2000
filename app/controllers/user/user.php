<?php
/**
 * CRUD member users
 * @author asamint
 */
$router->mount('/member', function() use ($router, $templates, $core) 
{	
	/**
	 * Call Users
	 */
    $router->get('/mana/user', function() use($core, $templates) {		
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
		// Data template
		$info = array(
			'page_title'	=> $core->setting->site('web_name'),
			'page_desc'		=> $core->setting->site('web_meta'),
			'page_key' 		=> $core->setting->site('web_keyword'),
			'page_owner' 	=> $core->setting->site('web_owner')
		);
		$templates->addData($info);
		// Render Template member user
		echo $templates->render('member::users_view');
	});
	
	/**
	 * Read Users
	 */
    $router->post('/mana/user/datatable', function() use($core, $templates) {
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
		// Tabel dan relasi
		$table = 'users';
		// Primary Key
		$primarykey = 'id_user';
		// Nama Column
		$columns = array(
			array('db' => 'u.'.$primarykey, 		'dt' => $primarykey),
			array('db' => 'u.id_session',		'dt' => 'id_session'),
			array('db' => 'u.username', 		'dt' => 'username'),
			array('db' => 'u.nama_lengkap', 	'dt' => 'nama_lengkap'),
			array('db' => 'ul.title', 			'dt' => 'level'),
			array('db' => 'u.block', 			'dt' => 'block'),
			array('db' => 'u.tgl_daftar', 			'dt' => 'daftar'),
			array('db' => 'u.'.$primarykey, 		'dt' => 'aksi', 
				'formatter' => function($d, $row){
					$del = "<a class='btn btn-sm btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='Delete'><i class='fa fa-times'></i></a>";
					
					return "<div class='btn-group btn-group-xs'>\n
						<a href='".BASE_URL."/member/mana/user/edit/".$row['id_user']."' class='btn btn-sm btn-default' data-toggle='tooltip' title='Edit'><i class='fa fa-pencil'></i></a>
						$del
					</div>\n";
				}
			)
		);
		$joinquery = "FROM users AS u LEFT JOIN user_level AS ul ON (ul.id_level = u.level)";
		// Kondisi
		// $whereAll = "u.id = '".$_SESSION['iduser']."'";
		$whereAll = "u.level IN ('2', '3', '4', '5', '6', '7', '9', '8', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19') AND u.company = '".$_SESSION['iduser_member']."'";
		// Jika level member
		echo json_encode(Racik\Ssp::complex($_POST, $core->connect, $table, $primarykey, $columns, $joinquery, $whereAll));
	});
	
	/**
	 * Create Users
	 */
	$router->match('GET|POST', '/user/addnew', function() use($core, $templates) {
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
		// event submit
		if (!empty($_POST)) {
			// Validasi
			$core->val->validation_rules(array(
				'username' => 'required|max_len,50|min_len,3',
				'nama_lengkap' => 'required|max_len,255|min_len,3',
				'password' => 'required|max_len,50|min_len,6',
				'repeatpass' => 'required|max_len,50|min_len,6',
				'level' => 'required'
			));
			$core->val->filter_rules(array(
				'username' => 'trim|sanitize_string',
				'nama_lengkap' => 'trim|sanitize_string',
				'password' => 'trim|md5',
				'repeatpass' => 'trim|md5',
				'level' => 'trim|sanitize_numbers'
			));
			$_POST = $core->val->sanitize($_POST);
			$valid = $core->val->run($_POST);
			// Cek valid
			if ($valid === false) {
				// Notif error
				$core->flash->warning($core->val->get_readable_errors(true));
			} 
			else {
				// Match password
				if($valid['password'] != $valid['repeatpass']) {
					// Notif error
					$core->flash->warning('Password tidak cocok');
				} 
				else {
					// Insert
					$last_user = $core->db->from('users')->limit(1)->orderBy('id_user DESC')->fetch();
					$data = array(
						'id_user' => $last_user['id_user']+1,
						'username' => $valid['username'],
						'password' => $valid['password'],
						'nama_lengkap' => $valid['nama_lengkap'],
						'level' => $valid['level'],
						'tgl_daftar' => date('Ymd'),
						'id_session' => $valid['password'],
						'company' => $_SESSION['iduser_member']
					);
					$query = $core->db->insertInto('users')->values($data);
					$query->execute();
					// Notif berhasil
					$core->flash->success('Pengguna telah berhasil ditambahkan', BASE_URL .'/member/mana/user');
				} //cek password
			} //cek data
		}
		// Data template
		$info = array(
			'page_title'	=> $core->setting->site('web_name'),
			'page_desc'		=> $core->setting->site('web_meta'),
			'page_key' 		=> $core->setting->site('web_keyword'),
			'page_owner' 	=> $core->setting->site('web_owner')
		);
		$templates->addData($info);
		// Render Template admin user
		echo $templates->render('member::users_add');
	});
	
	/**
	 * Update Users
	 */
	$router->match('GET|POST', '/mana/user/edit/([a-z0-9_-]+)', function($id) use($core, $templates) {	
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
		// event submit
		if (!empty($_POST)) {
			// Validasi
			$core->val->validation_rules(array(
				'nama_lengkap' => 'required|max_len,255|min_len,2',
				'ket' => 'required',
			));
			$core->val->filter_rules(array(
				'nama_lengkap' => 'trim',
				'ket' => 'trim'
			));
			$_POST = $core->val->sanitize($_POST);
			$valid = $core->val->run(array_merge($_POST, $_FILES));
			// Cek valid
			if ($valid === false) {
				// Notif error
				$core->flash->warning($core->val->get_readable_errors(true));
			} 
			else {
				$data = array(
					'nama_lengkap' => $valid['nama_lengkap'],
					'level' => $valid['ket']
				);
				// Update by id_user
				$query = $core->db->update('users')
					->set($data)
					->where('id_user', $core->string->valid($_POST['id'], 'xss'));
				$query->execute();
				// Notif berhasil
				$core->flash->success('Pengguna berhasil diperbarui', BASE_URL .'/member/mana/user');
			} //cek data
		}
		// Data template
		$info = array(
			'page_title'	=> $core->setting->site('web_name'),
			'page_desc'		=> $core->setting->site('web_meta'),
			'page_key' 		=> $core->setting->site('web_keyword'),
			'page_owner' 	=> $core->setting->site('web_owner')
		);
		$templates->addData($info);
		// Select users
		$id_user = $core->string->valid($id, 'xss');
		$user = $core->db->from('users')
			->select('user_level.title')
			->leftJoin('user_level ON user_level.id_level = users.level')
			->where('users.id_user', $id_user)
			->limit(1)
			->fetch();
		// Render Template member user
		echo $templates->render('member::users_edit', compact('user'));
	});

	/**
	 * Delete Users
	 */
    $router->post('/user/delete', function() use($core, $templates) {		
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
		// event delete
		// Query select users by id
		$current = $core->db->from('users')
			->where('id_user', $core->string->valid($_POST['id'], 'sql'))
			->limit(1)
			->fetch();
		// Cek data
		if (empty($current)) {
			$core->flash->warning('Data tidak diketahui!', BASE_URL.'/member/mana/user');
		} else {
			// Query Delete data by id
			$query = $core->db->deleteFrom('users')
				->where('id_user', $core->string->valid($_POST['id'], 'sql'))
				->execute();
			// Notif berhasil
			$core->flash->success('Pengguna berhasil dihapus', BASE_URL.'/member/mana/user');
		}
	});

	/**
	 * Call Rating Users
	 */
    $router->get('/rating', function() use($core, $templates) {		
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
		// Data template
		$info = array(
			'page_title'	=> $core->setting->site('web_name'),
			'page_desc'		=> $core->setting->site('web_meta'),
			'page_key' 		=> $core->setting->site('web_keyword'),
			'page_owner' 	=> $core->setting->site('web_owner')
		);
		$templates->addData($info);
		// Render Template member user
		echo $templates->render('member::rating');
	});
	
	/**
	 * Read Users
	 */
    $router->post('/rating/datatable', function() use($core, $templates) {
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
		// Tabel dan relasi
		$table = 'polling';
		// Primary Key
		$primarykey = 'id';
		// Nama Column
		$columns = array(
			array('db' => 'nobk',		'dt' => 'nobk'),
			array('db' => 'pelayanan_sa', 		'dt' => 'pelayanan_sa',
				'formatter' => function ($d, $row) {
					if($row['pelayanan_sa']==1) {
						return '<i class="fa fa-star"></i>';
					}else if($row['pelayanan_sa']==2){
						return '<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>';
					}else if($row['pelayanan_sa']==3){
						return '<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>';
					}else if($row['pelayanan_sa']==4){
						return '<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>';
					}else if($row['pelayanan_sa']==5){
						return '<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>';
					}
				}
			),
			array('db' => 'hasil_service', 'dt' => 'hasil_service',
				'formatter' => function ($d, $row) {
					if($row['hasil_service']==1) {
						return '<i class="fa fa-star"></i>';
					}else if($row['hasil_service']==2){
						return '<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>';
					}else if($row['hasil_service']==3){
						return '<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>';
					}else if($row['hasil_service']==4){
						return '<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>';
					}else if($row['hasil_service']==5){
						return '<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>';
					}
				}
			),
			array('db' => 'waktu_service', 'dt' => 'waktu_service',
				'formatter' => function ($d, $row) {
					if($row['waktu_service']==1) {
						return 'Lama';
					}else if($row['waktu_service']==2){
						return 'Sedang';
					}else if($row['waktu_service']==3){
						return 'Cepat';
					}
				}
			),
			array('db' => 'penyerahan', 'dt' => 'penyerahan',
				'formatter' => function ($d, $row) {
					if($row['penyerahan']==1) {
						return 'Telat';
					}else if($row['penyerahan']==2){
						return 'Tepat';
					}else if($row['penyerahan']==3){
						return 'Cepat';
					}
				}
			),
			array('db' => 'rekomendasi', 'dt' => 'rekomendasi',
				'formatter' => function ($d, $row) {
					if($row['rekomendasi']==1) {
						return 'Tidak';
					}else if($row['rekomendasi']==2){
						return 'Ya';
					}
				}
			),
			array('db' => 'rate', 	'dt' => 'rate')
		);
		// $joinquery = "FROM polling";
		// Kondisi
		// $whereAll = "u.id = '".$_SESSION['iduser']."'";
		// $whereAll = "u.level IN ('5', '9', '8') AND u.company = '".$_SESSION['iduser_member']."'";
		// Jika level member
		
		echo json_encode(Racik\Ssp::complex($_POST, $core->connect, $table, $primarykey, $columns));
	});
});