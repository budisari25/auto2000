<?php

$router->mount('/opl', function() use ($router, $templates, $core) 
{	
	// Menampilkan request halaman beranda
	$router->get('/', function() use ($core, $templates) 
	{
		// Cek Member		
		if(isset($_SESSION['iduser_member'])) {
			$user_member = $core->db->from('users')
				->where('id_user', $_SESSION['iduser_member'])
				->limit(1)->fetch();
		} else {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
	
		// Render Template login
		echo $templates->render('opl::home', compact('user_member'));
	});

	// Menampilkan request halaman beranda
	$router->match('GET|POST', '/pagination', function() use ($core, $templates) { 
		// Cek Member		
		if(isset($_SESSION['iduser_member'])) {
			$user_member = $core->db->from('users')
				->where('id_user', $_SESSION['iduser_member'])
				->limit(1)->fetch();
		} else {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}

		$record_per_page = 10;  
		$page = '';  
		if(isset($_POST["page"]))  
		{  
			$page = $_POST["page"];  
		}  
		else  
		{  
			$page = 1;  
		}  
		$start_from = ($page - 1)*$record_per_page; 
		$trackers = $core->db->from('tracker m')
			->select(array(
				"t.nama_tipe"))
			->leftJoin('tipe_mobil t ON m.tipe_id = t.id_tipe')
			->where('m.member = :etm', array(':etm' =>$user_member['id_user']))
			->where('m.status = :de OR m.date = :da', array(':de' => 'N', ':da' => date("Y-m-d")))
			->where('m.member = :etma', array(':etma' =>$user_member['id_user']))
			->orderBy('m.status DESC, m.w_status ASC, m.f_status ASC')
			->limit($record_per_page)
			->offset($start_from)
			->fetchAll();
		foreach($trackers as $tracker){
			$user = $core->db->from('users')
				->select(array("username"))
				->where('id_user', $tracker['editor_sa'])
				->fetch();
			$opl1 = $core->db->from('service_lain')
				->where('id', $tracker['jenis_service_opl_1'])
				->fetch();
			$opl2 = $core->db->from('service_lain')
				->where('id', $tracker['jenis_service_opl_2'])
				->fetch();
			$opl3 = $core->db->from('service_lain')
				->where('id', $tracker['jenis_service_opl_3'])
				->fetch();
			$opl4 = $core->db->from('service_lain')
				->where('id', $tracker['jenis_service_opl_4'])
				->fetch();
			$opl5 = $core->db->from('service_lain')
				->where('id', $tracker['jenis_service_opl_5'])
				->fetch();
			$washing = $core->db->from('users')
				->select(array("username"))
				->where('id_user', $tracker['w_editor'])
				->fetch();
		?>
		<tr <?php if($tracker['date'] < date("Y-m-d")){ echo "class='yellow'";}?>>
			<td>
				<strong><?=$user['username'];?></strong></br>
			</td>
			<td><strong><?=$tracker['nobk'];?></strong></td>
			<td><?=$tracker['nama_tipe'];?></td>
			<td>
				<?php
					if($opl1) {
						echo $opl1['nama'];
					} else {
						echo "-";
					}
				?>
			</td>
			<td>
				<?php
					if ($tracker['opl_1'] == "Y" && $tracker['jam_mulai_opl_1'] == null) {
						echo "<span class='badge badge-warning'>Menunggu</span>";
					} elseif($tracker['opl_1'] == "Y" && $tracker['jam_mulai_opl_1'] != null && $tracker['o_time_1'] == null) {
						echo "<span class='badge badge-primary'>Proses</span>";
					} elseif ($tracker['opl_1'] == "Y" && $tracker['o_time_1'] != null) {
						echo "<span class='badge badge-success'>Selesai</span>";
					} else {
						echo "-";
					}
				?>
			</td>
			<td>
				<?php
					if($opl2) {
						echo $opl2['nama'];
					} else {
						echo "-";
					}
				?>
			</td>
			<td>
				<?php
					if ($tracker['opl_2'] == "Y" && $tracker['jam_mulai_opl_2'] == null) {
						echo "<span class='badge badge-warning'>Menunggu</span>";
					} elseif($tracker['opl_2'] == "Y" && $tracker['jam_mulai_opl_2'] != null && $tracker['o_time_2'] == null) {
						echo "<span class='badge badge-primary'>Proses</span>";
					} elseif ($tracker['opl_2'] == "Y" && $tracker['o_time_2'] != null) {
						echo "<span class='badge badge-success'>Selesai</span>";
					} else {
						echo "-";
					}
				?>
			</td>
			<td>
				<?php
					if($opl3) {
						echo $opl3['nama'];
					} else {
						echo "-";
					}
				?>
			</td>
			<td>
				<?php
					if ($tracker['opl_3'] == "Y" && $tracker['jam_mulai_opl_3'] == null) {
						echo "<span class='badge badge-warning'>Menunggu</span>";
					} elseif($tracker['opl_3'] == "Y" && $tracker['jam_mulai_opl_3'] != null && $tracker['o_time_3'] == null) {
						echo "<span class='badge badge-primary'>Proses</span>";
					} elseif ($tracker['opl_3'] == "Y" && $tracker['o_time_3'] != null) {
						echo "<span class='badge badge-success'>Selesai</span>";
					} else {
						echo "-";
					}
				?>
			</td>
			<td>
				<?php
					if($opl4) {
						echo $opl4['nama'];
					} else {
						echo "-";
					}
				?>
			</td>
			<td>
				<?php
					if ($tracker['opl_4'] == "Y" && $tracker['jam_mulai_opl_4'] == null) {
						echo "<span class='badge badge-warning'>Menunggu</span>";
					} elseif($tracker['opl_4'] == "Y" && $tracker['jam_mulai_opl_4'] != null && $tracker['o_time_4'] == null) {
						echo "<span class='badge badge-primary'>Proses</span>";
					} elseif ($tracker['opl_4'] == "Y" && $tracker['o_time_4'] != null) {
						echo "<span class='badge badge-success'>Selesai</span>";
					} else {
						echo "-";
					}
				?>
			</td>
			<td>
				<?php
					if($opl5) {
						echo $opl5['nama'];
					} else {
						echo "-";
					}
				?>
			</td>
			<td>
				<?php
					if ($tracker['opl_5'] == "Y" && $tracker['jam_mulai_opl_5'] == null) {
						echo "<span class='badge badge-warning'>Menunggu</span>";
					} elseif($tracker['opl_5'] == "Y" && $tracker['jam_mulai_opl_5'] != null && $tracker['o_time_5'] == null) {
						echo "<span class='badge badge-primary'>Proses</span>";
					} elseif ($tracker['opl_5'] == "Y" && $tracker['o_time_5'] != null) {
						echo "<span class='badge badge-success'>Selesai</span>";
					} else {
						echo "-";
					}
				?>
			</td>
			<td>
				<?php
					if ($tracker['f_time'] == null) {
						echo "<span class='badge badge-warning'>Belum datang</span>";
					} elseif ($tracker['f_time'] != null && $tracker['w_time'] == null) {
						echo "<span class='badge badge-info'>Tunggu</span>";
					} elseif ($tracker['w_time'] != null && $tracker['jam_selesai_cuci'] == null) {
						echo "<span class='badge badge-primary'>Proses</span>";
					} elseif ($tracker['jam_selesai_cuci'] != null) {
						echo "<span class='badge badge-success'>Selesai</span>";
					}
				?>
			</td>

			<td>
				<?php
					if ($tracker['status'] == 'Y') {
						echo "<span class='badge badge-success'>Stall Penyerahan</span>";
					} elseif ($tracker['jam_selesai_cuci'] != null) {
						echo "<span class='badge badge-primary'>Stall Selesai Cuci</span>";
					} else {
						echo "-";
					}
				?>
			</td>

		</tr>
	<?php }
	});

	// Menampilkan request halaman beranda
	$router->match('GET|POST', '/footer', function() use ($core, $templates) { 
		// Cek Member		
		if(isset($_SESSION['iduser_member'])) {
			$user_member = $core->db->from('users')
				->where('id_user', $_SESSION['iduser_member'])
				->limit(1)->fetch();
		} else {
            // Notif
			$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
		}
		?>
		<ul class="list-unstyled d-flex m-0">
			<li>          
				<div class="badge badge-primary">
					<?=$core->db->from('tracker')
					->where('date', date("Y-m-d"))
					->where('member', array($user_member['id_user']))
					->count();?>
				</div>
				<small>Today</small> 
			</li>
			<li>          
				<div class="badge badge-warning">
					<?=$core->db->from('tracker')
					->where('status', 'N')
					->where('date_in < ?', date('Y-m-d'))
					->where('member', array($user_member['id_user']))
					->count();?>
				</div>
				<small>Pending</small> 
			</li>
			<li>          
				<div class="badge badge-success">
					<?=$core->db->from('tracker')
					->where('status', 'Y')
					->where('date', date("Y-m-d"))
					->where('member', array($user_member['id_user']))
					->count();?>
				</div>
				<small>Finish</small> 
			</li>
		</ul>

		<ul class="list-unstyled d-flex m-0">
			<li>          
				<div class="badge badge-primary">
					<?=$core->db->from('tracker')           
					->where('member = :etm', array(':etm' =>$user_member['id_user']))
					->where('date = :da', array(':da' => date("Y-m-d"))) 
					->where('member = :etma', array(':etma' =>$user_member['id_user']))
					->count();?>
				</div> 
				<small>SA</small> 
			</li>
			<li>          
				<div class="badge badge-primary">
					<?=$core->db->from('tracker')
					->where('opl_1 = :ws', array(':ws' => 'Y'))
					->where('member = :etm', array(':etm' =>$user_member['id_user']))
					->where('date = :da', array(':da' => date("Y-m-d")))
					->where('member = :etma', array(':etma' =>$user_member['id_user']))
					->where('opl_1 = :w', array(':w' => 'Y'))
					->count();?>
				</div> 
				<small>OPL</small> 
			</li>
			<li>
				<div class="badge badge-primary">
					<?=$core->db->from('tracker')
					->where('forman = :ws', array(':ws' => 'Y'))
					->where('member = :etm', array(':etm' =>$user_member['id_user']))
					->where('date = :da', array(':da' => date("Y-m-d")))
					->where('member = :etma', array(':etma' =>$user_member['id_user']))
					->where('forman = :w', array(':w' => 'Y'))
					->count();?>
				</div>
				<small>FO</small> 
			</li>
			<li>    
				<div class="badge badge-primary" data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top">
					<?=$core->db->from('tracker')
					->where('washing = :ws', array(':ws' => 'Y'))
					->where('member = :etm', array(':etm' =>$user_member['id_user']))
					->where('date = :da', array(':da' => date("Y-m-d")))
					->where('member = :etma', array(':etma' =>$user_member['id_user']))
					->where('washing = :w', array(':w' => 'Y'))
					->count();?>
				</div>
				<small>Wash</small> 
			</li>
		</ul>
	<?php
	});
});