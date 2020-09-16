<?php

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class Form implements ExtensionInterface
{    
    public function register(Engine $engine)
    {
        $engine->registerFunction('form', [$this, 'getObject']);
    }    
    
	public function getObject()
    {
        return $this;
    }

    /* Membuat awal dari form */
    public function formStart($param = array())
    {
        $default = array(
            'method' => null, 'action' => null, 'enctype' => false, 'autocomplete' => 'on', 'options' => null
        );
        $param = array_merge($default, $param);

        /* Parameter untuk inputan file */
        if ($param['enctype'] === true) {
            $start = "<form method=\"{$param['method']}\" action=\"{$param['action']}\" enctype=\"multipart/form-data\" autocomplete=\"{$param['autocomplete']}\" {$param['options']}>\n";
        } else {
            $start = "<form method=\"{$param['method']}\" action=\"{$param['action']}\" autocomplete=\"{$param['autocomplete']}\" {$param['options']}>\n";
        }
        return($start);
    }

    /* Membuat akhir dari form */
    public function formEnd()
    {
        $end = "</form>\n";
        return($end);
    }

    /* Membuat inputan dengan type hidden */
    public function inputHidden($param = array())
    {
        $default = array(
            'name' => null, 'value' => null, 'options' => null
        );
        $param = array_merge($default, $param);
        $inputhidden = "<input type=\"hidden\" name=\"{$param['name']}\" value=\"{$param['value']}\" {$param['options']}>\n";
        return($inputhidden);
    }

    /* Membuat Inputan dengan type text */
    public function inputText($param = array(), $inputgroup = false, $inputgroupopt = null)
    {
        $default = array(
            'type' => null, 'id' => null, 'class' => null, 'label' => null, 'name' => null, 'value' => null, 'placeholder' => null, 'mandatory' => false, 'options' => null, 'help' => null
        );
        $param = array_merge($default, $param);
        $inputtext = "<div class=\"md-form form-group\">\n";

        /* Cek apakah inputan bertype file atau tidak */
        if ($param['type'] == 'file') {
            $formcontrol = "";
        } else {
            $formcontrol = "form-control";
        }

        /* Cek input text group */
        if ($inputgroup == true) {
            $inputtext .= "<div class=\"input-group\">\n";
        }
        $inputtext .= "<input type=\"{$param['type']}\" class=\"{$formcontrol} {$param['class']}\" id=\"{$param['id']}\" name=\"{$param['name']}\" value=\"{$param['value']}\" placeholder=\"{$param['placeholder']}\" {$param['options']}>\n";

        /* Parameter untuk wajib mengisi inputan */
        if ($param['mandatory'] === true) {
            $inputtext .= "<label for=\"{$param['id']}\">{$param['label']} <span class=\"text-danger\">*</span></label>\n";
        } else {
            $inputtext .= "<label for=\"{$param['id']}\">{$param['label']}</label>\n";
        }

        if ($inputgroup == true) {
            $inputtext .= "<span class=\"input-group-btn\">\n";
            $inputtext .= "<a href=\"{$inputgroupopt['href']}\" id=\"{$inputgroupopt['id']}\" class=\"btn {$inputgroupopt['class']}\" {$inputgroupopt['options']}>{$inputgroupopt['title']}</a>\n";
            $inputtext .= "</span>\n";
            $inputtext .= "</div>\n";
        }

        /* Berikan pesan bantuan untuk inputan */
        if ($param['help'] != null) {
            $inputtext .= "<span class=\"help-block\">{$param['help']}</span>\n";
        }
        $inputtext .= "</div>\n";

        return($inputtext);
    }

    /* Membuat Textarea */
    public function inputTextarea($param = array())
    {
        $default = array(
            'id' => null, 'class' => null, 'label' => null, 'name' => null, 'value' => null, 'placeholder' => null, 'mandatory' => false, 'options' => null, 'help' => null
        );
        $param = array_merge($default, $param);
        $inputtext = "<div class=\"md-form form-group\">\n";

        $inputtext .= "<textarea class=\"md-textarea\" id=\"{$param['id']}\" name=\"{$param['name']}\" placeholder=\"{$param['placeholder']}\" {$param['options']}>{$param['value']}</textarea>\n";

        /* Inputan sangat penting */
        if ($param['mandatory'] === true) {
            $inputtext .= "<label for=\"{$param['id']}\">{$param['label']} <span class=\"text-danger\">*</span></label>\n";
        } else {
            $inputtext .= "<label for=\"{$param['id']}\">{$param['label']}</label>\n";
        }
        
        /* BErikan pesan bantuan untuk inputan */
        if ($param['help'] != null) {
            $inputtext .= "<span class=\"help-block\">{$param['help']}</span>\n";
        }

        $inputtext .= "</div>\n";

        return($inputtext);
    }

    /* Mebuata Input Select */
    public function inputSelect($param = array(), $items = array())
    {
        $default = array(
            'id' => null, 'class' => null, 'label' => null, 'name' => null, 'mandatory' => false, 'options' => null
        );
        $param = array_merge($default, $param);
        $inputselect = "<div class=\"md-form form-group\">\n";

        $inputselect .= "<select class=\"mdb-select\" id=\"{$param['id']}\" name=\"{$param['name']}\" {$param['options']}>\n";

        /* Items select */
        if (!empty($items)) {
            foreach($items as $item){
                $inputselect .= "<option value=\"{$item['value']}\">{$item['title']}</option>";
            }
        }

        $inputselect .= "</select>\n";
        
        /* Inputan sangat penting */
        if ($param['mandatory'] === true) {
            $inputselect .= "<label for=\"{$param['id']}\">{$param['label']} <span class=\"text-danger\">*</span></label>\n";
        } else {
            $inputselect .= "<label for=\"{$param['id']}\">{$param['label']}</label>\n";
        }

        $inputselect .= "</div>\n";

        return($inputselect);
    }

    /**
     * Fungsi ini digunakan untuk membuat input select no option
     * Setiap parameter harus di tulis saat pemanggilan function
     *
    */
    public function inputSelectNoOpt($param = array())
    {
        $default = array(
            'id' => null, 'class' => null, 'label' => null, 'name' => null, 'mandatory' => false, 'options' => null
        );
        $param = array_merge($default, $param);
        $inputselect = "<div class=\"md-form form-group\">\n";
        if ($param['mandatory'] === true) {
            $inputselect .= "<label for=\"{$param['id']}\">{$param['label']} <span class=\"text-danger\">*</span></label>\n";
        } else {
            $inputselect .= "<label for=\"{$param['id']}\">{$param['label']}</label>\n";
        }
        $inputselect .= "<select class=\"mdb-select\" id=\"{$param['id']}\" name=\"{$param['name']}\" {$param['options']}>\n";
        return($inputselect);
    }

    /**
     * Fungsi ini digunakan untuk membuat akhir dari input select no option
     *
    */
    public function inputSelectNoOptEnd()
    {
        $end = "</select>\n";
        $end .= "</div>\n";
        return($end);
    }

    /* Membuat inputan radio */
    public function inputRadio($param = array(), $item = array(), $inline = false)
    {
        $default = array(
            'label' => null, 'mandatory' => null
        );
        $param = array_merge($default, $param);
        if ($inline == true) {
            $radioinline = "radio-inline";
        } else {
            $radioinline = "";
        }
        $inputradio = "<div class=\"form-group\">\n";
        $inputradio .= "<div class=\"row\">\n";
        if ($param['mandatory'] === true) {
            $inputradio .= "<label class=\"col-md-3\">{$param['label']} <span class=\"text-danger\">*</span></label>\n";
        } else {
            $inputradio .= "<label class=\"col-md-3\">{$param['label']}</label>\n";
        }
        $inputradio .= "<div class=\"col-md-9\">\n";
        $noitem = 1;
        foreach($item as $itm){
            $inputradio .= "<div class=\"radio {$radioinline}\">\n";
            $inputradio .= "<input type=\"radio\" name=\"{$itm['name']}\" id=\"{$itm['id']}-{$noitem}\" value=\"{$itm['value']}\" {$itm['options']} />\n";
            $inputradio .= "<label for=\"{$itm['id']}-{$noitem}\">{$itm['title']}</label>\n";
            $inputradio .= "</div>\n";
            $noitem++;
        }
        $inputradio .= "</div>\n";
        $inputradio .= "</div>\n";
        $inputradio .= "</div>\n";
        return($inputradio);
    }

    /* Membuat inputan Checkbox */
    public function inputCheckbox($param = array(), $item = array(), $inline = false)
    {
        $default = array(
            'label' => null, 'mandatory' => null
        );
        $param = array_merge($default, $param);

        if ($inline == true) {
            $checkinline = "checkbox-inline";
        } else {
            $checkinline = "";
        }
        $inputcheck = "<div class=\"form-group\">\n";
        $inputcheck .= "<div class=\"row\">\n";

        /* Inputan penting */
        if ($param['mandatory'] === true) {
            $inputcheck .= "<label class=\"col-md-3\">{$param['label']} <span class=\"text-danger\">*</span></label>\n";
        } else {
            $inputcheck .= "<label class=\"col-md-3\">{$param['label']}</label>\n";
        }

        $inputcheck .= "<div class=\"col-md-9\">\n";
        $noitem = 1;
        foreach($item as $itm){
            $inputcheck .= "<div class=\"checkbox {$checkinline}\">\n";
            $inputcheck .= "<input type=\"checkbox\" name=\"{$itm['name']}\" id=\"{$itm['id']}-{$noitem}\" value=\"{$itm['value']}\" {$itm['options']} />\n";
            $inputcheck .= "<label for=\"{$itm['id']}-{$noitem}\">{$itm['title']}</label>\n";
            $inputcheck .= "</div>\n";
            $noitem++;
        }
        $inputcheck .= "</div>\n";

        $inputcheck .= "</div>\n";
        $inputcheck .= "</div>\n";

        return($inputcheck);
    }

    /* Membuat tombol submit */
    public function formSubmit($param = array())
    {
        $default = array(
            'id' => null, 'class' => null, 'name' => null, 'value' => null, 'icon' => null, 'options' => null
        );
        $param = array_merge($default, $param);
        
        if ($param['icon'] === false) {
            $submit = "<button type=\"submit\" class=\"btn {$param['class']}\" id=\"{$param['id']}\" name=\"{$param['name']}\" {$param['options']}>{$param['value']}</button>\n";
        } else {
            $submit = "<button type=\"submit\" class=\"btn {$param['class']}\" id=\"{$param['id']}\" name=\"{$param['name']}\" {$param['options']}><i class=\"{$param['icon']}\"></i> {$param['value']}</button>\n";
        }

        return($submit);
    }
    
    // Membuat Tombol Aksi
    public function formAction($color_btn_left = 'btn-primary', $color_btn_right = 'btn-danger' )
    {
        $action = "<div class=\"form-group\">\n";
        $action .= "<button type=\"submit\" class=\"btn {$color_btn_left}\"><i class=\"fa fa-check\"></i> Selesai</button>\n";
        $action .= "<button type=\"reset\" class=\"btn {$color_btn_right} pull-right\" onclick=\"self.history.back()\"><i class=\"fa fa-times\"></i> Batal</button>\n";
        $action .= "</div>\n";
        return($action);
    }
}