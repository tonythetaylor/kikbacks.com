<?php

class Database
{
private $DB_Host = "";
private $DB_Name = "";
private $DB_Username = "";
private $DB_Password = "";

public $conn;

    public function dbConnection()
        {

            $this->conn = null;
        try
                {
            $this->conn = new PDO("mysql:host=" . $this->DB_Host . ";dbname=" . $this->DB_Name, $this->DB_Username, $this->DB_Password);
                        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
                catch(PDOException $exception)
                {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
