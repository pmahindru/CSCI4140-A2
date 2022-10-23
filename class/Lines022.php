<?php
include "User_select_parts022.php";

// https://www.w3schools.com/php/php_oop_constructor.asp
class Lines022
{
    //database connection
    private $connection;
    // database table name
    private $tableName = "Lines022";
    //table columns
    public $obj_array022;
    public $POsNo022;

    // constructor
    public function __construct($database_connection)
    {
    // to assign the database connection = $connection
        $this->connection = $database_connection;
    }

    public function getWithPOsIDLines022()
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE poNo022 = '$this->POsNo022' ";
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
    public function addToLines022()
    {
        $bool = false;
        for ($i=0; $i < sizeof((array) $this->obj_array022); $i++) { 
            $partNo022 = $this->obj_array022[$i]->partNo022;
            $priceOrdered022 = $this->obj_array022[$i]->currentPrice022;
            $QoH022 = $this->obj_array022[$i]->user_select_count022;
            $sql = "INSERT INTO Lines022(lineNo022, poNo022, partNo022, priceOrdered022, QoH022) VALUES (NULL,'$this->POsNo022','$partNo022','$priceOrdered022','$QoH022')";
            if ($this->connection->query($sql) === TRUE) 
            {
                $bool = true;
            }
            else
            {
                $bool = false;
            }
        }

        if ($bool === TRUE) {
            $user_select_parts = new user_select_parts022($this->connection);
            $user_select_parts->clientID022 = $this->obj_array022[0]->clientID022;
            if ($user_select_parts->deleteWithClientIDUserSelectParts022() === TRUE) 
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