<!-- Layout -->
<?=$this->layout('member::layout')?>

<style type="text/css" media="screen">
    table thead th { text-align: center; vertical-align: middle!important;}
</style>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="page-header mb-3">
            <h3>Selamat Datang</h3>
            <small><?=$user['nama_lengkap'];?> di halaman member</small>
        </div>

        <div class="row">
            <div class="col-md-12">
                <center>
                    <h3><b>Estimasi Service Plus</b></h3>
                </center>
                <div class="table-responsive">
                    <table id="table" class="table table-bordered" cellpadding="0" cellspacing="0" border="0" width="100%">
                        <thead>
                                <th></th>
                                <th colspan="2" width="23%">0:15:00</th>
                                <th colspan="2" width="23%">0:30:00</th>
                                <th colspan="2" width="23%">0:45:00</th>
                                <th colspan="2" width="23%">1:00:00</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>8:00:00</th>
                                <?php
                                    $jam_8_15 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '08:00'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '08:15'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_8_15) > 1) {
                                        foreach ($jam_8_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_8_15) > 0) {
                                        foreach ($jam_8_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_8_30 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '08:15'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '08:30'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_8_30) > 1) {
                                        foreach ($jam_8_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_8_30) > 0) {
                                        foreach ($jam_8_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_8_45 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '08:30'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '08:45'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_8_45) > 1) {
                                        foreach ($jam_8_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_8_45) > 0) {
                                        foreach ($jam_8_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_8_60 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '08:45'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '09:00'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_8_60) > 1) {
                                        foreach ($jam_8_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_8_60) > 0) {
                                        foreach ($jam_8_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                            </tr>

                            <tr>
                                <th>9:00:00</th>
                                <?php
                                    $jam_9_15 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '09:00'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '09:15'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_9_15) > 1) {
                                        foreach ($jam_9_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_9_15) > 0) {
                                        foreach ($jam_9_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                                
                                <?php
                                    $jam_9_30 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '09:15'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '09:30'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_9_30) > 1) {
                                        foreach ($jam_9_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_9_30) > 0) {
                                        foreach ($jam_9_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_9_45 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '09:30'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '09:45'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_9_45) > 1) {
                                        foreach ($jam_9_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_9_45) > 0) {
                                        foreach ($jam_9_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_9_60 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '09:45'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '10:00'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_9_60) > 1) {
                                        foreach ($jam_9_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_9_60) > 0) {
                                        foreach ($jam_9_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                            </tr>

                            <tr>
                                <th>10:00:00</th>
                                <?php
                                    $jam_10_15 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '10:00'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '10:15'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_10_15) > 1) {
                                        foreach ($jam_10_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_10_15) > 0) {
                                        foreach ($jam_10_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                                
                                <?php
                                    $jam_10_30 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '10:15'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '10:30'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_10_30) > 1) {
                                        foreach ($jam_10_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_10_30) > 0) {
                                        foreach ($jam_10_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_10_45 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '10:30'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '10:45'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_10_45) > 1) {
                                        foreach ($jam_10_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_10_45) > 0) {
                                        foreach ($jam_10_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_10_60 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '10:45'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '11:00'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_10_60) > 1) {
                                        foreach ($jam_10_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_10_60) > 0) {
                                        foreach ($jam_10_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                            </tr>

                            <tr>
                                <th>11:00:00</th>
                                <?php
                                    $jam_11_15 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '11:00'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '11:15'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_11_15) > 1) {
                                        foreach ($jam_11_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_11_15) > 0) {
                                        foreach ($jam_11_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                                
                                <?php
                                    $jam_11_30 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '11:15'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '11:30'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_11_30) > 1) {
                                        foreach ($jam_11_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_11_30) > 0) {
                                        foreach ($jam_11_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_11_45 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '11:30'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '11:45'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_11_45) > 1) {
                                        foreach ($jam_11_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_11_45) > 0) {
                                        foreach ($jam_11_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_11_60 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '11:45'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '12:00'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_11_60) > 1) {
                                        foreach ($jam_11_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_11_60) > 0) {
                                        foreach ($jam_11_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                            </tr>

                            <tr>
                                <th>12:00:00</th>
                                <?php
                                    $jam_12_15 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '12:00'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '12:15'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_12_15) > 1) {
                                        foreach ($jam_12_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_12_15) > 0) {
                                        foreach ($jam_12_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                                
                                <?php
                                    $jam_12_30 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '12:15'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '12:30'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_12_30) > 1) {
                                        foreach ($jam_12_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_12_30) > 0) {
                                        foreach ($jam_12_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_12_45 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '12:30'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '12:45'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_12_45) > 1) {
                                        foreach ($jam_12_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_12_45) > 0) {
                                        foreach ($jam_12_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_12_60 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '12:45'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '13:00'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_12_60) > 1) {
                                        foreach ($jam_12_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_12_60) > 0) {
                                        foreach ($jam_12_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                            </tr>

                            <tr>
                                <th>13:00:00</th>
                                <?php
                                    $jam_13_15 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '13:00'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '13:15'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_13_15) > 1) {
                                        foreach ($jam_13_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_13_15) > 0) {
                                        foreach ($jam_13_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                                
                                <?php
                                    $jam_13_30 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '13:15'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '13:30'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_13_30) > 1) {
                                        foreach ($jam_13_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_13_30) > 0) {
                                        foreach ($jam_13_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_13_45 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '13:30'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '13:45'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_13_45) > 1) {
                                        foreach ($jam_13_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_13_45) > 0) {
                                        foreach ($jam_13_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_13_60 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '13:45'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '14:00'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_13_60) > 1) {
                                        foreach ($jam_13_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_13_60) > 0) {
                                        foreach ($jam_13_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                            </tr>

                            <tr>
                                <th>14:00:00</th>
                                <?php
                                    $jam_14_15 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '14:00'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '14:15'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_14_15) > 1) {
                                        foreach ($jam_14_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_14_15) > 0) {
                                        foreach ($jam_14_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                                
                                <?php
                                    $jam_14_30 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '14:15'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '14:30'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_14_30) > 1) {
                                        foreach ($jam_14_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_14_30) > 0) {
                                        foreach ($jam_14_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_14_45 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '14:30'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '14:45'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_14_45) > 1) {
                                        foreach ($jam_14_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_14_45) > 0) {
                                        foreach ($jam_14_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_14_60 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '14:45'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '15:00'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_14_60) > 1) {
                                        foreach ($jam_14_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_14_60) > 0) {
                                        foreach ($jam_14_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                            </tr>

                            <tr>
                                <th>15:00:00</th>
                                <?php
                                    $jam_15_15 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '15:00'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '15:15'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_15_15) > 1) {
                                        foreach ($jam_15_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_15_15) > 0) {
                                        foreach ($jam_15_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                                
                                <?php
                                    $jam_15_30 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '15:15'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '15:30'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_15_30) > 1) {
                                        foreach ($jam_15_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_15_30) > 0) {
                                        foreach ($jam_15_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_15_45 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '15:30'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '15:45'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_15_45) > 1) {
                                        foreach ($jam_15_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_15_45) > 0) {
                                        foreach ($jam_15_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_15_60 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '15:45'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '16:00'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_15_60) > 1) {
                                        foreach ($jam_15_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_15_60) > 0) {
                                        foreach ($jam_15_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                            </tr>

                            <tr>
                                <th>16:00:00</th>
                                <?php
                                    $jam_16_15 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '16:00'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '16:15'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_16_15) > 1) {
                                        foreach ($jam_16_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_16_15) > 0) {
                                        foreach ($jam_16_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                                
                                <?php
                                    $jam_16_30 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '16:15'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '16:30'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_16_30) > 1) {
                                        foreach ($jam_16_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_16_30) > 0) {
                                        foreach ($jam_16_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_16_45 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '16:30'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '16:45'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_16_45) > 1) {
                                        foreach ($jam_16_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_16_45) > 0) {
                                        foreach ($jam_16_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_16_60 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '16:45'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '17:00'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_16_60) > 1) {
                                        foreach ($jam_16_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_16_60) > 0) {
                                        foreach ($jam_16_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                            </tr>

                            <tr>
                                <th>17:00:00</th>
                                <?php
                                    $jam_17_15 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '17:00'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '17:15'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_17_15) > 1) {
                                        foreach ($jam_17_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_17_15) > 0) {
                                        foreach ($jam_17_15 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                                
                                <?php
                                    $jam_17_30 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '17:15'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '17:30'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_17_30) > 1) {
                                        foreach ($jam_17_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_17_30) > 0) {
                                        foreach ($jam_17_30 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_17_45 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '17:30'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '17:45'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_17_45) > 1) {
                                        foreach ($jam_17_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_17_45) > 0) {
                                        foreach ($jam_17_45 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>

                                <?php
                                    $jam_17_60 = $this->core()->call->db->from('tracker')
                                    ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                                    ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                                    // ->where('date = :d', array(':d' => date("Y-m-d")))
                                    ->where('status = :s', array(':s' => 'N'))
                                    ->where('estimasi_waktu_cuci >= :start', array(':start' => '17:45'))
                                    ->where('estimasi_waktu_cuci < :end', array(':end' => '18:00'))
                                    ->limit(2)
                                    ->fetchAll();

                                    if (count($jam_17_60) > 1) {
                                        foreach ($jam_17_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                    } elseif (count($jam_17_60) > 0) {
                                        foreach ($jam_17_60 as $row) {
                                            echo "<td style='background-color: red; color: #fff; font-weight: 700' class='detail' data-id-mobil='" . $row['id'] . "'>" . $row['nobk'] . "</td>";
                                        }
                                        echo "<td></td>";
                                    } else {
                                        echo "<td></td><td></td>";
                                    }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <center>
                    <h3><b>Monitoring Progress Service Plus</b></h3>
                </center>
                <div class="table-responsive">
                    <table id="tableMonitoring" class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" width="100%">
                        <thead>
                            <tr>
                                <th rowspan="2">No.Pol</th>
                                <th rowspan="2">Nama SA</th>
                                <th colspan="2">Stall Tunggu</th>
                                <th colspan="2">Stall Proses</th>
                                <th rowspan="2">Delivery</th>
                            </tr>
                            <tr>
                                <th>Jam Tiba</th>
                                <th>Jam Mulai</th>
                                <th>Jam Tiba</th>
                                <th>Jam Selesai</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>


        <div class="row"> 
            <!--index-->
            <div class="col-6 col-md-2">
                <a href="<?=BASE_URL;?>/member/tracker/index">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">                                
                            <?=$this->core()->call->db->from('tracker')
                            ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                            ->where('member = :etma', array(':etma' =>$user_member['id_user']))
                            ->where('date = :d OR status = :s', array(':d' => date("Y-m-d"), ':s'=>'N'))
                            ->where('member = :etm', array(':etm' =>$user_member['id_user']))
                            ->where('editor_sa = :es', array(':es' =>$user['id_user']))
                            ->count();?>
                        </h5>
                        <p class="card-text">Mobil Masuk</p>
                    </div>
                    <div class="card-footer success-color">
                        <small class="text-muted white-text">SA</small>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-6 col-md-2">
                <a href="<?=BASE_URL;?>/member/tracker/done">
                <div class="card mb-3">
                    <div class="card-body success-color">
                        <h5 class="card-title white-text">                                
                            <?=$this->core()->call->db->from('tracker')
                            ->where('member = :etm', array(':etm' =>$user_member['id_user']))
                            ->where('editor_sa = :e', array(':e' =>$user['id_user']))
                            ->where('date = :d', array(':d' => date("Y-m-d")))
                            ->where('status = :st OR status = :ss', array(':st' => 'Y', ':ss' => 'S'))
                            ->count();?>
                        </h5>
                        <p class="card-text white-text">Mobil Selesai</p>
                    </div>
                    <div class="card-footer success-color-dark">
                        <small class="text-muted white-text">SA</small>
                    </div>
                </div>
                </a>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal_antrian" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tableAntrian" class="table table-striped" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <thead>
                                    <tr>
                                        <th >No.Pol</th>
                                        <th >Mobil</th>
                                        <th >Tgl</th>
                                        <th >Masuk</th>
                                        <th >Est. Mulai Cuci</th>
                                        <th >Est. Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                         
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
</div>

<!-- Add script -->
<?php $this->push('scripts') ?>
    <!-- Notifikasi Script -->
    <script>
        $('.detail').click(function(event) {

            let id = $(this).data("id-mobil");

            $('#tableAntrian').DataTable().clear().destroy();

            $('#tableAntrian').DataTable({
                "searching": false,
                "paging": false,
                "bInfo" : false,
                "autoWidth": false,
                "responsive" : true,
                "columnDefs": [
                    {
                        'targets': 0,
                        "data": 'nobk'
                    },
                    {
                        'targets': 1,
                        "data": 'nama_tipe'
                    },
                    {
                        'targets': 2,
                        "data": 'date_in'
                    },
                    {
                        'targets': 3,
                        "data": 'time'
                    },
                    {
                        'targets': 4,
                        "data": 'estimasi_waktu_cuci'
                    },
                    {
                        'targets': 5,
                        "data": 'estimasiselesai'
                    }
                ],
                "serverSide": true,
                "processing": true,
                "ajax": {
                    'type': 'get',
                    'url': BASE_URL + '/member/t/get-tracker/' + id,
                }
            });

            $('#modal_antrian').modal('show');
        });

        $('#tableMonitoring').DataTable({
            "language": {
                "paginate": {
                    "previous": "Prev"
                },
                "infoEmpty": "No entries",
                "search": "",
                "sSearchPlaceholder": "Search...",
                "lengthMenu": '',
                "infoFiltered": ""
            },
            "autoWidth": false,
            "responsive" : true,
            "columnDefs": [
                {
                    'targets': 0,
                    "data": 'nobk'
                },
                {
                    'targets': 1,
                    "data": 'nama_lengkap'
                },
                {
                    'targets': 2,
                    "data": 'f_time'
                },
                {
                    'targets': 3,
                    "data": 'w_time'
                },
                {
                    'targets': 4,
                    "data": 'w_time'
                },
                {
                    'targets': 5,
                    "data": 'jam_selesai_cuci'
                },
                {
                    'targets': 6,
                    "data": 'status'
                }
            ],
            "serverSide": true,
            "processing": true,
            "ajax": {
                'type': 'post',
                'url': BASE_URL + '/member/t/monitoring/datatable',
            },
        });
        
        $('#table_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#table_wrapper .dataTables_filter').addClass('md-form');
    </script>
 
<?php $this->end() ?>