<?php
include 'connect.php';

$sql = "SELECT * FROM adminPreorders";
$result = $conn->query($sql);

$preorders = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $preorders[] = $row;
    }
}

$conn->close();

echo json_encode($preorders);
?>
