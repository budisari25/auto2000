<?php

namespace Racik;

class Directory
{
    function __construct()
    {
        # code...
    }

    // Tampilkan daftar direktori
	public function listDir($dirname)
	{
		$list_dir = array();
		if((file_exists($dirname)) && (is_dir($dirname))) {
			$handle = opendir ($dirname);
			if ($handle) {
				while (($file = readdir($handle)) !== false){
					if ($file != "." AND $file != "..") {
						$list_dir[] = $file;
					}
				}
				closedir($handle);
			}
		}
		return($list_dir);
	}
}