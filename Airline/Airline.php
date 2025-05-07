<?php
include_once "../includes/Database.php";

class Airline {
  private $db;

    public function __construct() {
    $this->db = new Database();
    session_start();
  }
}