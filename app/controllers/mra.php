<?php
/**
 * CRUD member MRA
 * @author Asamint
 */
$router->mount('/member', function() use ($router, $templates, $core) 
{	
	/**
	 * Call MRA
	 */
    $router->get('/mra(/\w+)?', function($title = null) use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
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
		// Cek level MRA
		if ($_SESSION['leveluser'] == 8 OR $_SESSION['leveluser'] == 5 OR $_SESSION['leveluser'] == 9) {
			echo $templates->render('member::mra_view', compact('title', 'user', 'user_member'));
		} else {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}    
	});	
	
	/**
	 * Read MRA
	 */
    $router->post('/m/datatable', function() use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		$table = 'booking';
		$primarykey = 'id';
		$GLOBALS['core'] = $core;
		$columns = array(
			array('db' => 'p.'.$primarykey, 		'dt' => $primarykey),
			array('db' => 'p.'.$primarykey, 		'dt' => 'proses', 
				'formatter' => function ($d, $row) {
                    if($row['status']=='N') {
                        if($_SESSION['leveluser']=='8' OR $_SESSION['leveluser']=='9'){
                            if($row['time'] > date("H:i") OR $row['booking'] > date("Y-m-d")) {
                                return "<div class='badge badge-info'>Waiting</div>\n
								<a href='".BASE_URL."/member/m/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>";
                            } else {
                                return "<div class='badge badge-info'>Follow Up</div>\n
								<a href='".BASE_URL."/member/m/edit/".$d."' data-toggle='tooltip' class='badge badge-warning' title='Change'>Edit</a>";
                            }
                        } else {
                            return "<a href='".BASE_URL."/member/m/edit/".$d."' data-toggle='tooltip' class='btn btn-sm btn-primary' title='Show'>Show</a>";
                        }
                    } else {
                        return "<div class='badge badge-success'>Show</div>\n";
                    }
				}
			),
			array('db' => 'p.nobk', 				'dt' => 'nobk'),
			array('db' => 'a.jenis', 				'dt' => 'jenis'),
			array('db' => 't.nama_tipe', 			'dt' => 'nama_tipe'),
			array('db' => 'p.booking', 				'dt' => 'booking',
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
			array('db' => 'p.sumber', 				'dt' => 'sumber'),
			array('db' => 'p.ket', 					'dt' => 'ket'),
			array('db' => 'p.status',				'dt' => 'status')
		);
        $joinquery = "FROM booking AS p JOIN kerusakan AS a ON (a.id_kerusakan = p.id_kerusakan) JOIN tipe_mobil AS t ON (t.id_tipe = p.id_tipe)";
		
        switch ($_POST['view']) {
            case 'totalday':
                $extrawhere = "p.member = '".$_SESSION['iduser_member']."'
                AND p.booking = '".date("Y-m-d")."'"; 
                break;

            case 'show':
				$extrawhere = "p.member = '".$_SESSION['iduser_member']."'
				AND p.booking = '".date("Y-m-d")."' 
				AND p.status = 'Y'"; 
                break;

            case 'showsa':
				$extrawhere = "p.id_user = '".$_SESSION['iduser']."'
				AND p.member = '".$_SESSION['iduser_member']."'
				AND p.booking = '".date("Y-m-d")."' 
				AND p.status = 'Y'"; 
                break;

            case 'noshow':
                $extrawhere = "p.member = '".$_SESSION['iduser_member']."'
				AND p.booking = '".date("Y-m-d")."' 
				AND p.status = 'N'"; 
                break;

            case 'besok':
                $extrawhere = "p.member = '".$_SESSION['iduser_member']."'
                AND p.booking > '".date("Y-m-d")."'";
                break;
                
            default:
				$extrawhere = "p.member = '".$_SESSION['iduser_member']."'
				AND p.booking >= '".date("Y-m-d")."'"; 
                break;
        }
		
		echo json_encode(Racik\Ssp::complex($_POST, $core->connect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	});
	
	/**
	 * Create MRA
	 */
    $router->post('/m/import', function() use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level MRA
		if ($_SESSION['leveluser'] != 8) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}    

		// Event addnew

		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		if(isset($_FILES['excel']['name']) && in_array($_FILES['excel']['type'], $file_mimes)) {
		 
		    $arr_file = explode('.', $_FILES['excel']['name']);
		    $extension = end($arr_file);
		 
		    if('csv' == $extension) {
		        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		    } else {
		        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		    }
		 
		    $spreadsheet = $reader->load($_FILES['excel']['tmp_name']);
		     
		    $sheetData = $spreadsheet->getActiveSheet()->toArray('404-not-found-000',true,true,true);

		    $numRows = count($sheetData);

	        //baca untuk setiap baris excel
	        for ($i=2; $i <= $numRows; $i++) {

				$id_tipe = $core->db->from('tipe_mobil')
					->where('nama_tipe', $sheetData[$i]['D'])
					->limit(1)->fetch();

				$kerusakan = $core->db->from('kerusakan')
					->where('jenis', $sheetData[$i]['E'])
					->limit(1)->fetch();

				$id_tracker = $core->db->from('booking')
					->orderBy("id DESC")
					->limit(1)
					->fetch();
					
	            // Data yang akan diinput
				$data[] = array(
					'id'			=> $id_tracker['id']+$i,
					'nobk' 			=> strtoupper($sheetData[$i]['A']),
					'sumber' 		=> strtolower($sheetData[$i]['B']),
					'ket'			=> $sheetData[$i]['C'],
					'id_tipe' 		=> $id_tipe['id_tipe'],
					'id_kerusakan' 	=> $kerusakan['id_kerusakan'],
					'time' 			=> $sheetData[$i]['F'],
					'booking' 		=> $sheetData[$i]['G'],
					'member' 		=> $_SESSION['iduser_member']
				);
			}

			$query = $core->db->insertInto('booking')->values($data);
			$query->execute();

			$delete_null_rows = $core->db->deleteFrom('booking')
				->where('id = :id
					OR nobk = :nobk 
					OR sumber = :sumber 
					OR ket = :ket 
					OR id_tipe = :id_tipe 
					OR id_kerusakan = :id_kerusakan 
					OR time = :time 
					OR booking = :booking
					OR member = :member', array(
						':id' => '404-not-found-000', 
						':nobk' => '404-not-found-000', 
						':sumber' => '404-not-found-000', 
						':ket' => '404-not-found-000', 
						':id_tipe' => '404-not-found-000', 
						':id_kerusakan' => '404-not-found-000', 
						':time' => '404-not-found-000', 
						':booking' => '404-not-found-000',
						':member' => '404-not-found-000'));

			$delete_null_rows->execute();
			$core->flash->success('Berhasil input data Booking', BASE_URL.'/member/mra/index');
		}
	});
	
	/**
	 * Create Ajax
	 */
    $router->post('/m/sumber', function() use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level MRA
		if ($_SESSION['leveluser'] != 8 AND $_SESSION['leveluser'] != 9) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}    
		// Even Ajax
		if(isset($_POST['query'])) {
			$output = '';
			$query = $core->db->from('users')
				->where('nama_lengkap LIKE ?', '%'.$_POST['query'].'%')
				->where('block', 'N')
				->where('company', $_SESSION['iduser_member'])
				->where('level', array('5','8','9'))
				->order('nama_lengkap ASC');
			$qCount = $query->count();
			$qFetch = $query->fetchAll();
			$output = '<ul class="list-group">';
			if( $qCount > 0 ) {
				foreach ($qFetch as $row) {
					$output .= '<span class="list-group-item list-group-item-action waves-effect">'.$row['nama_lengkap'].'</span>';
				}
			} 
			$output .= '</ul>';
			echo $output;
		}
	});
	
	/**
	 * Create MRA
	 */
    $router->match('GET|POST', '/m/addnew', function() use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Cek level MRA
		if ($_SESSION['leveluser'] != 8 AND $_SESSION['leveluser'] != 9) {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}    
		// Event addnew
		if (!empty($_POST)) {
			$sumber_space = str_replace(' ', '', strtolower(trim($_POST['sumber'])));
			$sumber = str_replace('.', '', $sumber_space);
			$nobk = str_replace(' ', '', strtoupper(trim($_POST['nobk'])));

			// Cek no.polisi
			$sql = $core->db->from('booking')
				->where('nobk', $nobk)
				->where('member', $_SESSION['iduser_member'])
				->where('booking', date('Y-m-d'))
				->where('status', 'N');
			$rowNopol = $sql->fetch();
			$nopol = $sql->count();
			if ($nopol > 0) 
			{
				$core->flash->info('Maaf, No.Pol <u><b>'.$rowNopol['nobk'].'</b></u> sudah ada dalam daftar booking. <br>Harap periksa kembali daftar <u><b>booking</b></u> anda', BASE_URL.'/member/mra/index', true);
			} 
			else 
			{
				// Cek $_POST['sumber'] dengan table users			
				$querySumber = $core->db->from('users')
					->where('nama_lengkap', $_POST['sumber'])
					->where('block', 'N')
					->where('company', $_SESSION['iduser_member'])
					->where('level', array('5','8','9'))				
					->count();
				if ($querySumber > 0) 
				{
					// Data yang akan diinput
					$id_tracker = $core->db->from('booking')
						->orderBy("id DESC")
						->limit(1)
						->fetch();
					$data = array(
						'id' => $id_tracker['id']+1,
						'nobk' => $nobk,
						'sumber' => $sumber,
						'ket' => $_POST['ket'],
						'id_kerusakan' => $_POST['jenis_kerusakan'],
						'id_tipe' => $_POST['tipe_mobil'],
						'booking' => $_POST['booking'],
						'time' => $_POST['time'],
						'member' => $_SESSION['iduser_member']
					);
					$query = $core->db->insertInto('booking')->values($data);
					$query->execute();
	
					// Data berhasil diinput
					$core->flash->success('Berhasil input data pelanggan', BASE_URL.'/member/mra/index');
				}
				else 
				{
					$core->flash->warning('Maaf, Sumber Tidak Jelas!', BASE_URL.'/member/m/addnew');
				}
				
			}
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
		echo $templates->render('member::mra_add');
	});
	
	/**
	 * Create MRA
	 */
    $router->match('GET|POST', '/m/edit/(\d+)', function($id) use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['iduser'])) {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// Event addnew
		if (!empty($_POST)) {
            $id_tracker = $core->db->from('tracker')
                ->select("id")
                ->orderBy("id DESC")
                ->limit(1)
				->fetch();
				
			// Data yang akan diinput
			if($_SESSION['leveluser']=='8' OR $_SESSION['leveluser']=='9') {
				$tracker = array(
					'booking' => $_POST['booking'],
					'time' => $_POST['time'],
					'nobk' => strtoupper($_POST['nobk']),
					'id_kerusakan' => $_POST['jenis_kerusakan'],
					'id_tipe' => $_POST['tipe_mobil']
				);
				$query = $core->db->update('booking')
					->set($tracker)
					->where('id', $core->string->valid($_POST['id'], 'sql'));
				
				$query->execute();
				$core->flash->success('Berhasil Update data pelanggan', BASE_URL.'/member/mra/noshow');
				// if($query->execute()) {
				// 	// delete reminder if booking show
				// 	$query_gal = $core->db->deleteFrom('reminder')
				// 					->where('no_pol', $_POST['nobk'])
				// 					->execute();

				// 	// Data berhasil diinput
				// 	$core->flash->success('Berhasil Update data pelanggan', BASE_URL.'/member/mra/noshow');
				// } else {
				// 	// Data berhasil diinput
				// 	$core->flash->success('Terjadi kesalahan', BASE_URL.'/member/mra/noshow');
				// }
			} else {
				// Update booking
				$post = array(
					'status' => 'Y',
					'time_in' => date('H:i'),
					'id_user' => $_SESSION['iduser']
				);
				$query_post = $core->db->update('booking')
					->set($post)
					->where('id', $core->string->valid($_POST['id'], 'sql'));
				$query_post->execute();
				// if($query_post->execute()) {
				// 	// delete reminder if booking show
				// 	$query_gal = $core->db->deleteFrom('reminder')->where('no_pol', $_POST['nobk']);
				// 	$query_gal->execute();
				// }

				$tracker = array(
					'id' => $id_tracker['id']+1,
					'nobk' => strtoupper($_POST['nobk']),
					'kerusakan_id' => $_POST['jenis_kerusakan'],
					'tipe_id' => $_POST['tipe_mobil'],
					'date' => $_POST['publishdate'],
					'date_gallery' 		=> date('Y-m-d'),
					'date_in' => $_POST['publishdate'],
					'date_out' => $_POST['dateout'],
					'time' => $_POST['publishtime'],
					'estimasiselesai' => $_POST['estimasiselesai'],
					'editor_sa' => $_SESSION['iduser'],
					'member' => $_SESSION['iduser_member'],
					'keterangan' => $_POST['keterangan']
				);
				$query_post = $core->db->insertInto('tracker')->values($tracker);
				$query_post->execute();

				// Data berhasil diinput
				$core->flash->success('Berhasil input data pelanggan', BASE_URL.'/member/tracker/index');
			}
		}
		// Select users
		$booking = $core->db->from('booking')
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
		// Cek level MRA
		if ($_SESSION['leveluser'] == 8 OR $_SESSION['leveluser'] == 5 OR $_SESSION['leveluser'] == 9) {
			echo $templates->render('member::mra_edit', compact('booking'));
		} else {
            // Notif
			$core->flash->warning('Maaf akun tidak tersedia', BASE_URL.'/member', true);
		}    
	});
});