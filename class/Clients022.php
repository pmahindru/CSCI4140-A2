<?php

// PHP Oop - Constructor. PHP OOP Constructor. (n.d.). Retrieved October 22, 2022, from https://www.w3schools.com/php/php_oop_constructor.asp 
class Clients022
{
    //database connection
    private $connection;
    // database table name
    private $tableName = "Clients022";
    //table columns
    public $clientID022;
    public $clientName022;
    public $clientCity022;
    public $clientCompPassword022;
    public $dollarsOnOrder022;
    public $moneyOwed022;
    public $clientStatus022;

    // constructor
    public function __construct($database_connection)
    {
        // to assign the database connection = $connection
        $this->connection = $database_connection;
    }

    //this is for the login page to show all the clients
    public function getAllClients022()
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
        // make the object
        $json_object = new stdClass();
        $getTableName = $this->tableName;
        // assign array to object 
        $json_object->$getTableName = $array;

        // return object
        return $json_object;
    }

    // get the client info with respect to the client ID for the account page
    public function getSingleClient022()
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

        // make the object
        $json_object = new stdClass();
        $getTableName = $this->tableName;
        // assign array to object 
        $json_object->$getTableName = $array;

        // return object
        return $json_object;
    }

    // this is used for the add new client
    public function addToClient022()
    {
        $sql = "INSERT INTO Clients022 (clientID022, clientName022, clientCity022, clientCompPassword022, dollarsOnOrder022, moneyOwed022, clientStatus022) VALUES (NULL, '$this->clientName022','$this->clientCity022','$this->clientCompPassword022','$this->dollarsOnOrder022', '$this->moneyOwed022', '$this->clientStatus022')";
        if ($this->connection->query($sql) === TRUE) {
            return true;
        }
        return false;
    }

    // this is used to update money 
    public function updateMoney()
    {
        $getvalue = json_decode(file_get_contents("https://web.cs.dal.ca/~mahindru/CSCI4140/A2/APIs/ClientsAPI/readSingleClient022.php/?clientID022=$this->clientID022"));
        $dollarsOnOrder022 = $getvalue->Clients022[0]->dollarsOnOrder022;
        $moneyOwed022 = $getvalue->Clients022[0]->moneyOwed022;
        if ($dollarsOnOrder022 >= $moneyOwed022) 
        {
            $dollarsOnOrder022 = $dollarsOnOrder022 - $moneyOwed022;
            $sql = "UPDATE Clients022 SET dollarsOnOrder022 = '$dollarsOnOrder022', moneyOwed022 = 0.00 WHERE clientID022 = '$this->clientID022'";
            if ($this->connection->query($sql) === TRUE) {
                return true;
            }
            return false;
        }
        else if ($dollarsOnOrder022 <= $moneyOwed022) {
            $moneyOwed022 = $moneyOwed022 - $dollarsOnOrder022;
            $sql = "UPDATE Clients022 SET dollarsOnOrder022 = 0.00, moneyOwed022 = '$moneyOwed022' WHERE clientID022 = '$this->clientID022'";
            if ($this->connection->query($sql) === TRUE) {
                return true;
            }
            return false;
        }
    }
}
?>