<?php

namespace Racik;

class DateTime 
{
    
    // Deklarasi Variabel Utama
    public $week = array();
    public $day;
    public $today;
    public $date_now;
    public $day_now;
    public $month_now;
    public $year_now;
    public $time_now;
    public $nama_bln = array();

    function __construct()
    {
        date_default_timezone_set(TIMEZONE);
        $this->week      = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $this->day       = date("w");
        $this->today     = $this->week[$this->day];
        $this->date_now  = date("Y-m-d");
        $this->day_now   = date("d");
        $this->month_now = date("m");
        $this->year_now  = date("Y");
        $this->time_now  = date("H:i:s");
        $this->nama_bln  = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    }
    
    // Membuat daftar TimeZone
    public function timezoneList()
    {
        $timezoneIdentifiers = DateTimeZone::listIdentifiers();
        $utcTime = new DateTime('now', new DateTimeZone('UTC'));
        $tempTimezones = array();
        foreach($timezoneIdentifiers as $timezoneIdentifier)
        {
            $currentTimezone = new DateTimeZone($timezoneIdentifier);
            $tempTimezones[] = array(
                'offset' => (int)$currentTimezone->getOffset($utcTime),
                'identifier' => $timezoneIdentifier
            );
        }
        function sort_list($a, $b)
        {
            return ($a['offset'] == $b['offset']) 
                ? strcmp($a['identifier'], $b['identifier'])
                : $a['offset'] - $b['offset'];
        }
        usort($tempTimezones, "sort_list");
        $timezoneList = array();
        foreach($tempTimezones as $tz)
        {
            $sign = ($tz['offset'] > 0) ? '+' : '-';
            $offset = gmdate('H:i', abs($tz['offset']));
            $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
                $tz['identifier'];
        }
        return $timezoneList;
    }

    // Membuat Format tanggal dalam bahasa indonesia
    public function tgl_indo($tgl)
    {
        $tanggal = substr($tgl,8,2);
        $bulan = $this->getBulanShrt(substr($tgl,5,2));
        $tahun = substr($tgl,0,4);
        return $tanggal.' '.$bulan.' '.$tahun;         
    }
    
    // Membuat Nama bulan dalam bahasa indonesia
    public function getBulan($bln)
    {
        switch($bln){
            case 1: 
                return "Januari";
            break;
            case 2:
                return "Februari";
            break;
            case 3:
                return "Maret";
            break;
            case 4:
                return "April";
            break;
            case 5:
                return "Mei";
            break;
            case 6:
                return "Juni";
            break;
            case 7:
                return "Juli";
            break;
            case 8:
                return "Agustus";
            break;
            case 9:
                return "September";
            break;
            case 10:
                return "Oktober";
            break;
            case 11:
                return "November";
            break;
            case 12:
                return "Desember";
            break;
        }
    }

    // Membuat nama bulan dalam bahasa indonesia versi pendek
    public function getBulanShrt($bln)
    {
        switch($bln)
        {
            case 1: 
                return "Jan";
            break;
            case 2:
                return "Feb";
            break;
            case 3:
                return "Mar";
            break;
            case 4:
                return "Apr";
            break;
            case 5:
                return "Mei";
            break;
            case 6:
                return "Jun";
            break;
            case 7:
                return "Jul";
            break;
            case 8:
                return "Agu";
            break;
            case 9:
                return "Sep";
            break;
            case 10:
                return "Okt";
            break;
            case 11:
                return "Nov";
            break;
            case 12:
                return "Des";
            break;
        }
    }

    public function beda_waktu($date1, $date2, $format = false) {
        $diff = date_diff( date_create($date1), date_create($date2) );
        
        // if($menit >= 0 && $menit <= 9){
        //     $menit = "0".$menit;
        // }
        
        if ($format)
            return $diff->format($format);
        
        return array(
            'y' => $diff->y,
            'm' => $diff->m,
            'd' => $diff->d,
            'h' => $diff->h,
            'i' => $diff->i,
            's' => $diff->s
        );
    }

    public function selisih_tgl($tanggal)
    {       
        $date           = strtotime($tanggal);
        $sekarang       = time(); // Waktu sekarang
        $diff           = $sekarang - $date;
        $selisih        = floor($diff / (60 * 60 * 24));
        return $selisih;
    }
}