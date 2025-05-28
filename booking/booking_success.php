<?php
require_once "../booking/Booking.php";

if (!isset($_GET['id'])) {
    die("Geen boeking geselecteerd.");
}

$booking = new Booking();
$bookingData = $booking->getBookingById($_GET['id']);

if (!$bookingData) {
    die("Boeking niet gevonden.");
}
?>

<h1>Boeking succesvol!</h1>

<p>Vlucht ID: <?= htmlspecialchars($bookingData['schedule_id']); ?></p>
<p>Naam: <?= htmlspecialchars($bookingData['name']); ?></p>
<p>E-mail: <?= htmlspecialchars($bookingData['email']); ?></p>
<p>Stoeltype: <?= htmlspecialchars($bookingData['seat_type']); ?></p>

