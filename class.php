<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'test');

class DB {
    private $con;
    
    public function __construct() {
        $this->con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }
    
    public function getConnection() {
        return $this->con;
    }
}

class User {
    private $db;
    
    public function __construct() {
        $this->db = new DB;
    }
    
    public function register($trn_date, $name, $username, $email, $pass) {
        $pass = md5($pass);
        $con = $this->db->getConnection();
        $checkuser = $con->query("SELECT id FROM users WHERE email='$email'");
        $result = $checkuser->num_rows;
        
        if ($result == 0) {
            $register = $con->query("INSERT INTO users (trn_date, name, username, email, password) VALUES ('$trn_date','$name','$username','$email','$pass')");
            
            return $register;
        } else {
            return false;
        }
    }
    
    public function login($email, $pass) {
        $pass = md5($pass);
        $con = $this->db->getConnection();
        $check = $con->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
        $data = $check->fetch_array();
        $result = $check->num_rows;
        
        if ($result == 1) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $data['id'];
            
            return true;
        } else {
            return false;
        }
    }
    
    public function session() {
        if (isset($_SESSION['login'])) {
            return $_SESSION['login'];
        }
    }
    
    public function logout() {
        $_SESSION['login'] = false;
        session_destroy();
    }
    
    public function fullname($id) {
        $con = $this->db->getConnection();
        $query = "SELECT name FROM users WHERE id = $id";
        $result = $con->query($query);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo $row['name'];
        }
    }
}
?>