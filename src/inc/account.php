<?php 




class Account {


    private $username;
    private $database;

    function __construct($username, $db) {
        $this->username = $username;
        $this->database = $db->getConnection();

        $this->getUserData();
    }


    function login($password) {

        $user = $this->getUserData();


        if($user == null) {
            return 'There is no user with this name.';
        }

        if(!password_verify($password, $user['password'])) {
            return 'Password is incorrect.';
        }
        
    }

    function register($password) {
        $user = $this->getUserData();

        if(!empty($user)) {
            return 'Username has already registered!';
        }

        $user = $this->username;
        $password = password_hash($password, PASSWORD_BCRYPT);

        $this->database->query("INSERT INTO users (username, password) VALUES ('$user', '$password')");


    }

    private function getUserData() {
        $result = $this->database->query("SELECT * from users WHERE username='" . $this->username . "'");

        $result->data_seek(1);
        $row = $result->fetch_assoc();

        if(empty($row)) {
            return null;
        } else {
            return $row;
        }

    }


    public static function isLogged() {

        if (session_id() == null)
            return false;

        if (!isset($_SESSION['logged']))
            return false;

        return true;


    }


    public static function set($key, $value) {
        if(session_id() != null)
            $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if(!isset($_SESSION[$key])) {
            return "Undefined key: $key";
        } else {
            return $_SESSION[$key];
        }
    }

    public static function logout() {
        session_destroy();
    }


     
}

?>