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
	$router->get('/opl(/\w+)?', function($title = null) use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level OPL
		if ($_SESSION['leveluser'] == 11 OR $_SESSION['leveluser'] == 12 OR $_SESSION['leveluser'] == 13 OR $_SESSION['leveluser'] == 14 OR $_SESSION['leveluser'] == 15 OR $_SESSION['leveluser'] == 16) {
      
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
			echo $templates->render('member::opl_view', compact('title', 'user', 'user_member'));
		} else {
			// Notif
				$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
			
		}
	});
	
	/**
	 * Read Gallery
	 */
	$router->post('/o/datatable', function() use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level OPL
		// if ($_SESSION['leveluser'] != 11 || $_SESSION['leveluser'] != 12 || $_SESSION['leveluser'] != 13 || $_SESSION['leveluser'] != 14 || $_SESSION['leveluser'] != 15 || $_SESSION['leveluser'] != 16 || $_SESSION['leveluser'] != 18 || $_SESSION['leveluser'] != 19) {
  //           // Notif
		// 	$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		// }

		$table = 'tracker';
		$primarykey = 'id';
		$GLOBALS['core'] = $core;
		$columns = array(
			array('db' => 'p.'.$primarykey, 		'dt' => 'status', 
				'formatter' => function ($d, $row) {

					$track = $GLOBALS['core']->db->from('tracker t')
                        ->select(array('forman','f_kelompok'))
						->where('id', $d)
                        ->fetch();
                    $user = $GLOBALS['core']->db->from('users u')
                        ->select(array('nama_lengkap'))
						->where('id_user', $track['f_kelompok'])
                        ->fetch();

                    $tracker = $GLOBALS['core']->db->from('tracker')
	                    ->where('id', $d)
						->fetch();

					$level = '';
					$jam_selesai = '';
					if ($tracker['o_time_1'] == null && $tracker['o_editor_1'] == $_SESSION['leveluser']) {
						$level = 'jam_mulai_opl_1';
						$jam_selesai = 'o_time_1';
					} elseif ($tracker['o_time_2'] == null && $tracker['o_editor_2'] == $_SESSION['leveluser']) {
						$level = 'jam_mulai_opl_2';
						$jam_selesai = 'o_time_2';
					} elseif ($tracker['o_time_3'] == null && $tracker['o_editor_3'] == $_SESSION['leveluser']) {
						$level = 'jam_mulai_opl_3';
						$jam_selesai = 'o_time_3';
					} elseif ($tracker['o_time_4'] == null && $tracker['o_editor_4'] == $_SESSION['leveluser']) {
						$level = 'jam_mulai_opl_4';
						$jam_selesai = 'o_time_4';
					} elseif ($tracker['o_time_5'] == null && $tracker['o_editor_5'] == $_SESSION['leveluser']) {
						$level = 'jam_mulai_opl_5';
						$jam_selesai = 'o_time_5';
					}

                    if($track[$level] == null){
                        return "<a href='".BASE_URL."/member/o/save/".$d."' data-toggle='tooltip' class='btn btn-sm btn-primary' title='Kerjakan'>Kerjakan</a>";
                    }elseif($track[$jam_selesai] == null){
                        return "<a href='".BASE_URL."/member/o/toforman/".$d."' data-toggle='tooltip' class='btn btn-sm btn-primary' title='Kirim ke Forman'>Selesai Kerjakan</a>";
                    }elseif($track[$jam_selesai] != null) {
                        return "<i class='fa fa-check'></i> <div class='badge badge-info'>
							OK
						</div>";
                    }elseif($track['f_status']=='Y') {
                        return "<i class='fa fa-check'></i> <div class='badge badge-info' data-toggle='tooltip' title='" .$user['nama_lengkap']."'>
							".$user['username']."
						</div>";
                    }elseif($track['f_status']=='N'){       
						if($track['date_in'] < date('Y-m-d')) {
							return "<div class='badge badge-info'>".$user['username']."</div>\n
							<div class='badge badge-warning' data-toggle='tooltip' title='" .$user['nama_lengkap']."'>Pending</div>\n";
						} else {
							return "<div class='badge badge-info'>".$user['username']."</div>";
						}     
                    }
				}
			),
			array('db' => 'p.nobk', 				'dt' => 'nobk'),
			array('db' => 'u.nama_lengkap', 		'dt' => 'nama_lengkap'),
			array('db' => 'p.time', 				'dt' => 'time',
				'formatter' => function($d, $row){
                    return date('H:i', strtotime($d)).' WIB';
				}
			),
			array('db' => 'p.'.$primarykey, 		'dt' => 'jam_mulai',
				'formatter' => function($d, $row) {
					$tracker = $GLOBALS['core']->db->from('tracker')
	                    ->where('id', $d)
						->fetch();

					$jam_mulai = '';
					if ($tracker['o_time_1'] == null && $tracker['o_editor_1'] == $_SESSION['leveluser']) {
						$jam_mulai = $tracker['jam_mulai_opl_1'];
					} elseif ($tracker['o_time_2'] == null && $tracker['o_editor_2'] == $_SESSION['leveluser']) {
						$jam_mulai = $tracker['jam_mulai_opl_2'];
					} elseif ($tracker['o_time_3'] == null && $tracker['o_editor_3'] == $_SESSION['leveluser']) {
						$jam_mulai = $tracker['jam_mulai_opl_3'];
					} elseif ($tracker['o_time_4'] == null && $tracker['o_editor_4'] == $_SESSION['leveluser']) {
						$jam_mulai = $tracker['jam_mulai_opl_4'];
					} elseif ($tracker['o_time_5'] == null && $tracker['o_editor_5'] == $_SESSION['leveluser']) {
						$jam_mulai = $tracker['jam_mulai_opl_5'];
					}

					if ($jam_mulai == null) {
						$waktu = '-';
					} else {
						$waktu = date('H:i', strtotime($jam_mulai)).' WIB';
					}
                    return $waktu;
				}
			),
			array('db' => 'p.'.$primarykey, 	'dt' => 'jam_selesai',
				'formatter' => function($d, $row) {
					$tracker = $GLOBALS['core']->db->from('tracker')
	                    ->where('id', $d)
						->fetch();

					$jam_selesai = '';
					if ($tracker['o_time_1'] == null && $tracker['o_editor_1'] == $_SESSION['leveluser']) {
						$jam_selesai = $tracker['o_time_1'];
					} elseif ($tracker['o_time_2'] == null && $tracker['o_editor_2'] == $_SESSION['leveluser']) {
						$jam_selesai = $tracker['o_time_2'];
					} elseif ($tracker['o_time_3'] == null && $tracker['o_editor_3'] == $_SESSION['leveluser']) {
						$jam_selesai = $tracker['o_time_3'];
					} elseif ($tracker['o_time_4'] == null && $tracker['o_editor_4'] == $_SESSION['leveluser']) {
						$jam_selesai = $tracker['o_time_4'];
					} elseif ($tracker['o_time_5'] == null && $tracker['o_editor_5'] == $_SESSION['leveluser']) {
						$jam_selesai = $tracker['o_time_5'];
					}

					if ($jam_selesai == null) {
						$waktu = '-';
					} else {
						$waktu = date('H:i', strtotime($jam_selesai)).' WIB';
					}
                    return $waktu;
				}
			),
			array('db' => 'p.'.$primarykey, 		'dt' => 'pengerjaan',
				'formatter' => function($d, $row) {
					$tracker = $GLOBALS['core']->db->from('tracker')
	                    ->where('id', $d)
						->fetch();

					$jenis = '';
					if ($tracker['o_time_1'] == null && $tracker['o_editor_1'] == $_SESSION['leveluser']) {
						$jenis = $tracker['jenis_service_opl_1'];
					} elseif ($tracker['o_time_2'] == null && $tracker['o_editor_2'] == $_SESSION['leveluser']) {
						$jenis = $tracker['jenis_service_opl_2'];
					} elseif ($tracker['o_time_3'] == null && $tracker['o_editor_3'] == $_SESSION['leveluser']) {
						$jenis = $tracker['jenis_service_opl_3'];
					} elseif ($tracker['o_time_4'] == null && $tracker['o_editor_4'] == $_SESSION['leveluser']) {
						$jenis = $tracker['jenis_service_opl_4'];
					} elseif ($tracker['o_time_5'] == null && $tracker['o_editor_5'] == $_SESSION['leveluser']) {
						$jenis = $tracker['jenis_service_opl_5'];
					}

					$jenis = $GLOBALS['core']->db->from('service_lain')
	                    ->where('id', $jenis)
	                    ->limit(1)
						->fetch();

                    return $jenis['nama'];
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
        	case 'tunggu':
                $extrawhere = "p.opl_1 = 'Y'
                AND p.o_editor_1 = '".$_SESSION['leveluser']."'
                AND p.jam_mulai_opl_1 is null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.status = 'N'
                
                OR p.opl_2 = 'Y'
                AND p.o_editor_2 = '".$_SESSION['leveluser']."'
                AND p.jam_mulai_opl_2 is null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.status = 'N'

                OR p.opl_3 = 'Y'
                AND p.o_editor_3 = '".$_SESSION['leveluser']."'
                AND p.jam_mulai_opl_3 is null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.status = 'N'

                OR p.opl_4 = 'Y'
                AND p.o_editor_4 = '".$_SESSION['leveluser']."'
                AND p.jam_mulai_opl_4 is null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.status = 'N'

                OR p.opl_5 = 'Y'
                AND p.o_editor_5 = '".$_SESSION['leveluser']."'
                AND p.jam_mulai_opl_5 is null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.status = 'N'";
                break;

            case 'proses':
                $extrawhere = "p.opl_1 = 'Y'
                AND p.o_editor_1 = '".$_SESSION['leveluser']."'
                AND p.jam_mulai_opl_1 is not null
                AND p.o_time_1 is null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.status = 'N'
                
                OR p.opl_2 = 'Y'
                AND p.o_editor_2 = '".$_SESSION['leveluser']."'
                AND p.jam_mulai_opl_2 is not null
                AND p.o_time_2 is null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.status = 'N'

                OR p.opl_3 = 'Y'
                AND p.o_editor_3 = '".$_SESSION['leveluser']."'
                AND p.jam_mulai_opl_3 is not null
                AND p.o_time_3 is null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.status = 'N'

                OR p.opl_4 = 'Y'
                AND p.o_editor_4 = '".$_SESSION['leveluser']."'
                AND p.jam_mulai_opl_4 is not null
                AND p.o_time_4 is null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.status = 'N'

                OR p.opl_5 = 'Y'
                AND p.o_editor_5 = '".$_SESSION['leveluser']."'
                AND p.jam_mulai_opl_5 is not null
                AND p.o_time_5 is null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.status = 'N'";
                break;

            case 'selesai':
                $extrawhere = "p.opl_1 = 'Y'
                AND p.o_editor_1 = '".$_SESSION['leveluser']."'
                AND p.o_time_1 is not null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.date = '".date("Y-m-d")."'
                OR p.status = 'N'
                AND p.opl_1 = 'Y'
                AND p.o_editor_1 = '".$_SESSION['leveluser']."'
                AND p.o_time_1 is not null
                AND p.member = '".$_SESSION['iduser_member']."'

                OR p.opl_2 = 'Y'
                AND p.o_editor_2 = '".$_SESSION['leveluser']."'
                AND p.o_time_2 is not null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.date = '".date("Y-m-d")."'
                OR p.status = 'N'
                AND p.opl_2 = 'Y'
                AND p.o_editor_2 = '".$_SESSION['leveluser']."'
                AND p.o_time_2 is not null
                AND p.member = '".$_SESSION['iduser_member']."'

                OR p.opl_3 = 'Y'
                AND p.o_editor_3 = '".$_SESSION['leveluser']."'
                AND p.o_time_3 is not null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.date = '".date("Y-m-d")."'
                OR p.status = 'N'
                AND p.opl_3 = 'Y'
                AND p.o_editor_3 = '".$_SESSION['leveluser']."'
                AND p.o_time_3 is not null
                AND p.member = '".$_SESSION['iduser_member']."'

                OR p.opl_4 = 'Y'
                AND p.o_editor_4 = '".$_SESSION['leveluser']."'
                AND p.o_time_4 is not null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.date = '".date("Y-m-d")."'
                OR p.status = 'N'
                AND p.opl_4 = 'Y'
                AND p.o_editor_4 = '".$_SESSION['leveluser']."'
                AND p.o_time_4 is not null
                AND p.member = '".$_SESSION['iduser_member']."'

                OR p.opl_5 = 'Y'
                AND p.o_editor_5 = '".$_SESSION['leveluser']."'
                AND p.o_time_5 is not null
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.date = '".date("Y-m-d")."'
                OR p.status = 'N'
                AND p.opl_5 = 'Y'
                AND p.o_editor_5 = '".$_SESSION['leveluser']."'
                AND p.o_time_5 is not null
                AND p.member = '".$_SESSION['iduser_member']."'";
                break;
            
            default:
                $extrawhere = "p.o_editor = '".$_SESSION['iduser']."' 
                AND p.opl = 'Y' 
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.date = '".date("Y-m-d")."' OR p.status = 'N'
                AND p.member = '".$_SESSION['iduser_member']."'
                AND p.opl = 'Y' 
                AND p.o_editor = '".$_SESSION['iduser']."'"; 
                break;
        }
		
		echo json_encode(Racik\Ssp::complex($_POST, $core->connect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	});
	
	/**
	 * Kirim Gallery
	 */
	$router->match('GET|POST', '/o/toforman/(\d+)', function($idtracker) use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level OPL
		if ($_SESSION['leveluser'] == 11 OR $_SESSION['leveluser'] == 12 OR $_SESSION['leveluser'] == 13 OR $_SESSION['leveluser'] == 14 OR $_SESSION['leveluser'] == 15 OR $_SESSION['leveluser'] == 16 OR $_SESSION['leveluser'] == 18 OR $_SESSION['leveluser'] == 19)
		{
			$tracker = $core->db->from('tracker')
				->where('id', $core->string->valid($idtracker, 'sql'))
				->limit(1)->fetch();

			$level = '';
			$opl = '';
			if ($tracker['o_time_1'] == null && $tracker['o_editor_1'] == $_SESSION['leveluser']) {
				$opl = 'opl_1';
				$level = 'o_time_1';
				$petugas_opl = 'petugas_opl_1';
			} elseif ($tracker['o_time_2'] == null && $tracker['o_editor_2'] == $_SESSION['leveluser']) {
				$opl = 'opl_2';
				$level = 'o_time_2';
				$petugas_opl = 'petugas_opl_2';
			} elseif ($tracker['o_time_3'] == null && $tracker['o_editor_3'] == $_SESSION['leveluser']) {
				$opl = 'opl_3';
				$level = 'o_time_3';
				$petugas_opl = 'petugas_opl_3';
			} elseif ($tracker['o_time_4'] == null && $tracker['o_editor_4'] == $_SESSION['leveluser']) {
				$opl = 'opl_4';
				$level = 'o_time_4';
				$petugas_opl = 'petugas_opl_4';
			} elseif ($tracker['o_time_5'] == null && $tracker['o_editor_5'] == $_SESSION['leveluser']) {
				$opl = 'opl_5';
				$level = 'o_time_5';
				$petugas_opl = 'petugas_opl_5';
			}

			// if ($opl == ) {
			// 	# code...
			// }

			if ($tracker['opl_1'] == 'Y' && $tracker['jam_mulai_opl_1'] == null ||
				$tracker['opl_2'] == 'Y' && $tracker['jam_mulai_opl_2'] == null ||
				$tracker['opl_3'] == 'Y' && $tracker['jam_mulai_opl_3'] == null ||
				$tracker['opl_4'] == 'Y' && $tracker['jam_mulai_opl_4'] == null ||
				$tracker['opl_5'] == 'Y' && $tracker['jam_mulai_opl_5'] == null) {
				
				// Data yang akan diinput
				$data = array(
	                $level 		=> date('H:i'),
	                $petugas_opl => $_SESSION['iduser']
	            );
				$query = $core->db->update('tracker')
					->set($data)
					->where('id', $core->string->valid($idtracker, 'sql'));
				$query->execute();

	            // Data berhasil diinput
				return $core->flash->success('Mobil Berhasil diselesaikan', BASE_URL.'/member', true);
			}

			if (!empty($_POST)) {

				// Data yang akan diinput
				$data = array(
					'forman' 	=> 'Y',
	                $level 		=> date('H:i'),
	                $petugas_opl => $_SESSION['iduser'],
	                'f_kelompok'=> $core->string->valid($_POST['kelompok'], 'xss'),
	            );
				$query = $core->db->update('tracker')
					->set($data)
					->where('id', $core->string->valid($idtracker, 'sql'));
				$query->execute();

	            // Data berhasil diinput
				$core->flash->success('Mobil Berhasil di kirim keforman', BASE_URL.'/member', true);
			} else {
				// Cek Member	
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
				echo $templates->render('member::opl_toforman', compact('idtracker', 'user_member'));
			}
		} else {
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
	});

	$router->match('GET|POST', '/o/save/(\d+)', function($idtracker) use($core, $templates) 
	{
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		// Cek level OPL
		if ($_SESSION['leveluser'] == 11 OR $_SESSION['leveluser'] == 12 OR $_SESSION['leveluser'] == 13 OR $_SESSION['leveluser'] == 14 OR $_SESSION['leveluser'] == 15 OR $_SESSION['leveluser'] == 16 OR $_SESSION['leveluser'] == 18 OR $_SESSION['leveluser'] == 19)
		{
			$tracker = $core->db->from('tracker')
				->where('id', $core->string->valid($idtracker, 'sql'))
				->limit(1)->fetch();

			$level = '';
			if ($tracker['o_time_1'] == null && $tracker['o_editor_1'] == $_SESSION['leveluser']) {
				$level = 'jam_mulai_opl_1';
			} elseif ($tracker['o_time_2'] == null && $tracker['o_editor_2'] == $_SESSION['leveluser']) {
				$level = 'jam_mulai_opl_2';
			} elseif ($tracker['o_time_3'] == null && $tracker['o_editor_3'] == $_SESSION['leveluser']) {
				$level = 'jam_mulai_opl_3';
			} elseif ($tracker['o_time_4'] == null && $tracker['o_editor_4'] == $_SESSION['leveluser']) {
				$level = 'jam_mulai_opl_4';
			} elseif ($tracker['o_time_5'] == null && $tracker['o_editor_5'] == $_SESSION['leveluser']) {
				$level = 'jam_mulai_opl_5';
			}

			// Data yang akan diinput
			$data = array(
				// 'forman' 	=> 'Y',
                $level 		=> date('H:i'),
            );
			$query = $core->db->update('tracker')
				->set($data)
				->where('id', $idtracker);
			$query->execute();

            // Data berhasil diinput
			$core->flash->success('Mobil Berhasil dikerjakan', BASE_URL.'/member', true);
		}else{
			// Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}
	});
	
});