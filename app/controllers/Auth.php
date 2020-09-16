<?php
// will result login
$router->match('GET|POST', '/login', function() use($core, $templates)
{
	// Cek status admin
	if (isset($_SESSION['iduser'])) {
		// redirect admin
		header('location:'.BASE_URL.'/member');
	}
	// Cek status member	
	if(isset($_SESSION['iduser_member'])) {
		$demo = $core->db->from('users')
			->where('id_user', $_SESSION['iduser_member'])
			->limit(1)->fetch();
	}
	// event submit
	if (!empty($_POST)) {
		$core->val->validation_rules(array(
			'username' => 'required|max_len,20|min_len,3',
			'password' => 'max_len,50|min_len,6'
		));
		$core->val->filter_rules(array(
			'username' => 'trim|sanitize_string',
			'password' => 'trim|md5'
		));
		$_POST = $core->val->sanitize($_POST);
		$valid = $core->val->run($_POST);
		if ($valid === false) {
			// Notif error
			$core->flash->warning($core->val->get_readable_errors(true));
		} 
		else {
			// Member
			if (empty($_SESSION['iduser_member'])) {
				$query_member = $core->db->from('users')
					->where('username', $valid['username'])
					->where('password', $valid['password'])
					->where('level', array('7'));
				$count_member = $query_member->count();			
				if ($count_member > 0) {
					$user = $query_member->limit(1)->fetch();
					// Hitung masa demo
					$date = new Racik\DateTime;
					$daftarDemo = $date->selisih_tgl($user['tgl_daftar']);
					$masaDemo = 14;
					
					// Cek status demo
					// Bila persyaratan disetujui nilai 1
					// sistem akan secara otomatis aktif pada esok hari
					if ($user['term'] == '1') {
						$termDemo = array(
							'block' => 'N'
						);
						$query = $core->db->update('users')
							->set($termDemo)
							->where('username', $valid['username']);
						$query->execute();

						$timeout = new Racik\Timeout();
						$timeout->rec_session_member($user);
						$sid_lama = session_id();
						session_regenerate_id();
						$sid_baru = session_id();
						$sesi = array(
							'id_session' => $sid_baru
						);
						$query = $core->db->update('users')
							->set($sesi)
							->where('username', $valid['username']);
						$query->execute();
						// Notif berhasil, Redirect member
						$core->flash->success('Selamat datang <b>'.$user['username'].'</b>!', BASE_URL.'/opl', true);
					}

					// Cek status aktif
					if ($daftarDemo == $masaDemo || $daftarDemo >= $masaDemo || $user['block'] == 'Y') {
						$termDemo = array(
							'block' => 'Y'
						);
						$query = $core->db->update('users')
							->set($termDemo)
							->where('username', $valid['username']);
						$query->execute();
						// Notif Akun Belum aktif
						$core->flash->info('Maaf, Fitur Demo <b>'.$user['username'].'</b> sudah berakhir.<br>
						Segera aktifkan akun anda kembali dengan menghubungi team suport racikproject.com.', BASE_URL.'/login', true);
					}
					else
					{
						$timeout = new Racik\Timeout();
						$timeout->rec_session_member($user);
						$sid_lama = session_id();
						session_regenerate_id();
						$sid_baru = session_id();
						$sesi = array(
							'id_session' => $sid_baru
						);
						$query = $core->db->update('users')
							->set($sesi)
							->where('username', $valid['username']);
						$query->execute();
						// Notif berhasil, Redirect member
						$core->flash->success('Selamat datang <b>'.$user['username'].'</b>!', BASE_URL.'/opl', true);
					}
				} 
				// Jika akun tidak ditemukan
				else {
					// Notif Gagal
					$core->flash->warning('Nama pengguna atau password tidak ditemukan!', null, true);
				}
			} 
			// Admin
			else {
				$query_admin = $core->db->from('users')
					->select('user_level.menu')
					->leftJoin('user_level ON user_level.id_level = users.level')
					->where('username', $valid['username'])
					->where('block', 'N')
					->where('company', $_SESSION['iduser_member'])
					->where('users.level', array('2','3','4','5','6','8','9','10','11','12','13','14','15','16', '17', '18', '19'));
				$count_admin = $query_admin->count();
				// Admin
				if ($count_admin > 0) {
					$users = $query_admin->limit(1)->fetch();
					$timeout = new Racik\Timeout();
					$timeout->rec_session($users);
					$timeout->timer();
					$sid_lama = session_id();
					session_regenerate_id();
					$sid_baru = session_id();
					$sesi = array(
						'id_session' => $sid_baru
					);
					$query = $core->db->update('users')
						->set($sesi)
						->where('username', $valid['username']);
					$query->execute();
					// Notif berhasil, Redirect admin
					$core->flash->success('Selamat datang <b>'.$users['nama_lengkap'].'</b>!', BASE_URL.'/member', true);
				} 
				// Jika akun tidak ditemukan
				else {
					// Notif Gagal
					$core->flash->warning('UserID tidak ditemukan!', null, true);
				}
			}
		}
	}
	// Data template
	$info = array(
		'page_title'	=> $core->setting->site('web_name'),
		'page_desc'		=> $core->setting->site('web_meta'),
		'page_key' 		=> $core->setting->site('web_keyword'),
		'page_owner' 	=> $core->setting->site('web_owner')
	);
	$templates->addData($info);
	// Render Template login
	echo $templates->render('login::login', compact('demo'));
});

// will result Register
$router->match('GET|POST', '/register', function() use($core, $templates)
{
	// Cek Status Member
	if (isset($_SESSION['iduser_member'])) {
		// redirect member
		header('location:'.BASE_URL.'/');
	}
	// event submit
	if (!empty($_POST)) {
		// Validasi
		$core->val->validation_rules(array(
			'username' => 'required|max_len,50|min_len,3',
			'email' => 'required|valid_email',
			'password' => 'required|max_len,50|min_len,6'
		));
		$core->val->filter_rules(array(
			'username' => 'trim|sanitize_string',
			'email' => 'trim|sanitize_email',
			'password' => 'trim|md5'
		));
		$_POST = $core->val->sanitize($_POST);
		$valid = $core->val->run($_POST);
		// Cek valid
		if ($valid === false) {
			// Notif error
			$core->flash->warning($core->val->get_readable_errors(true));
		} 
		else {
			// Check Email
			$count_user_email = $core->db->from('users')
				->where('email', $_POST['email'])
				->count();
			// Check Username
			$count_user_name = $core->db->from('users')
				->where('username', strtolower($_POST['username']))
				->count();
			if ($count_user_name > 0) {
				$core->flash->warning('UserID sudah terdaftar sebelumnya', BASE_URL .'/register', true);
			}
			elseif ($count_user_email > 0) {
				$core->flash->warning('Email sudah terdaftar sebelumnya', BASE_URL .'/register', true);
			}
			else {
				// Insert
				$last_user = $core->db->from('users')->limit(1)->orderBy('id_user DESC')->fetch();
				$data = array(
					'id_user' => $last_user['id_user']+1,
					'username' => $valid['username'],
					'password' => $valid['password'],
					'email' => $valid['email'],
					'level' => '7',
					'tgl_daftar' => date('Ymd'),
					'id_session' => $valid['password']
				);
				$query = $core->db->insertInto('users')->values($data);
				$query->execute();
				// Data demo SA
				$datasa = array(
					'company' => $last_user['id_user']+1,
					'username' => 'demosa',
					'nama_lengkap' => 'Demo SA',
					'password' => $valid['password'],
					'email' => $valid['email'],
					'level' => '5',
					'tgl_daftar' => date('Ymd'),
					'id_session' => $valid['password']
				);
				$querysa = $core->db->insertInto('users')->values($datasa);
				$querysa->execute();
				// Data demo Washing
				$datawa = array(
					'company' => $last_user['id_user']+1,
					'username' => 'demowa',
					'nama_lengkap' => 'Demo Wash',
					'password' => $valid['password'],
					'email' => $valid['email'],
					'level' => '4',
					'tgl_daftar' => date('Ymd'),
					'id_session' => $valid['password']
				);
				$querywa = $core->db->insertInto('users')->values($datawa);
				$querywa->execute();
				// Data demo PTM
				$dataopl = array(
					'company' => $last_user['id_user']+1,
					'username' => 'demoopl',
					'nama_lengkap' => 'Demo PTM',
					'password' => $valid['password'],
					'email' => $valid['email'],
					'level' => '2',
					'tgl_daftar' => date('Ymd'),
					'id_session' => $valid['password']
				);
				$queryopl = $core->db->insertInto('users')->values($dataopl);
				$queryopl->execute();
				// Data demo Foreman
				$datafo = array(
					'company' => $last_user['id_user']+1,
					'username' => 'demoforeman',
					'nama_lengkap' => 'Demo Foreman',
					'password' => $valid['password'],
					'email' => $valid['email'],
					'level' => '3',
					'tgl_daftar' => date('Ymd'),
					'id_session' => $valid['password']
				);
				$queryfo = $core->db->insertInto('users')->values($datafo);
				$queryfo->execute();
				// Data demo Manager
				$datamanager = array(
					'company' => $last_user['id_user']+1,
					'username' => 'demomanager',
					'nama_lengkap' => 'Demo Manager',
					'password' => $valid['password'],
					'email' => $valid['email'],
					'level' => '6',
					'tgl_daftar' => date('Ymd'),
					'id_session' => $valid['password']
				);
				$querymanager = $core->db->insertInto('users')->values($datamanager);
				$querymanager->execute();
				// Data demo Booking
				$databooking = array(
					'company' => $last_user['id_user']+1,
					'username' => 'demobooking',
					'nama_lengkap' => 'Demo Booking',
					'password' => $valid['password'],
					'email' => $valid['email'],
					'level' => '8',
					'tgl_daftar' => date('Ymd'),
					'id_session' => $valid['password']
				);
				$querybooking = $core->db->insertInto('users')->values($databooking);
				$querybooking->execute();
				// Data demo Sales
				$datasales = array(
					'company' => $last_user['id_user']+1,
					'username' => 'demosales',
					'nama_lengkap' => 'Demo Sales',
					'password' => $valid['password'],
					'email' => $valid['email'],
					'level' => '9',
					'tgl_daftar' => date('Ymd'),
					'id_session' => $valid['password']
				);
				$querysales = $core->db->insertInto('users')->values($datasales);
				$querysales->execute();
				// Notif berhasil
				$core->flash->success('<b>Registrasi berhasil.</b>
					<br>Selamat, Anda mendapatkan fitur demo selama <b>14 hari</b>.
					<hr>
					UserID : <b>'.$_POST['username'].'</b>
					<br>Password : <b>'.$_POST['password'].'</b>', BASE_URL .'/register', true);
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
	// Render Template Register
	echo $templates->render('login::register');
});

// Will logout
$router->get('/logout', function() use ($core, $templates) {
	// Hapus Session
	session_unset();
	session_destroy();
	header('location:'.BASE_URL);
});

// Will logout
$router->get('/logoutuser', function() use ($core, $templates) {
	// Hapus Session
	unset($_SESSION['iduser']);
	unset($_SESSION['namauser']);
	unset($_SESSION['namalengkap']);
	unset($_SESSION['leveluser']);
	unset($_SESSION['login']);
	unset($_SESSION['timeout']);
	$core->flash->success('Terima Kasih.', BASE_URL .'/login', true);
});


//login bk
$router->match('GET|POST', '/bk', function() use($core, $templates)
{
	// Cek status bk
	if (isset($_SESSION['nobk'])) {
		// redirect admin
		header('location:'.BASE_URL.'/member/bk');
	}

	// event submit
	if (!empty($_POST)) {
		$core->val->validation_rules(array(
			'nobk' => 'required|max_len,20|min_len,3',
		));
		$core->val->filter_rules(array(
			'nobk' => 'trim|sanitize_string',
		));
		$postBK = array(
			'nobk' => str_replace(' ', '', strtoupper(trim($_POST['nobk']))),
			'action' => $_POST['action']
		);
		// var_dump($postBK);return;
		$postBK = $core->val->sanitize($postBK);
		$valid = $core->val->run($postBK);

		if ($valid === false) {
			// Notif error
			$core->flash->warning($core->val->get_readable_errors(true));
		} 
		else {
			// Member
			if (empty($_SESSION['nobk'])) {
				$query_bk = $core->db->from('tracker')
					->where('nobk', $valid['nobk']);
				$count_bk = $query_bk->count();			
				if ($count_bk > 0) {
					$user = $query_bk->orderBy("id DESC")->limit(1)->fetch();
					$sesibk = new Racik\Timeout();
					$sesibk->rec_session_bk($user);
					// Notif berhasil, Redirect member
					$_SESSION['welcome'] = 'Selamat datang <b>'.$user['nobk'];
					$core->flash->success('Selamat datang <b>'.$user['nobk'].'</b>!', BASE_URL.'/member/bk', true);
				} 
				// Jika akun tidak ditemukan
				else {
					// Notif Gagal
					$core->flash->warning('No. Polisi Tidak ditemukan!', null, true);
				}
			} 
		}
	}
	// Data template
	$info = array(
		'page_title'	=> $core->setting->site('web_name'),
		'page_desc'		=> $core->setting->site('web_meta'),
		'page_key' 		=> $core->setting->site('web_keyword'),
		'page_owner' 	=> $core->setting->site('web_owner')
	);
	$templates->addData($info);
	// Render Template login
	echo $templates->render('login::option', compact('demo'));
});

// Will logout bk
$router->get('/logoutbk', function() use ($core, $templates) {
	// Hapus Session
	unset($_SESSION['nobk']);
	unset($_SESSION['flash_messages']);
	
	$core->flash->success('Terima Kasih.', BASE_URL .'/bk', true);
});