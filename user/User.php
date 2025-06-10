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
   public function register($role, $name, $email, $password_hash, $address, $phone) {
    try {
        $db = new Database();
        $pdo = $db->pdo;

        $sql = "INSERT INTO users (role, name, email, password_hash, address, phone)
                VALUES (:role, :name, :email, :password_hash, :address, :phone)";
        $stmt = $pdo->prepare($sql);

        $hashed_password = password_hash($password_hash, PASSWORD_DEFAULT);

        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $hashed_password);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);

        if ($stmt->execute()) {
            echo "Registratie gelukt!";
        } else {
            echo "Registratie mislukt!";
        }
    } catch (PDOException $e) {
        echo "Database fout: " . $e->getMessage();
    }
}


     public function updateCoordinator($user_id, $name, $email, $password, $address, $phone) {
        $sql = "UPDATE users SET name = :name, email = :email, address = :address, phone = :phone";
        if (!empty($password)) {
            $sql .= ", password_hash = :password_hash";
        }
        $sql .= " WHERE user_id = :user_id AND role = 'coordinator'";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':user_id', $user_id);
        if (!empty($password)) {
            $stmt->bindParam(':password_hash', password_hash($password, PASSWORD_DEFAULT));
        }

        return $stmt->execute();
    }

    public function getUserByName($name) {
        $sql = "SELECT name FROM users WHERE name = :name";
        $params = [':name' => $name];
        return $this->db->run($sql, $params)->fetch();
    }

    // methode om alle coordinators uit de tabel de halen
   public function getAllCoordinator() {
    $sql = "SELECT user_id, name, role, email, address, phone FROM users WHERE role = :role";
    $params = [':role' => 'coordinator'];
    return $this->db->run($sql, $params)->fetchAll();
}

public function getUserById($id) {
    try {
        $sql = "SELECT * FROM users WHERE user_id = :id AND role = 'coordinator'";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Fout bij ophalen gebruiker: " . $e->getMessage();
        return null;
    }
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