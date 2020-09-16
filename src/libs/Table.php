<?php

namespace Racik;

class Table
{
    // Membuat Table
    public function createTable($identity, $columns, $tfoot = true)
    {
        $table = $this->tableStart($identity);
        $table .= $this->tableThead($columns);
        if ($tfoot == true) {
            $table .= $this->tableTfoot(count($columns));
        }
        $table .= $this->tableEnd();
        return($table);
    }
    
    // Membuat Awal dari Table
    public function tableStart($param = array())
    {
        $default = array(
            'id' => null, 'class' => null, 'options' => null
        );
        $param = array_merge($default, $param);
        $start = "<table id=\"{$param['id']}\" class=\"{$param['class']}\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" {$param['options']}>\n";
        return($start);
    }
    
    // Membuat Akhir Dari Table
    public function tableEnd()
    {
        $end = "</table>\n";
        return($end);
    }
    
    // Membuat Thead pada table
    public function tableThead($columns = array())
    {
        $thead = "<thead>\n";
        $thead .= "<tr>\n";
        $thead .= "<th class=\"no-sort\" style=\"width:10px;\"></th>\n";
        foreach($columns as $col) {
            $thead .= "<th {$col['options']}>{$col['title']}</th>\n";
        }
        $thead .= "</tr>\n";
        $thead .= "</thead>\n";
        return($thead);
    }
    
    // Membuat Tfoot pada table
    public function tableTfoot($colspan)
    {
        $tfoot = "<tfoot>\n";
        $tfoot .= "<tr>\n";
        $tfoot .= "<td style=\"width:10px;\" class=\"text-center\"><input type=\"checkbox\" id=\"titleCheck\" data-toggle=\"tooltip\" title=\"{$GLOBALS['_']['action_3']}\" /></td>\n";
        $tfoot .= "<td colspan=\"{$colspan}\">\n";
        $tfoot .= "<button class=\"btn btn-sm btn-danger\" type=\"button\" data-toggle=\"modal\" data-target=\"#alertalldel\"><i class=\"fa fa-trash-o\"></i> {$GLOBALS['_']['action_4']}</button>\n";
        $tfoot .= "</td>\n";
        $tfoot .= "</tr>\n";
        $tfoot .= "</tfoot>\n";
        return($tfoot);
    }
}