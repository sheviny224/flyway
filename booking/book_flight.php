<?php
if (!isset($_GET['schedule_id'])) {
  die("Geen vlucht geselecteerd.");
}

$schedule_id = $_GET['schedule_id'];
?>

<form action="process_booking.php" method="POST">
  <input type="hidden" name="schedule_id" value="<?= htmlspecialchars($schedule_id) ?>">

  <label>Naam:</label>
  <input type="text" name="name" required>

  <label>E-mail:</label>
  <input type="email" name="email" required>

  <label>Stoeltype:</label>
  <select name="seat_type" required>
    <option value="economy">Economy</option>
    <option value="business">Business</option>
  </select>

  <button type="submit">Boek vlucht</button>
</form>
