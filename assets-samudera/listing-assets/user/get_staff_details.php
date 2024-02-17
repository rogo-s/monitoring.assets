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

// Retrieve staff details
$staff_name = $_POST["staff_name"];
$sql = "SELECT * FROM `tbl_staf` WHERE `staf_name` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $staff_name);
$stmt->execute();
$result = $stmt->get_result();

$staff_details = array();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $staff_details["nik"] = $row["nik"];
    $staff_details["gender"] = $row["gender"];
    $staff_details["email"] = $row["email"];
    $staff_details["branch_id"] = $row["branch_id"];
}

// Retrieve gender options
$sql = "SELECT DISTINCT `gender` FROM `tbl_staf`";
$result = $conn->query($sql);
$genders = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genders[] = $row["gender"];
    }
}
$staff_details["genders"] = $genders;

// Retrieve branch options
$sql = "SELECT `branch_id`, `branch_name` FROM `tbl_branch`";
$result = $conn->query($sql);
$branches = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $branches[$row["branch_id"]] = $row["branch_name"];
    }
}
$staff_details["branches"] = $branches;

$conn->close();

// Return JSON encoded data
echo json_encode($staff_details);
