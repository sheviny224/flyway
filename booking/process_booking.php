<?php
require_once "../booking/Booking.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (
        isset($_POST['schedule_id'], $_POST['name'], $_POST['email'], $_POST['seat_type']) &&
        !empty($_POST['name']) &&
        !empty($_POST['email']) &&
        in_array($_POST['seat_type'], ['economy', 'business']) // veiligheid check
    ) {
        $schedule_id = $_POST['schedule_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $seat_type = $_POST['seat_type'];

        // boekingsobject maken
        $booking = new Booking();
        $success = $booking->insertBooking($schedule_id, $name, $email, $seat_type);

        if ($success) {
            echo " Boekingsverzoek succesvol verstuurd!";
               $lastInsertId = $booking->getLastInsertId();  
    
    header("Location: ../booking/booking_success.php?id=$booking_id" . $lastInsertId);

    exit;
            
        } else {
            echo " Er is iets misgegaan met het boeken van de vlucht.";
        }
    } else {
        echo " Vul alle velden correct in.";
    }
} else {
    echo " Ongeldige toegangsmethode.";
}