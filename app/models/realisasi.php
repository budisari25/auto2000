<?php

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class Realisasi implements ExtensionInterface
{
    public $call; // must be public
    
    public function __construct()
    {
        $this->call = new Racik\Core();
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('chart', [$this, 'getObject']);
    }    
    
	public function getObject()
    {
        return $this;
    }
    
	public function bar_sa()
    {
		$query = $this->call->db->from('users u')
            ->where('u.level', 5)
            ->where('u.company', $_SESSION['iduser_member'])
            ->group('u.id_user')
			->fetchAll();
        $chart_data = '';
        foreach ($query as $row) {
            $tracker = $this->call->db->from('tracker t')
                ->where('t.date', date('Y-m-d'))
                ->where('t.editor_sa', $row['id_user'])
                ->count();
            $chart_data .= "{ ket:'".$row["username"]."', jumlah:".$tracker."}, ";
        }
        $chart_data = substr($chart_data, 0, -2);
        return $chart_data;
    }

	public function bar_foreman()
    {
		$query = $this->call->db->from('users u')
            ->where('u.level', 3)
            ->where('u.company', $_SESSION['iduser_member'])
            ->group('u.id_user')
			->fetchAll();
        $chart_data = '';
        foreach ($query as $row) {
            $tracker = $this->call->db->from('tracker t')
                ->where('t.date', date('Y-m-d'))
                ->where('t.f_kelompok', $row['id_user'])
                ->count();
            $chart_data .= "{ ket:'".$row["username"]."', jumlah:".$tracker."}, ";
        }
        $chart_data = substr($chart_data, 0, -2);
        return $chart_data;
    }    

	// public function bar_kerusakan()
 //    {
	// 	$query = $this->call->db->from('kerusakan u')
 //            ->group('u.id_kerusakan')
	// 		->fetchAll();
 //        $chart_data = '';
 //        foreach ($query as $row) {
 //            $tracker = $this->call->db->from('tracker t')
 //                ->where('t.date', date('Y-m-d'))
 //                ->where('t.kerusakan_id', $row['id_kerusakan'])
 //                ->count();
 //            $chart_data .= "{ ket:'".$row["jenis"]."', jumlah:".$tracker."}, ";
 //        }
 //        $chart_data = substr($chart_data, 0, -2);
 //        return $chart_data;
 //    }    

	public function bar_tipe()
    {
		$query = $this->call->db->from('tipe_mobil u')
            ->group('u.id_tipe')
			->fetchAll();
        $chart_data = '';
        foreach ($query as $row) {
            $tracker = $this->call->db->from('tracker t')
                ->where('t.date', date('Y-m-d'))
                ->where('t.tipe_id', $row['id_tipe'])
                ->count();
            $chart_data .= "{ ket:'".$row["nama_tipe"]."', jumlah:".$tracker."}, ";
        }
        $chart_data = substr($chart_data, 0, -2);
        return $chart_data;
    }    

    public function donat()
    {
        $sa = $this->call->db->from('booking')    
            ->where('member = :etma', array(':etma' =>$_SESSION['iduser_member']))       
            ->where('booking = :da', array(':da' => date("Y-m-d"))) 
            ->where('ket = :ha', array(':ha' => 'sa')) 
            ->count();
        $mra = $this->call->db->from('booking')    
            ->where('member = :etma', array(':etma' =>$_SESSION['iduser_member']))       
            ->where('booking = :da', array(':da' => date("Y-m-d"))) 
            ->where('ket = :ha', array(':ha' => 'mra')) 
            ->count();
        $sales = $this->call->db->from('booking')    
            ->where('member = :etma', array(':etma' =>$_SESSION['iduser_member']))       
            ->where('booking = :da', array(':da' => date("Y-m-d"))) 
            ->where('ket = :ha', array(':ha' => 'sales')) 
            ->count();
        $persentase_sa = round($sa/($sa+$mra+$sales) * 100,0);
        $persentase_mra = round($mra/($sa+$mra+$sales) * 100,0);
        $persentase_sales = round($sales/($sa+$mra+$sales) * 100,0);
        
        $chart_data = '';
        $chart_data .= "{ label:'SA ($sa)', value:".$persentase_sa."}, ";
        $chart_data .= "{ label:'MRA ($mra)', value:".$persentase_mra."}, ";
        $chart_data .= "{ label:'Sales ($sales)', value:".$persentase_sales."} ";
        return $chart_data;
    }

    public function pie_rate()
    {
        $query = $this->call->db->from('polling')
            ->group('nilai')
            ->fetchAll();
        $chart_data = '';
        $label_name = '';
        foreach ($query as $row) {
            $tracker = $this->call->db->from('polling')
                ->where('nilai', $row['nilai'])
                ->count();
                if ($row["nilai"] == 5) {
                    $label_name = "Sangat Puas";
                }elseif ($row["nilai"] == 4) {
                    $label_name = "Puas";
                }elseif ($row["nilai"] == 3) {
                    $label_name = "Cukup Puas";
                }elseif ($row["nilai"] == 2) {
                    $label_name = "Kurang Puas";
                }else {
                    $label_name = "Tidak Puas";
                }
            $chart_data .= "{ label:'".$label_name."', value:".$tracker."}, ";
        }
        $chart_data = substr($chart_data, 0, -2);
        return $chart_data;
    } 
}