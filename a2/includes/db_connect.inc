<?php
//db_connect.inc


//Check what server you are accessing
if (strstr($_SERVER['SERVER_NAME'], 'localhost')) {
  ini_set('display_errors', 1); 
  error_reporting(E_ALL);
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "skillswap";
} else {
  $servername = "talsprddb02.int.its.rmit.edu.au";
  $username = "s4165917";
  include("/home/sl7/S4165917/public_html/.htdb_pass");
  $dbname = "s4165917";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  //echo "Database connected, good to go!";
}


