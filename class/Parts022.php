<?php

// PHP Oop - Constructor. PHP OOP Constructor. (n.d.). Retrieved October 22, 2022, from https://www.w3schools.com/php/php_oop_constructor.asp 
class Parts022
{
    //database connection
    private $connection;
    // database table name
    private $tableName = "Parts022";
    //table columns
    public $partNo022;
    public $partName022;
    public $partDescription022;
    public $partImgs022;
    public $currentPrice022;
    public $Qoh022;

    // constructor
    public function __construct($database_connection)
    {
    // to assign the database connection = $connection
        $this->connection = $database_connection;
    }

   // get all parts and show 
    public function getAllParts022()
    {
        $sql = "SELECT * FROM " . $this->tableName;
        $res = mysqli_query($this->connection,$sql);

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

   // get single part with respect to the ID
    public function getSinglePart022()
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE partNo022 = '$this->partNo022' ";
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
    public function updateParts022()
    {
        $sql = "UPDATE Parts022 SET QoH022='$this->Qoh022' WHERE partNo022='$this->partNo022'";
        if ($this->connection->query($sql) === TRUE) {
            return true;
        }
        return false;
    }
}
?>