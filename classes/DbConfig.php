

<?php

use PDO;

class DbConfig
{
    private $db_server = "mysql:dbname=xds; host=localhost";
    private $user_name = "root";
    private $password  = "";
    protected $connection;
    protected $dummy;

    public function __construct()
    {
        try {

            $this->connection = new PDO($this->db_server, $this->user_name, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // $sqlCommand = "create table Buyers(
            //     id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
            //     amount INT(10) NOT NULL,
            //     buyer VARCHAR(255) NOT NULL,
            //     receipt_id VARCHAR(20) NOT NULL,
            //     items VARCHAR(255) NOT NULL,
            //     buyer_email VARCHAR(50) NOT NULL,
            //     buyer_ip VARCHAR(20),
            //     note TEXT,
            //     city VARCHAR(20) NOT NULL,
            //     phone VARCHAR(20) NOT NULL,
            //     entry_at DATE,
            //     entry_by VARCHAR(10) NOT NULL
            // )";
            // $this->connection->exec($sqlCommand) ; 

        } catch (PDOException $e) {
            echo "Error Message: " . $e->getMessage();
            return "Connection failed: " . $e->getMessage();
        }
    }
}

