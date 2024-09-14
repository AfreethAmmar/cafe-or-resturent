<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];  // 'adminreservation' or 'reservation'
    $sql = "DELETE FROM reservation WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();

header("Location: staff-dashboad.php");
exit();
?>
