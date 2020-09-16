<?php

namespace Racik;

use Plasticbrain\FlashMessages\FlashMessages as Notif;
use FluentPDO as FPDO;
use GUMP as Valid;

/** Inisialisasi semua class Pocore*/
class Core
{
    public $pdo;
    public $db;
    public $ora;
    public $oradb;
    public $connect;
    public $flash;
    public $val;
    public $html;
    public $string;
    public $helper;
    public $datetime;
    public $setting;
    public $theme;
    public $paging;

    public function __construct()
    {
        /** Koneksi Database MySQL */
        $this->pdo        = new Database\MySQL();
        $this->db         = new FPDO($this->pdo->connect());
        $this->connect    = array('user' => DB_USER, 'pass' => DB_PASS, 'db' => DB_NAME, 'host' => DB_HOST);
        $this->flash      = new Notif();                // Menampilkan Pesan Alert
        $this->val        = new Valid();                // Validasi dan filter data
        $this->html       = new Html();               // Struktur Form secara Otomatis
        $this->table      = new Table();              // Struktur Table secara Otomatis
        $this->string     = new Strings();             // Pengelolahan String
        // $this->helper     = new PoHelper();             // Function tambahan
        $this->datetime   = new DateTime();           // Pengelolahan tanggal dan waktu
        // $this->paging     = new PoPaging();             // Struktur paging halaman secara otomatis
        $this->setting    = new Setting();            // Pengambilan nilai pada table setting
    }
    
    /** Autentikasi User */
    public function auth($level, $controller, $crud)
    {
        $user_level = $this->db->from('user_level')
            ->where('id', $level)
            ->limit(1)
            ->fetch();
        $itemfusion = '';
        $roles = json_decode($user_level['role'], true);
        foreach($roles as $key => $role){
            if($roles[$key]['component'] == $controller){
                $itemfusion .= $roles[$key][$crud];
            } else {
                unset($roles[$key]);
            }
        }
        if ($itemfusion == 1) {
            return true;
        } else {
            return false;
        }
    }
}