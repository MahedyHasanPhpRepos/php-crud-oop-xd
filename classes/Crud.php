<?php

include('../interfaces/CrudInterface.php');
include('./DbConfig.php');

class Crud extends DbConfig implements CrudInterface
{
    public $buyer;
    public $buyer_email;
    public $phone;
    public $city;
    // public $buyer_ip;
    public $receipt_id;
    public $items;
    public $amount;
    public $note;
    // public $entry_at;
    public $entry_by;


    public function display()
    {
        echo "display";
    }


    public function read()
    {
        $stmt = $this->connection->prepare("select * from Buyers order by id desc");
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }


    public function create()
    {
        $entry_at = $this->getLocalTimeWithZone();
        $buyer_ip = $this->getClientIpAddress();

        try {

            $sql_query = "insert into Buyers (buyer , buyer_email , phone , city , buyer_ip , receipt_id , items , amount , note , entry_at , entry_by) 
                values (:buyer , :buyer_email , :phone , :city , :buyer_ip , :receipt_id , :items , :amount , :note , :entry_at ,  :entry_by)";

            $stmt = $this->connection->prepare($sql_query);

            $buyer = $this->sanitize_data($this->buyer);
            $buyer_email = $this->sanitize_data($this->buyer_email);

            $phone = $this->sanitize_data($this->phone);
            $city = $this->sanitize_data($this->city);


            $receipt_id = $this->sanitize_data($this->receipt_id);
            $items = $this->sanitize_data($this->items);

            $amount = $this->sanitize_data($this->amount);
            $note = $this->sanitize_data($this->note);
            $entry_by = $this->sanitize_data($this->entry_by);

            $buyer_ip = $buyer_ip;
            $entry_at = $entry_at;

            $stmt->bindParam(':buyer', $buyer);
            $stmt->bindParam(':buyer_email', $buyer_email);
            $stmt->bindParam(':phone', $phone);

            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':receipt_id', $receipt_id);
            $stmt->bindParam(':items', $items);
            $stmt->bindParam(':amount', $amount);

            $stmt->bindParam(':note', $note);
            $stmt->bindParam(':entry_by', $entry_by);
            $stmt->bindParam(':buyer_ip', $buyer_ip);
            $stmt->bindParam(':entry_at', $entry_at);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error Message: " . $e->getMessage();
        }
    }


    public function show($id)
    {
        try {
            $sql_query = "select * from Users where id = :id";
            $stmt = $this->connection->prepare($sql_query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            echo "Error Message: " . $e->getMessage();
        }
    }
    public function update($id)
    {
        // echo $id ; 

        try {

            $sql_query = "update Users 
            set 
            name = :name,
            email = :email ,
            age = :age
            where id = :id";
            $stmt = $this->connection->prepare($sql_query);

            $name = $this->sanitize_data($this->name);
            // $age = $this->sanitize_data($this->age);
            $email = $this->sanitize_data($this->email);

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":age", $age);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error Message: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $sql_query = "delete from Buyers where id = :id";
            $stmt = $this->connection->prepare($sql_query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error Message: " . $e->getMessage();
        }
    }

    function getLocalTimeWithZone()
    {
        $client_timezone = isset($_SERVER['HTTP_TIME_ZONE']) ? $_SERVER['HTTP_TIME_ZONE'] : 'UTC';
        $datetime = new DateTime('now', new DateTimeZone($client_timezone));
        $datetime->setTimezone(new DateTimeZone('UTC'));
        $formatted_datetime = $datetime->format('Y-m-d H:i:s');
        return $formatted_datetime;
    }

    function getClientIpAddress()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }
        return $ipaddress;
    }


    public function sanitize_data($data)
    {
        $trimmed_data    = trim($data);
        $str_splash_data = stripslashes($trimmed_data);
        $html_chars_data = htmlspecialchars($str_splash_data);
        return $html_chars_data;
    }
}
