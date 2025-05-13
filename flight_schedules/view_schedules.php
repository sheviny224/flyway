<?php
include_once "../flight_schedules/Schedule.php";

// hier maak ik schedule object
$schedule = new Schedule();

$flight_schedule = $schedule->getAllSchedules();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>
<body>
  <h1>Hier kunt u alle beschikbare vluchten zien</h1>

  

</body>
</html>