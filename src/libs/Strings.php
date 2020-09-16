<?php

namespace Racik;

class Strings
{
	// Create seo title
	public function seo_title($s)
	{
		$c = array (' ');
		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
		$s = str_replace($d, '', $s);
		$s = strtolower(str_replace($c, '-', $s));
		return $s;
	}

	// Create Permalink
	public function permalink($base_url, $post = array())
	{
		$link = '';
		if (empty($post)){
			$link = $base_url;
			return $link;
		} else {
            $link = $base_url.'/detail/'.$post['seotitle'];
            return $link;
		}
	}

	// Validasi inputan
	public function valid($str, $type)
	{
        switch($type)
		{
			default:
			case 'sql':
				$d = array('-','/','\\',',','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','%','$','^','&','*','=','?','+');
				$str = str_replace($d, '', $str);
				$str = stripcslashes($str);	
				$str = htmlspecialchars($str);				
				$str = preg_replace('/[^A-Za-z0-9]/','',$str);				
				return intval($str);
			break;
			case 'xss':
				$d = array ('\\','#',';','\'','"','[',']','{','}',')','(','|','`','~','!','%','$','^','*','=','?','+');
				$str = str_replace($d, '', $str);
				$str = stripcslashes($str);	
				$str = htmlspecialchars($str);
				return $str;
			break;
		}
	}

	
	public function rupiah($angka)
	{
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;	 
	}

}