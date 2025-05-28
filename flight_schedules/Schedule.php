<?php
include_once "../includes/Database.php";

class Schedule {
  private $db;

    public function __construct() {
    $this->db = new Database();
    // session_start();
  }

  public function insertSchedule($flight_id, $origin, $destination, $departure_datetime, $arrival_datetime, $seat_economy, $seat_business) {
    $sql = "INSERT INTO flight_schedules (flight_id, origin, destination, departure_datetime, arrival_datetime, seat_economy, seat_business)
     VALUES (:flight_id, :origin, :destination, :departure_datetime, :arrival_datetime, :seat_economy, :seat_business) ";

$params = [
  ':flight_id' => $flight_id,
  ':origin' => $origin,
  ':destination' => $destination,
  ':departure_datetime' => $departure_datetime,
  ':arrival_datetime' => $arrival_datetime,
  ':seat_economy' => $seat_economy,
  ':seat_business' => $seat_business
];

     return $this->db->run($sql,$params);
  }

  public function getAllSchedules() {
    $sql = "SELECT * FROM flight_schedules";

    return $this->db->run($sql)->fetchAll();
  }

  public function getAllSchedulesId() {
    $sql = "SELECT flight_id FROM flight_schedules";

    return $this->db->run($sql)->fetchAll();
  }

  public function getFlightScheduleById($schedule_id) {
    $sql = "SELECT * FROM flight_schedules WHERE schedule_id = :schedule_id";
    $params = ["schedule_id" => $schedule_id];

    $stmt = $this->db->run($sql, $params);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
  }

}