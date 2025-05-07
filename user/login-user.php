<?php
session_start();
include_once "../includes/Database.php";
include_once "../user/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
      $user = new User(); // Creëer User-object

      if (isset($_POST["inloggen"])) {
          $role = $_POST["role"]; // Haal de gekozen rol op
  // als rol gelijk is aan coordinator stuur dan naar coordinator dashboard
          if ($role === "coordinator") {
              $loginCorrect = $user->login($_POST["email"], $_POST["password_hash"]);

              if ($loginCorrect) {
                  header("Location: ../coordinator/dashboard-coordinator.php"); // Stuur naar coordinator dashboard
                  exit();
              }
          } 
          // als rol gelijk is aan admin stuur dan naar admin dashboard
           if ($role === "admin") {
            $loginCorrect = $user->login($_POST["email"], $_POST["password_hash"]);

            if ($loginCorrect) {
                header("Location: ../admin/dashboard-admin.php"); // Stuur naar admin dashboard
                exit();
            }
        }
 
           
          
          // Indien fout, terugsturen naar login
          header("Location: ../user/login-user.php");
          exit();
      }
  } catch (Exception $error) {
      echo "Error login-user:" . $error;
  }
}


?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Formulier</title>
  <link rel="stylesheet" href="../css/register.css">
  
</head>
<body>

  <!-- logo -->
  <div class="logo">
        <a href="../home/home.php">
          <img src="../logo/flyway.png" alt="logo" width="125px">
        </a>
      </div>
      <!-- logo -->
  

<div class="form-container">
    <div class="form-content">
      <div class="plane">
        <img src="../images_flyway/plane-picture.jpg" alt="sundown">
      </div> 

      <form action="" method="post">
        <div class="form-groep">
          <h1>Welkom terug!</h1>

          <div class="form-groep">
         <label for="role">Inloggen als:</label>
         <select id="role" name="role">

         <option value="coordinator">Coordinator</option>
         <option value="admin">Admin</option>
          </select>
           </div>


          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Voer je email in" required>
        </div>

        <div class="form-groep">
          <label for="password_hash">Wachtwoord:</label>
          <input type="password" id="password_hash" name="password_hash" placeholder="Voer je wachtwoord in" required>
        </div>

        <button type="submit" name="inloggen">Inloggen</button>

      </form>
    </div>
  </div>
</body>
</html>

