<?php
require_once "../flight_schedules/Schedule.php";

if (!isset ($_GET['id'])) {
  die ("schedule niet niet gevonden");
}

$schedule = new Schedule();

$scheduleDetail = $schedule->getFlightScheduleById($_GET['id']);

if (!$scheduleDetail) {
  die ("Schedule helaas niet gevonden");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/home.css">
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


<h1> <?= htmlspecialchars($scheduleDetail['destination']); ?></h1>

<div class="details">
  <h4>Vetrekt vanuit <?= htmlspecialchars($scheduleDetail['origin']); ?></h4>
  <h4>Vetrekt op<?= htmlspecialchars($scheduleDetail['departure_datetime']); ?></h4>
  <h4> Komt op<?= htmlspecialchars($scheduleDetail['arrival_datetime']); ?> aan</h4>
  <h4> Nog <?= htmlspecialchars($scheduleDetail['seat_economy']) ; ?> plaatsen</h4>
  <h4>Nog <?= htmlspecialchars($scheduleDetail['seat_business']); ?> Busines plaatsne</h4>

  <a href="../booking/book_flight.php?schedule_id=<?= urlencode($scheduleDetail['schedule_id']); ?>"><button type="submit">Boek nu</button></a>

  
</div>

  
</body>
</html>