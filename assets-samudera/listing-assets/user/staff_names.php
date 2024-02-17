<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "it_notes";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$term = $_GET['term'];
$query = "SELECT staff_id, staf_name FROM tbl_staf WHERE staf_name LIKE ?";
$stmt = $conn->prepare($query);
$term = '%' . $term . '%';
$stmt->bind_param("s", $term);
$stmt->execute();

$result = $stmt->get_result();
$staff_data = array();
while ($row = $result->fetch_assoc()) {
    $staff_data[] = array(
        'id' => $row['staff_id'],   // Include staff_id
        'label' => $row['staf_name'],
        'value' => $row['staf_name']
    );
}

echo json_encode($staff_data);
$conn->close();
