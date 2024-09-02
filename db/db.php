<?php
class Database
{
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct()
    {
        $config = include("./db/config.php");
        $this->username = $config["username"];
        $this->hostname = $config["hostname"];
        $this->password = $config["password"];
        $this->dbname = $config["dbname"];
    }

    public function createConnection()
    {
        try {
            $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
            return $this->conn;
        } catch (\Throwable $th) {
            echo ($th);
        }
    }
}
