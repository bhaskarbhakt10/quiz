<?php

class Database
{
    private $hostname = "localhost";
    //localhost 
    private $username = "root";
    private $password = "";
    private $database = "quiz";
    //stagging 
    // private $username = "u595440997_divine_quiz";
    // private $password = "u595440997_divine_quiz";
    // private $database = 'iqbCb$V34eu9i-P';


    private $conn_string;

    function __construct()
    {
        $this->conn_string = new mysqli($this->hostname, $this->username, $this->password, $this->database);
    }

    function connect()
    {
        return $this->conn_string;
    }

    function close()
    {
        return $this->conn_string->close();
    }
}
