<?php

namespace Racik;

class Html
{
    // Membuat Kepada Judul kontent Admin
    public function headTitle($title, $options = null)
    {
        $head = "<div class=\"block-header\">\n";
        $head .= "<h3 class=\"mt-0\">{$title}</h3>\n";
        if ($options != null) {
            $head .= $options;
        } else {            
            $head .= "<ol class=\"list-inline list-unstyled\">\n";
            $head .= "<li><a href=\"".BASE_URL."/admin\">Dashboard</a></li>\n";
            $head .= "<li>/</li>\n";
            $head .= "<li class=\"active\">{$title}</li>\n";
            $head .= "</ol>\n";
        }
        $head .= "</div>\n";
        return($head);
    }
    
    // Membuat dialog hapus pada konten admin
    public function dialogDelete($component, $act = null)
    {
        $dialogdel = "<div id=\"alertdel\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n";
        $dialogdel .= "<div class=\"modal-dialog\">\n";
        $dialogdel .= "<div class=\"modal-content\">\n";
        if ($act == null) {
            $dialogdel .= "<form method=\"post\" action=\"".BASE_URL."/member/{$component}/delete\" autocomplete=\"off\">\n";
        } else {
            $dialogdel .= "<form method=\"post\" action=\"".BASE_URL."/member/{$component}/{$act}\" autocomplete=\"off\">\n";
        }
        $dialogdel .= "<div class=\"modal-header\">\n";
        $dialogdel .= "<h4 id=\"modal-title\"><i class=\"fa fa-exclamation-triangle text-danger\"></i> Konfirmasi Penghapusan</h4>\n";
        $dialogdel .= "</div>\n";
        $dialogdel .= "<div class=\"modal-body\">\n";
        $dialogdel .= "<input type=\"hidden\" id=\"delid\" name=\"id\" />\n";
        $dialogdel .= "Apakah Anda yakin akan menghapus data ini?\n";
        $dialogdel .= "</div>\n";
        $dialogdel .= "<div class=\"modal-footer\">\n";
        $dialogdel .= "<button type=\"submit\" class=\"btn btn-sm btn-danger\"><i class=\"fa fa-trash-o\"></i> Ya</button>\n";
        $dialogdel .= "<button type=\"button\" class=\"btn btn-sm btn-default\" data-dismiss=\"modal\" aria-hidden=\"true\"><i class=\"fa fa-sign-out\"></i> Tidak</button>\n";
        $dialogdel .= "</div>\n";
        $dialogdel .= "</form>\n";
        $dialogdel .= "</div>\n";
        $dialogdel .= "</div>\n";
        $dialogdel .= "</div>\n";
        return($dialogdel);
    }
    
    // Membuat dialog hapus semua pada konten Admin
    public function dialogDeleteAll($component)
    {
        $dialogdelall = "<div id=\"alertalldel\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n";
        $dialogdelall .= "<div class=\"modal-dialog\">\n";
        $dialogdelall .= "<div class=\"modal-content\">\n";
        $dialogdelall .= "<form method=\"post\" action=\"".BASE_URL."/admin/{$component}/multidelete\" autocomplete=\"off\">\n";
        $dialogdelall .= "<div class=\"modal-header\">\n";
        $dialogdelall .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
        $dialogdelall .= "<h4 id=\"modal-title\"><i class=\"fa fa-exclamation-triangle text-danger\"></i> Konfirmasi Penghapusan</h4>\n";
        $dialogdelall .= "</div>\n";
        $dialogdelall .= "<div class=\"modal-body\">\n";
        $dialogdelall .= "<input type=\"text\" id=\"delallid\" name=\"id\" />\n";
        $dialogdelall .= "Apakah Anda yakin akan menghapus data ini?\n";
        $dialogdelall .= "</div>\n";
        $dialogdelall .= "<div class=\"modal-footer\">\n";
        $dialogdelall .= "<button type=\"submit\" class=\"btn btn-sm btn-danger\"><i class=\"fa fa-trash-o\"></i> Ya</button>\n";
        $dialogdelall .= "<button type=\"button\" class=\"btn btn-sm btn-default\" data-dismiss=\"modal\" aria-hidden=\"true\"><i class=\"fa fa-sign-out\"></i> Tidak</button>\n";
        $dialogdelall .= "</div>\n";
        $dialogdelall .= "</form>\n";
        $dialogdelall .= "</div>\n";
        $dialogdelall .= "</div>\n";
        $dialogdelall .= "</div>\n";
        return($dialogdelall);
    }    
}