<?php
include("../config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_non_device WHERE nonDev_id = $id";

    if ($db->query($sql) === TRUE) {
        header('Location: ../index.php?status=Data berhasil dihapus');
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
        header('Location: ../index.php?status=Error : ' . $sql . "<br>" . $db->error);
    }

    $db->close();
}
?>
