<?php
/** Memulai Session */
session_start();

/** Mendefinisikan BAse Url */
$base_root = ((isset($_SERVER['HTTPS']) 
    && $_SERVER['HTTPS'] 
    && !in_array(strtolower($_SERVER['HTTPS']), array('off','no'))) ? 'https' : 'http')
    .'://'.$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
$base_url = preg_replace("/\/(index\.php$)/", "", $base_root);
define('BASE_URL', $base_url);

// Cek kesedian file konfigurasi system
if(!file_exists('src/config.php')){
    echo "File config.php tidak ditemukan";
} else {
    // Memanggil konfigurasi
    require "src/version.php";
    require "src/config.php";

    // Memanggil system utama
    require DIR_SRC."/setup.php";
}