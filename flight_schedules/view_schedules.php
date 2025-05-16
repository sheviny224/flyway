<?php

require_once "../flight_schedules/Schedule.php";

// hier maak ik schedule object
$schedule = new Schedule();

$flight_schedules = $schedule->getAllSchedules();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/schedule.css">
</head>
<body>

<div class="container">
    <!-- navbar -->
    <div class="navbar">

      <!-- logo -->
      <div class="logo">
        <a href="../home/home.php">
          <img src="../logo/flyway.png" alt="logo" width="125px">
        </a>
      </div>
      <!-- logo -->

      <nav>
        <ul>
          <li><a href="../flight_schedules/view_schedules.php">Vluchten</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="../user/login-user.php">Account</a></li>
        </ul>
      </nav>
    </div>
    <!-- navabar -->

  <h1>Hier kunt u alle vertrekkende vluchten zien</h1>
  
<div class="a">
  <img src="../images_flyway/airplane.png" alt="airplaneicon" width="50px">
   <a href="../flight_schedules/view_schedules.php">vertrek</a>
   <img src="../images_flyway/take-off.png" alt="takeoff" width="50px">
  <a href="../flight_schedules/view_schedules_details.php">aankomst</a>

</div>
 
<div class="vluchten">


 <table>
  <!-- <thead>
    <tr>
      <th>departure_datetime</th>
      <th>destination</th>
    </tr>
  </thead> -->

  <tbody>

  <?php foreach ($flight_schedules as $flight_schedule):?>
    <tr>
      <td><?= htmlspecialchars($flight_schedule['departure_datetime']); ?></td>
      <td><?= htmlspecialchars($flight_schedule['destination']); ?></td>
    </tr>

    <?php endforeach; ?>

  </tbody>
 </table>
</div>
  

</body>
</html>