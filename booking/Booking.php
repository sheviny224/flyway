<?php
require_once "../includes/Database.php";

class Booking {
  private $db;
  public function __construct() {
    $this->db = new Database();
    session_start();
  }


public function insertBooking($schedule_id, $name, $email, $seat_type) {
  $sql = "INSERT INTO booking (schedule_id, name, email, seat_type)
          VALUES (:schedule_id, :name, :email, :seat_type)";

  $params = [
    ":schedule_id" => $schedule_id,
    ":name" => $name,
    ":email" => $email,
    ":seat_type" => $seat_type
  ];

  return $this->db->run($sql, $params);
}

public function getBookingById($booking_id) {
    $sql = "SELECT * FROM booking WHERE booking_id = :booking_id";
    $stmt = $this->db->run($sql, [':booking_id' => $booking_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function getLastInsertId() {
    return $this->db->lastInsertId();
}



}

