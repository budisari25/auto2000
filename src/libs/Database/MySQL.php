<?php

namespace Racik\Database;

class MySQL {
    // DB parameter
    protected $host = DB_HOST;
    protected $user = DB_USER;
    protected $pass = DB_PASS;
    protected $db = DB_NAME;
    protected $conn;

    public function connect()
    {
        $this->conn = null;

        try{
            $this->conn = new \PDO('mysql:host='. $this->host . ';dbname=' . $this->db, $this->user, $this->pass);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }

    public function closing()
    {
        $this->conn = null;
    }
}