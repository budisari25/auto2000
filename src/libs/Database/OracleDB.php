<?php

namespace Racik\Database;

class OracleDB {
    // DB Params
    private $tns = "
        (DESCRIPTION =
            (ADDRESS_LIST =
                (ADDRESS = (PROTOCOL = TCP)(HOST = 10.114.253.35)(PORT = 1521))
            )
            (CONNECT_DATA =
                (SERVICE_NAME = SIMPBB)
            )
        )";
    private $username = "PADUSER"; //user database
    private $password = "sZa5GM85cNnF16Xu"; //pass database
    private $ora;

    // DB Connect
    public function oracleConn()
    {
        $this->ora = null;

        try {
            $this->ora = new \PDO("oci:dbname=".$this->tns,$this->username,$this->password);
            $this->ora->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            $this->ora->setAttribute(\PDO::ATTR_CASE, \PDO::CASE_LOWER);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->ora;
    }
}