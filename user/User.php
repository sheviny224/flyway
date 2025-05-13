<?php
include_once "../includes/Database.php";

class User
{
    private $db;

    public function __construct() {
        $this->db = new Database(); // Creer Database object in user class constructer
        session_start(); //Start session in __construct voor elk niew user
    }

    // registreer user 
    public function register($role, $name, $email, $password_hash, $address, $contact_phone, $created_at) {
        try {
            $db = new Database();
            $pdo = $db->pdo;
    
            $sql = "INSERT INTO users (role, name, email, password_hash, address, contact_phone, created_at VALUES (:role, :name, :email, :password_hash, :address, :contact_phone, :created_at)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password_hash', password_hash($password_hash, PASSWORD_DEFAULT));
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':contact_phone', $contact_phone);
            $stmt->bindParam(':created_at ', $created_at );
            
    
            if ($stmt->execute()) {
                echo "Registratie gelukt!";
            } else {
                echo "Registratie mislukt!";
            }
        } catch (PDOException $e) {
            echo "Database fout: " . $e->getMessage();
        }
    }

    public function getUserByName($name) {
        $sql = "SELECT name FROM users WHERE name = :name";
        $params = [':name' => $name];
        return $this->db->run($sql, $params)->fetch();
    }

    public function getUserByEmail ($email) {
        $sql = "SELECT email FROM users WHERE email = :email";
        $params = [':email' => $email];
        return $this->db->run($sql, $params)->fetchAll();
    }

    public function login($email, $password_hash)
    {
        $userDB = $this->db->run("SELECT * FROM users WHERE email = :email", [
            ':email' => $email])->fetch(); // haal info van de  pdostatement object
        

        if ($userDB && password_verify($password_hash, $userDB['password_hash'])) {
            // Store user data in session  
            $_SESSION["email"] = $userDB["email"];
            return true;
        } else {
            return false;
        }
    }

    public function coordinatorlogin($email, $password_hash)
    {
        $coordinatorDB = $this->db->run("SELECT * FROM medewerkers WHERE email = :email", [
            ':email' => $email])->fetch(); // haal info van de  pdostatement object
        

        if ($coordinatorDB && password_verify($password_hash, $coordinatorDB['password_hash'])) {
            
            $_SESSION["email"] = $coordinatorDB["email"];
            return true;
        } else {
            return false;
        }
    }
  
  
    public function logout()
    {
        // log uit
        session_unset();
        session_destroy();
    }

    // check of een  session aan het  runnen is (true/false)
    public function isLoggedIn()
    {
        return isset($_SESSION['email']);
    }

    
}