<?php

include "Parts022.php";
include "Clients022.php";

// PHP Oop - Constructor. PHP OOP Constructor. (n.d.). Retrieved October 22, 2022, from https://www.w3schools.com/php/php_oop_constructor.asp 
class user_select_parts022
{
    //database connection
    private $connection;
    // database table name
    private $tableName = "user_select_parts022";
    //table columns
    public $ID022;
    public $clientID022;
    public $partNo022;
    public $partQoh022;
    public $user_count;

    // constructor
    public function __construct($database_connection)
    {
    // to assign the database connection = $connection
        $this->connection = $database_connection;
    }

   // insert in the user_select_parts022 table and also update the Parts quantity
    public function addUserSelectParts022()
    {
        $userCount = $this->user_count + 1; 
        $sql = "INSERT INTO user_select_parts022 (ID022, clientID022, partNo022, user_count) VALUES (NULL,'$this->clientID022','$this->partNo022','$userCount')";
        if ($this->connection->query($sql) === TRUE) {
            $parts = new Parts022($this->connection);
            // assign the part no and part quantity 
            $parts->partNo022 = $this->partNo022;
            $updateQoh = $this->partQoh022 - 1;
            $parts->Qoh022 = $updateQoh;
            // update the part
            if($parts->updateParts022())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return false;
    }

    // delete in the user_select_parts022 table and also update the Parts quantity
    public function subUserSelectParts022()
    { 
        $sql = "DELETE FROM user_select_parts022 WHERE clientID022 = '$this->clientID022' AND partNo022 = '$this->partNo022' AND user_count = '$this->user_count' ";
        if ($this->connection->query($sql) === TRUE) {
            $parts = new Parts022($this->connection);
            // assign the part no and part quantity 
            $parts->partNo022 = $this->partNo022;
            $updateQoh = $this->partQoh022 + 1;
            $parts->Qoh022 = $updateQoh;
            // update the part
            if($parts->updateParts022())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return false;
    }

    public function deleteWithClientIDUserSelectParts022()
    { 
        $sql = "DELETE FROM user_select_parts022 WHERE clientID022 = '$this->clientID022'";
        if ($this->connection->query($sql) === TRUE) {
            $clientUpdate = new Clients022($this->connection);
            $clientUpdate->clientID022 = $this->clientID022;
            if($clientUpdate->updateMoney())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return false;
    }

    // get all with the client id what they select parts
    public function getUserSelectPart022()
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE clientID022 = '$this->clientID022' ";
        $res = mysqli_query($this->connection, $sql);
        // adding all the data in the array
        $array = array();
        $index = 0;
        while($row = mysqli_fetch_assoc($res)){
            $array[$index] = $row; 
            $index = $index + 1;
        }
        $json_object = new stdClass();
        $getTableName = $this->tableName;
        $json_object->$getTableName = $array;

        return $json_object;
    }
}
?>