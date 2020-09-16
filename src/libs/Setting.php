<?php

namespace Racik;

use Racik\Database\MySQL as DB;

class Setting extends DB
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new \FluentPDO($this->connect());
    }

    private function config()
    {
        $sql = $this->pdo->from('setting')->fetchAll();
        $val = null;
        foreach ($sql as $row) {
            $val[$row['options']] = $row['value'];
        }        
        return $val;
    }

    public function site($name)
    {
        $config = $this->config();
        if(isset($config[$name])){
            return $config[$name];
        } else {
            return false;
        }
    }    
}
