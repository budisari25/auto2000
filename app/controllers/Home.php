<?php

/**
 * Call Home
 */
$router->get('/', function() use($core, $templates)
{
	// Cek Member		
	if(isset($_SESSION['iduser_member'])) {
		// Redirect to monitoring
		header('location:'. BASE_URL.'/opl');
	} else {
		// Redirect ke login
		header('location:'. BASE_URL.'/login');
	}
});

// Will result member
$router->get('/member', function() use ($templates, $core) 
{
	// Cek Login user
	$timeout = new Racik\Timeout;
	if (!$timeout->check_login()) {
		$_SESSION['login'] = 0;
	}
	// Cek Member		
	if(!isset($_SESSION['iduser']) OR !isset($_SESSION['iduser_member']) OR $_SESSION['login'] == 0) 
	{
		$core->flash->success('Maaf anda belum login', BASE_URL.'/login', true);
	} 
	// Data user berdasarkan session
	$user = $core->db->from('users')
		->where('id_user', $_SESSION['iduser'])
		->limit(1)->fetch();
	$user_member = $core->db->from('users')
		->where('id_user', $_SESSION['iduser_member'])
		->limit(1)->fetch();

	// Data Template
	$info = array(
		'page_title'	=> $core->setting->site('web_name'),
		'page_desc'		=> $core->setting->site('web_meta'),
		'page_key' 		=> $core->setting->site('web_keyword'),
		'page_owner' 	=> $core->setting->site('web_owner')
	);
	$templates->addData($info);
	
	switch ($user['level']) {
		case 16:
			// Render template Valled
			echo $templates->render('member::valled', compact('user', 'user_member'));
			break;
		case 15:
			// Render template OPL
			echo $templates->render('member::opl', compact('user', 'user_member'));
			break;
		case 14:
			// Render template OPL
			echo $templates->render('member::opl', compact('user', 'user_member'));
			break;
		case 13:
			// Render template OPL
			echo $templates->render('member::opl', compact('user', 'user_member'));
			break;
		case 12:
			// Render template OPL
			echo $templates->render('member::opl', compact('user', 'user_member'));
			break;
		case 11:
			// Render template OPL
			echo $templates->render('member::opl', compact('user', 'user_member'));
			break;
		case 9:
			// Render template Sales
			echo $templates->render('member::mra', compact('user', 'user_member'));
			break;
		case 8:
			// Render template MRA
			echo $templates->render('member::mra', compact('user', 'user_member'));
			break;
		case 6:
			// Render template Manager
			echo $templates->render('member::manager', compact('user', 'user_member'));
			break;
		case 5:
			// Render template SA
			echo $templates->render('member::tracker', compact('user', 'user_member'));
			break;
		case 4:
			// Render template Washing
			echo $templates->render('member::washing', compact('user', 'user_member'));
			break;
		case 3:
			// Render template Foreman
			echo $templates->render('member::foreman', compact('user', 'user_member'));
			break;
		case 2:
			// Render template PTM
			echo $templates->render('member::opl', compact('user', 'user_member'));
			break;
	}
});

// will result Not Found
$router->get('/404', function() use($core, $templates){
	// Data Template
	$info = array(
		'page_title'	=> $core->setting->site('web_name'),
		'page_desc'		=> $core->setting->site('web_meta'),
		'page_key' 		=> $core->setting->site('web_keyword'),
		'page_owner' 	=> $core->setting->site('web_owner')
	);
	$templates->addData($info);
	// Render template 404
	echo $templates->render('site::404');
});