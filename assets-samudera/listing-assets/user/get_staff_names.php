<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it_notes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve staff names matching the input query
$input = $_GET["term"];
$sql = "SELECT `staf_name` FROM `tbl_staf` WHERE `staf_name` LIKE '%$input%'";
$result = $conn->query($sql);

$staff_names = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $staff_names[] = $row["staf_name"];
  }
}

$conn->close();

// Return JSON encoded data
echo json_encode($staff_names);
