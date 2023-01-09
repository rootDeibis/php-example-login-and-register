<?php 

class Database {


    private $host;
    private $user;
    private $pass;
    private $db;

    function __construct($host, $user, $pass, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
    }


    function getConnection() {

        try {
            return new mysqli($this->host, $this->user, $this->pass, $this->db);
        } catch (\Throwable $th) {
            header('location: /maintenance');
        }
    }
        

}

?>