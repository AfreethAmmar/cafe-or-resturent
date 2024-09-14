<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $user_id = mysqli_real_escape_string($conn, $user_id);

    $sql = "DELETE FROM preoorders WHERE id='$user_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Customer deleted successfully.";
    } else {
        echo "Error deleting customer: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
header("Location: staff-dashboad.php");
header("Location: staff-home.php");
exit();
?>