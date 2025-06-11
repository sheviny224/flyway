<?php
include_once "../flight_schedules/Schedule.php";
include_once "../user/User.php";
include_once "../Flight/Flight.php";
include_once "../booking/Booking.php";


// session_start();

$user = new User();

// schedule object
$schedule = new Schedule();

// flight object
$flight = new Flight();

// hier haal ik de methode uit de flight class op
$flight_ids = $flight->getAllFlightId();
$booking = new Booking ();
// check of user is ingelogd
if (!$user->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$bookings = $booking->getAllBookings();

$email = $_SESSION["email"];

// als form wordt verzonden voer querys uit

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $flight_id = $_POST['flight_id'] ?? '';
    $origin = $_POST['origin'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $departure_datetime = $_POST['departure_datetime'] ?? '';
    $arrival_datetime = $_POST['arrival_datetime'] ?? '';
    $seat_economy = $_POST['seat_economy'] ?? '';
    $seat_business = $_POST['seat_business'] ?? '';

    if ($schedule->insertSchedule($flight_id, $origin, $destination, $departure_datetime, $arrival_datetime, $seat_economy, $seat_business)) {
        $message = "Vluchtschema succesvol toegevoegd!";
    } else {
        $message = "Toevoegen mislukt.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Coördinator</title>
  <link rel="stylesheet" href="../css/coordinator.css">
</head>
<body>
  <h1>Welkom  <?= htmlspecialchars($email)  ?> !</h1>


  <div class="uitloggen">
    <li><a href="../user/logout.php">uitloggen</a></li>

  </div>

  <?php if (!empty($message)): ?>
      <p><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <h2>Voeg een vluchtschema toe</h2>
  <form action="" method="POST">
  <label for="flight_id">Vlucht:</label>

  <!-- hier haal ik de "flight_ids" dynamisch op uit de fliught tabel -->
  <label for="flight_id">Vlucht:</label>
<select name="flight_id" required>
  <?php foreach ($flight_ids as $flight): ?>
    <option value="<?= htmlspecialchars($flight['flight_id']); ?>">
      <?= htmlspecialchars($flight['flight_id']); ?>
    </option>
  <?php endforeach; ?>
</select><br>
    



  <label for="origin">Vertrekplaats:</label>
  <input type="text" name="origin" required><br>

  <label for="destination">Bestemming:</label>
  <input type="text" name="destination" required><br>

  <label for="departure_datetime">Vertrektijd:</label>
  <input type="datetime-local" name="departure_datetime" required><br>

  <label for="arrival_datetime">Aankomsttijd:</label>
  <input type="datetime-local" name="arrival_datetime" required><br>

  <label for="seat_economy">Economy stoelen:</label>
  <input type="number" name="seat_economy" value="100"><br>

  <label for="seat_business">Business stoelen:</label>
  <input type="number" name="seat_business" value="20"><br>

  <button type="submit">Schedule toevoegen</button>
</form>


  <h1>Alle boekingen</h1>
   <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr>
        <th>schedule_id</th>
        <th>name</th>
        <th>email</th>
        <th>seat_type</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bookings as $booking): ?>
        <tr>
          <td><?= htmlspecialchars($booking['schedule_id']); ?></td>
          <td><?= htmlspecialchars($booking['name']); ?></td>
          <td><?= htmlspecialchars($booking['email']); ?></td>
          <td><?= htmlspecialchars($booking['seat_type']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
