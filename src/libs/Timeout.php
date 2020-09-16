<?php

namespace Racik;

class Timeout 
{    
	/** Fungsi ini digunakan untuk mencatat sesi aktif */
	public function rec_session($session = array())
	{
		$_SESSION['iduser'] 		= $session['id_user'];
		$_SESSION['namauser'] 		= $session['username'];
		$_SESSION['namalengkap'] 	= $session['nama_lengkap'];
		$_SESSION['leveluser'] 		= $session['level'];
		$_SESSION['login'] 			= 1;
	}
	
	/**
	 * Member Record
	 */
	/** Fungsi ini digunakan untuk mencatat sesi aktif member */
	public function rec_session_member($session = array())
	{
		$_SESSION['iduser_member'] 		= $session['id_user'];
		$_SESSION['namauser_member'] 	= $session['username'];
		$_SESSION['namalengkap_member'] = $session['nama_lengkap'];
		$_SESSION['leveluser_member'] 	= $session['level'];
		$_SESSION['login_member'] 		= 1;
	}

	/**
	 * BK Record
	 */
	/** Fungsi ini digunakan untuk mencatat sesi aktif BK */
	public function rec_session_bk($session = array())
	{
		$_SESSION['nobk'] 		= $session['nobk'];
	}

	/** Fungsi ini digunakan untuk mencatat sesi timeout user */
	public function timer()
	{
		$time = 10000;
		$_SESSION['timeout'] = time() + $time;
	}

	/** Fungsi ini digunakan untuk mengecek sesi login user */
	public function check_login()
	{
		// $timeout = NULL;
		$timeout = isset($_SESSION['timeout']) ? $_SESSION['timeout'] : '';
		if (time() < $timeout) {
			$this->timer();
			return true;
		} else {
			session_unset();
			return false;
		}
	}
}