<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $table = $_POST['table'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = isset($_POST['date']) ? $_POST['date'] : null;
    $time = isset($_POST['time']) ? $_POST['time'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
    $guests = isset($_POST['guests']) ? $_POST['guests'] : null;

    if ($table === 'adminpreorders') {
        $sql = "UPDATE adminpreorders SET name='$name', email='$email', phone='$phone', food='$food', quantity='$quantity' WHERE id=$id";
    } elseif ($table === 'preorders') {
        $sql = "UPDATE preorders SET name='$name', email='$email', phone='$phone', food='$food', quantity='$quantity' WHERE id=$id";
    } elseif ($table === 'adminreservation') {
        $sql = "UPDATE adminreservation SET name='$name', email='$email', phone='$phone', date='$date', time='$time', guests='$guests' WHERE id=$id";
    } elseif ($table === 'reservation') {
        $sql = "UPDATE reservation SET name='$name', email='$email', phone='$phone', date='$date', time='$time', guests='$guests' WHERE id=$id";
    } else {
        die("Invalid table specified");
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("Location: staff-dashboad.php");
    exit();
}
?>
    