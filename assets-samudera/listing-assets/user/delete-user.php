<?php
include("../config.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM device_assets_computer WHERE device_id = $id";

    if ($db->query($sql) === TRUE) {
        header('Location: ../index.php?status=Data berhasil dihapus');
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
        header('Location: ../index.php?status=Error : ' . $sql . "<br>" . $db->error);
    }

    $db->close(); // Ini adalah baris yang diperbaiki
}
