<?php

include "Lines022.php";

// PHP Oop - Constructor. PHP OOP Constructor. (n.d.). Retrieved October 22, 2022, from https://www.w3schools.com/php/php_oop_constructor.asp 
class POs022
{
    //database connection
    private $connection;
    // database table name
    private $tableName = "POs022";
    //table columns
    public $poNo022;
    public $clientID022;
    public $dateOfPO022;
    public $status022;
    public $obj_array;

    // constructor
    public function __construct($database_connection)
    {
        // to assign the database connection = $connection
        $this->connection = $database_connection;
    }

    public function getAllWithClientIDPOs022()
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

    // update parts quantity when user select the part
    public function addToPOs022()
    {
        $sql = "INSERT INTO POs022(poNo022, clientID022, dateOfPO022, status022) VALUES (NULL,'$this->clientID022','$this->dateOfPO022','$this->status022')";
        if ($this->connection->query($sql) === TRUE) {
            $lines = new Lines022($this->connection);
            $obj = json_decode($this->obj_array);
            $lines->obj_array022 = $obj;
            $lines->POsNo022 = mysqli_insert_id($this->connection);

            // update the Lines
            if($lines->addToLines022())
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
}
?>