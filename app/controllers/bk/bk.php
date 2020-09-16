<?php

$router->mount('/member/bk', function() use ($router, $templates, $core) 
{
	/**
	 * Create Rate
	 */
	$router->match('GET|POST', '/', function() use($core, $templates) {
		// Cek status login
		if (!isset($_SESSION['nobk'])) {
			// Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}     
		// event submit
		if (!empty($_POST)) {
			// Validasi
			$core->val->validation_rules(array(
				'nobk' 			=> 'required',
				'pelayanan_sa' 	=> 'required',
				'hasil_service' => 'required',
				'waktu_service' => 'required',
				'penyerahan' 	=> 'required',
				'rekomendasi'	=> 'required'
			));
			$core->val->filter_rules(array(
				'nobk' 			=> 'trim',
				'pelayanan_sa' 	=> 'trim',
				'hasil_service' => 'trim',
				'waktu_service' => 'trim',
				'penyerahan' 	=> 'trim',
				'rekomendasi'	=> 'trim'
			));
			$_POST = $core->val->sanitize($_POST);
			$valid = $core->val->run($_POST);
			// Cek valid
			if ($valid === false) {
				// Notif error
				$core->flash->warning($core->val->get_readable_errors(true));
			} 
			else {
				// Insert
				$nilai = '';
				$rate = ($valid['pelayanan_sa'] + $valid['hasil_service'] + $valid['waktu_service'] + $valid['penyerahan'] + $valid['rekomendasi'])/18*100;
				if ($rate >= 80) {
					$nilai = 5;
				}elseif ($rate >= 70) {
					$nilai = 4;
				}elseif ($rate >= 60) {
					$nilai = 3;
				}elseif ($rate >= 50) {
					$nilai = 2;
				}else{
					$nilai = 1;
				}
				$data = array(
					'nobk' 			=> $valid['nobk'],
					'pelayanan_sa' 	=> $valid['pelayanan_sa'],
					'hasil_service' => $valid['hasil_service'],
					'waktu_service' => $valid['waktu_service'],
					'penyerahan' 	=> $valid['penyerahan'],
					'rekomendasi' 	=> $valid['rekomendasi'],
					'rate'			=> $rate,
					'nilai'			=> $nilai,
					'tanggal'		=> date('Y-m-d')
				);
				$query = $core->db->insertInto('polling')->values($data);
				$query->execute();

				//set status komentar ke Y
				$data_track = array(
					'k_status' => 'Y',
	            );
				$query_track = $core->db->update('tracker')
					->set($data_track)
					->where('id', $core->string->valid($_POST['id_tracker'], 'sql'));
				$query_track->execute();
				// Notif berhasil
				$core->flash->success('Terima kasih. Rating telah berhasil ditambahkan', BASE_URL .'/member/bk');
			} //cek data
		}

		$user = $core->db->from('tracker')
			->where('nobk', $_SESSION['nobk'])
			->orderBy("id DESC")
			->limit(1)->fetch();

		$galleries = $core->db->from('tracker_gallery')
			->where('nobk', $_SESSION['nobk'])
			->where('gallery_publish', $user['date_gallery'])
			->orderBy('id_tracker_gallery DESC')
			->fetchAll();
		// var_dump($user);

		//pilih nama SA
		$sa = $core->db->from('users')
			->where('id_user', $user['editor_sa'])
			->fetch();
		$sa = $sa['nama_lengkap'];

		//pilih nama PTM
		$opl = $core->db->from('users')
			->where('id_user', $user['o_editor'])
			->fetch();
		$opl = $opl['nama_lengkap'];

		//pilih nama Foreman
		$fo = $core->db->from('users')
			->where('id_user', $user['f_kelompok'])
			->fetch();
		$fo = $fo['nama_lengkap'];

		//pilih nama Washing
		$wa = $core->db->from('users')
			->where('id_user', $user['w_editor'])
			->fetch();
		$wa = $wa['nama_lengkap'];
		
		$semua = array(
			'sa' => $sa,
			'opl' => $opl,
			'fo' => $fo,
			'wa' => $wa
		);

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
		echo $templates->render('member::bk', compact('semua', 'user', 'galleries'));
	});

	$router->match('GET|POST', '/get-bk', function() use ($core, $templates) { 
		$trackers = $core->db->from('tracker m')
			->select(array(
				"d.jenis",
				"d.estimasi_pengerjaan",
				"t.nama_tipe"))
			->leftJoin('tipe_mobil t ON m.tipe_id = t.id_tipe')
			->where('m.nobk = :etm', array(':etm' =>$_SESSION['nobk']))
			->where('m.status = :de OR m.date = :da', array(':de' => 'N', ':da' => date("Y-m-d")))
			->where('m.nobk = :etm', array(':etm' =>$_SESSION['nobk']))
			->orderBy('m.id ASC, m.status DESC, m.w_status ASC, m.f_status ASC, m.opl ASC')
			->limit(1)
			->fetch();
		?>
		<div class="_ds-auto2000-nav-dot">
			<?php  if($trackers['w_editor']) { ?>
	            <span class="_ds-auto2000-nav-line-active"><i class="_ds-auto2000-nav-dot-active"></i></span>
	            <span class="_ds-auto2000-nav-line-active"><i class="_ds-auto2000-nav-dot-active"></i></span>
	            <span class="_ds-auto2000-nav-line-active"><i class="_ds-auto2000-nav-dot-active"></i></span>
	            <span class="_ds-auto2000-nav-line-active"><i class="_ds-auto2000-nav-dot-active"></i></span>
            <?php }else if($trackers['f_kelompok']) { ?>
            	<span class="_ds-auto2000-nav-line-active"><i class="_ds-auto2000-nav-dot-active"></i></span>
	            <span class="_ds-auto2000-nav-line-active"><i class="_ds-auto2000-nav-dot-active"></i></span>
	            <span class="_ds-auto2000-nav-line-active"><i class="_ds-auto2000-nav-dot-active"></i></span>
	            <span><i></i></span>
            <?php }else if($trackers['o_editor']) { ?>
            	<span class="_ds-auto2000-nav-line-active"><i class="_ds-auto2000-nav-dot-active"></i></span>
	            <span class="_ds-auto2000-nav-line-active"><i class="_ds-auto2000-nav-dot-active"></i></span>
	            <span><i></i></span>
	            <span><i></i></span>
            <?php }else if($trackers['editor_sa']) { ?>
            	<span class="_ds-auto2000-nav-line-active"><i class="_ds-auto2000-nav-dot-active"></i></span>
	            <span><i></i></span>
	            <span><i></i></span>
	            <span><i></i></span>
            <?php } ?>
        </div>
	<?php 
	});
});