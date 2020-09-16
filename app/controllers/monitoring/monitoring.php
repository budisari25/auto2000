<?php

$router->mount('/monitoring', function() use ($router, $templates, $core) 
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
		echo $templates->render('monitoring::home', compact('user_member'));
	});

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
			$opl1 = $core->db->from('users')
				->select(array("username"))
				->where('id_user', $tracker['o_editor_1'])
				->fetch();
			$opl2 = $core->db->from('users')
				->select(array("username"))
				->where('id_user', $tracker['o_editor_2'])
				->fetch();
			$opl3 = $core->db->from('users')
				->select(array("username"))
				->where('id_user', $tracker['o_editor_3'])
				->fetch();
			$opl4 = $core->db->from('users')
				->select(array("username"))
				->where('id_user', $tracker['o_editor_4'])
				->fetch();
			$opl5 = $core->db->from('users')
				->select(array("username"))
				->where('id_user', $tracker['o_editor_5'])
				->fetch();
			$forman = $core->db->from('users')
				->select(array("username"))
				->where('id_user', $tracker['f_kelompok'])
				->fetch();
			$washing = $core->db->from('users')
				->select(array("username"))
				->where('id_user', $tracker['w_editor'])
				->fetch();
		?>
		<tr <?php if($tracker['date'] < date("Y-m-d")){ echo "class='yellow'";}?>>
			<td><strong><?=$tracker['nobk'];?></strong></td>
			<td><?=$tracker['nama_tipe'];?></td>
			<td>
				<small><i class="icon-calendar"></i> <?=$core->datetime->tgl_indo($tracker['date']);?></small><br>
				<small><i class="icon-clock"></i> <?=date("H:i", strtotime($tracker['estimasi_waktu_cuci']));?></small> 
			</td>
			<td>
				<small><i class="icon-calendar"></i> <?=$core->datetime->tgl_indo($tracker['date']);?></small><br>
				<small><i class="icon-clock"></i> <?=date("H:i", strtotime($tracker['estimasiselesai']));?></small> 
			</td>
			<td>
				<strong><?=$user['username'];?></strong></br>
				<small><i class="icon-clock"></i> <?=date("H:i", strtotime($tracker['time']));?></small>
			</td>
			<td>
				<?php
					if ($tracker['opl_1'] == 'Y' && $tracker['jam_mulai_opl_1'] != null) {
						echo "Proses <strong>" . $opl1['username'] . "</strong>";
					} elseif ($tracker['opl_2'] == 'Y' && $tracker['jam_mulai_opl_2'] != null) {
						echo "Proses <strong>" . $opl2['username'] . "</strong>";
					} elseif ($tracker['opl_3'] == 'Y' && $tracker['jam_mulai_opl_3'] != null) {
						echo "Proses <strong>" . $opl3['username'] . "</strong>";
					} elseif ($tracker['opl_4'] == 'Y' && $tracker['jam_mulai_opl_4'] != null) {
						echo "Proses <strong>" . $opl4['username'] . "</strong>";
					} elseif ($tracker['opl_5'] == 'Y' && $tracker['jam_mulai_opl_5'] != null) {
						echo "Proses <strong>" . $opl5['username'] . "</strong>";
					} elseif ($tracker['opl_1'] == 'Y' && $tracker['o_time_1'] != null ||
							  $tracker['opl_2'] == 'Y' && $tracker['o_time_2'] != null ||
							  $tracker['opl_3'] == 'Y' && $tracker['o_time_3'] != null ||
							  $tracker['opl_4'] == 'Y' && $tracker['o_time_4'] != null ||
							  $tracker['opl_5'] == 'Y' && $tracker['o_time_5'] != null) {
						echo "Selesai Proses OPL";
					}
				?>
			</td>
			<td>
				<?php if($tracker['forman'] == "Y") { ?>		
				<strong><?=$forman['username'];?></strong></br>
					<?php if($tracker['f_status'] == "Y") { ?>
					<div class="badge badge-success"><small><i class="icon-clock"></i> <?=date("H:i", strtotime($tracker['f_time']));?></small></div>
				<?php }} ?>
			</td>
			<td>
				<?php if($tracker['washing'] == "Y") { ?>	
				<strong>Washing</strong></br>
				<div class="badge badge-danger"><small><i class="icon-clock"></i> <?=date("H:i", strtotime($tracker['f_time']));?></small></div>
					<?php if($tracker['w_status'] == "Y") { ?>	
					<div class="badge badge-success"><small><i class="icon-clock"></i> <?=date("H:i", strtotime($tracker['w_time']));?></small></div>
				<?php }
				} elseif ($tracker['washing_use'] == "N") {
					echo "<b><i class='icon-drop'></i></b>";
				}?>
			</td>
			<td>
				<?php
				if($tracker['status']=='Y')
				{
				?>
					<div class="badge badge-success center">
						<i class="fas fa-3x fa-smile"></i> <br>Happy<br>
					</div>
				<?php
				} 
				elseif($tracker['status']=='S')
				{
				?>
					<div class="badge badge-warning center">
						<i class="fas fa-3x fa-frown"></i> <br>Sad<br>
					</div>
				<?php
				} 
				else 
				{ ?>
				<div class="progress">
					<?php 
					if ($tracker['washing_use'] == 'Y') {
						if($tracker['w_status']=='Y') { ?>
							<div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
						<?php }else if($tracker['washing']=='Y') { ?>
							<div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
						<?php }else if($tracker['f_status']=='Y') { ?>
							<div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">75%</div>
						<?php }
					} else {
						if($tracker['f_status']=='Y') { ?>
							<div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
						<?php }else if($tracker['opl']=='Y') { ?>
							<div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
						<?php } 
					}
					?>
				</div>
				<?php } ?>
			</td>
		</tr>
	<?php }
	});

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