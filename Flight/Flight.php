<?php
include_once "../includes/Database.php";

class Flight {
  private $db;

  public function __construct() {
      $this->db = new Database(); // creer database object
      // session_start(); // start session
  }

  // hier maak ik een function inserflight om vluchten makkelijk toe te voegen aan mijn database
  public function insertFlight($airline_id, $flight_number, $aircraft_type, $duration_minutes, $services) {
    $sql = "INSERT INTO flights (airline_id, flight_number, aircraft_type, duration_minutes, services)
     VALUES (:airline_id, :flight_number, :aircraft_type, :duration_minutes, :services)";

     $params = [
      ':airline_id' => $airline_id,
      ':flight_number' => $flight_number,
      ':aircraft_type'=> $aircraft_type,
      ':duration_minutes' => $duration_minutes,
      ':services' => $services
     ];

     return $this->db->run($sql, $params);
  }

// ?hier haal ik aalle vluchten op uit de database
  public function getAlFlight() {
    $sql = "SELECT * FROM flights";

    return $this->db->run($sql)->fetchAll();
  }

  public function getAllFlightId() {
    $sql  = "SELECT flight_id FROM flights";

    return $this->db->run($sql)->fetchAll();
  }
 


}